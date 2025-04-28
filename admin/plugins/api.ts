import type { FetchOptions, FetchContext } from 'ofetch'
import type { Pinia } from 'pinia'

import { AuthRepo } from '~/repositories/auth'
import { COOKIE_MAX_AGE_IN_SECS, HTTP_STATUS_CODE } from '~/constants/common'
import { ECookie } from '~/enums/common'
import appRouters from '~/constants/appRouters'
import { CategoryRepo } from '../repositories/category'

type TPromiseLike = {
    resolve: () => void
}

const UNAUTH_URLS = ['/login']

function handleStatusCode(code?: number) {
    switch (code) {
        case HTTP_STATUS_CODE.NOT_FOUND:
            showError({ statusCode: HTTP_STATUS_CODE.NOT_FOUND })
            return

        // TODO: Handle for some status codes below
        case HTTP_STATUS_CODE.FORBIDDEN:
        case HTTP_STATUS_CODE.INTERNAL_SERVER_ERROR:
        case HTTP_STATUS_CODE.UNPROCESSABLE_ENTITY:
        default:
            break
    }
}

let isRefreshing = false
let failedRequestQueue: TPromiseLike[] = []

export default defineNuxtPlugin((nuxtApp) => {
    const accessToken = useCookie<string>(ECookie.ACCESS_TOKEN, {
        maxAge: COOKIE_MAX_AGE_IN_SECS,
        watch: true,
    })
    const refreshToken = useCookie<string>(ECookie.REFRESH_TOKEN, {
        maxAge: COOKIE_MAX_AGE_IN_SECS,
        watch: true,
    })

    const { API_BASE_URL, API_SAKE_BA } = nuxtApp.$config.public
    const unAuthUrls = UNAUTH_URLS.map((url) => `${API_BASE_URL}${url}`)
    const fetchOptions: FetchOptions = { baseURL: API_BASE_URL }

    function getHeader(token: string, shopId?: string) {
        return {
            'X-Authorization': token ? `Bearer ${token}` : '',
            'X-Sake-BA': API_SAKE_BA,
            Accept: 'application/json',
            ...(shopId ? { 'X-Shop-Id': shopId } : {}),
        }
    }

    function retryFailedRequestQueue() {
        failedRequestQueue.forEach((promise: TPromiseLike) => {
            promise.resolve()
        })

        failedRequestQueue = []
    }

    /** create a new instance of $fetcher with custom option */
    const apiFetcher = $fetch.create({
        ...fetchOptions,
        onRequest({ options }: FetchContext) {
            const authStore = (nuxtApp.$pinia as Pinia).state.value.auth
            const shopId = authStore.shopIdByRoleSTM

            options.headers = getHeader(accessToken.value, shopId)
        },
        async onResponse(context) {
            const statusCode = context.response.status
            const originalRequestConfig = context.options

            // Check auth url and return code 401
            if (
                unAuthUrls.every(
                    (url) => !context.request.toString().startsWith(url),
                ) &&
                statusCode === HTTP_STATUS_CODE.UNAUTHORIZED
            ) {
                if (isRefreshing) {
                    try {
                        // Create new waiting point for each failed request (NOT INCLUDE FIRST FAILED REQUEST)
                        await new Promise<void>((resolve) => {
                            // And push this waiting point to queue
                            failedRequestQueue.push({ resolve })
                        })

                        // Then process each failed request if waiting point is resolved (when call `retryFailedRequestQueue`)
                        await new Promise<void>((resolve) => {
                            apiFetcher(context.request, {
                                ...originalRequestConfig,
                                method: originalRequestConfig.method,
                                onResponse(retryContext) {
                                    Object.assign(context, retryContext)
                                    handleStatusCode(retryContext.response.status)
                                    resolve()
                                },
                            })
                        })
                    } catch {
                        // TODO handle error here
                    }
                } else {
                    isRefreshing = true

                    await new Promise<void>((resolve, reject) => {
                        $fetch<IRefreshTokenResponse>('/refresh-token', {
                            ...fetchOptions,
                            method: 'post',
                            headers: getHeader(refreshToken.value),
                        })
                            .then(async (refreshResponseData: IRefreshTokenResponse) => {
                                const { data } = refreshResponseData

                                // Set new access token, refresh token after refresh success
                                accessToken.value = data.access_token.plaintext
                                refreshToken.value = data.refresh_token.plaintext

                                // Process retry each request in queue with new access token
                                retryFailedRequestQueue()

                                // Process retry the first failed request
                                apiFetcher(context.request, {
                                    ...originalRequestConfig,
                                    method: originalRequestConfig.method,
                                    onResponse(retryContext) {
                                        Object.assign(context, retryContext)
                                        handleStatusCode(retryContext.response.status)
                                        resolve()
                                    },
                                })
                            })
                            .catch(async () => {
                                // Remove all token if refresh token error
                                accessToken.value = ''
                                refreshToken.value = ''

                                failedRequestQueue = []

                                await navigateTo(appRouters.LOGIN)

                                reject()
                            })
                            .finally(() => {
                                isRefreshing = false // OFF refresh process
                            })
                    })
                }
            } else {
                handleStatusCode(statusCode)
            }
        },
    })

    /** an object containing all repositories we need to expose */
    const repositories: IApiInstance = {
        // common: CommonRepo(apiFetcher),
        auth: AuthRepo(apiFetcher),
        category: CategoryRepo(apiFetcher),
    }

    return { provide: { api: repositories } }
})
