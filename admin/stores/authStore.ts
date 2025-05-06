import { defineStore } from 'pinia'

import { ECookie } from '~/enums/common'
import {
  COOKIE_MAX_AGE_IN_SECS,
  LAST_ACTIVE_TIME_KEY,
} from '~/constants/common'
import ManagerModel from '~/models/manager'
import appRouters from '~/constants/appRouters'

export const useAuthStore = defineStore('auth', () => {
  const serviceApi = useServiceApi()
  const user = ref<ManagerModel>()
  const error = ref<IError | null>()

  const accessToken = useCookie<string>(ECookie.ACCESS_TOKEN, {
    maxAge: COOKIE_MAX_AGE_IN_SECS,
  })
  const refreshToken = useCookie<string>(ECookie.REFRESH_TOKEN, {
    maxAge: COOKIE_MAX_AGE_IN_SECS,
  })

  const validateError = computed(() => error.value?.detail)
  const isLoggedIn = computed(() => !!user.value?.id)

  const login = async (
    params: ILoginForm,
  ): Promise<ILoginResponse | unknown> => {
    try {
      const { data } = await serviceApi.auth.login<ILoginResponse>(params)

      console.log('login data', data)

      setToken(data?.access_token?.plaintext || '')
      setRefreshToken(data?.refresh_token?.plaintext || '')

      setUser(data.admin)
      return data
    } catch (error) {
      return Promise.reject(error)
    }
  }

  const fetchUser = async (): Promise<void> => {
    if (!accessToken.value) return
    try {
      const { data } = await serviceApi.auth.me<IGetProfileResponse>()
      setUser(data)
    } catch (error) {
      return Promise.reject(error)
    }
  }

  const logout = async (): Promise<boolean> => {
    if (!accessToken.value) return true

    try {
      await serviceApi.auth.logout()

      return true
    } catch (err) {
      return false
    } finally {
      resetStore()
    }
  }

  const setToken = (newAccessToken = '') => {
    accessToken.value = newAccessToken
  }

  const setRefreshToken = (newRefreshToken = '') => {
    refreshToken.value = newRefreshToken
  }

  const setUser = (data?: IManager) => {
    user.value = new ManagerModel(data)
  }

  const resetStore = () => {
    setUser()
    setToken('')
    setRefreshToken('')
    clearError()
  }

  const clearError = () => {
    error.value = null
  }

  // const clearLocalStorage = () => {
  //   localStorage.removeItem(appRouters.SAKE_REGISTRATION_STATUS)
  //   localStorage.removeItem(appRouters.WINE_REGISTRATION_STATUS)
  //   localStorage.removeItem(LAST_ACTIVE_TIME_KEY)
  // }

  return {
    user,
    error,
    accessToken,
    validateError,
    isLoggedIn,
    login,
    fetchUser,
    logout,
    resetStore,
  }
})
