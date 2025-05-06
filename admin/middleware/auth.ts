import { storeToRefs } from 'pinia'
import appRouters, {
    UNAUTHENTICATED_ROUTES,
} from '~/constants/appRouters'
import { INACTIVITY_THRESHOLD, LAST_ACTIVE_TIME_KEY } from '~/constants/common'

export default defineNuxtRouteMiddleware(async (to) => {
    const authStore = useAuthStore()
    const navigateToUnAuthRoute = UNAUTHENTICATED_ROUTES.includes(to.path)
    const isHealthCheck = to.path === appRouters.HEALTH_CHECK

    const {
        isLoggedIn,
        accessToken,
    } = storeToRefs(authStore)

    // Case 1: no auth token -> reset user and back to login
    if (!accessToken.value) {
        authStore.resetStore()
        // authStore.clearLocalStorage()
        if (!navigateToUnAuthRoute) return navigateTo(appRouters.LOGIN)
    }

    // Case 2: have auth token but no user data
    else {
        try {
            if (!isLoggedIn.value) {
                await authStore.fetchUser()
            }
        } catch {
            authStore.resetStore()
            return navigateTo(appRouters.LOGIN)
        }
    }
})
