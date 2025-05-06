
const CATEGORY_ROUTES = {
    CATEGORY_MANAGEMENT: '/categories',
}


const routes = {
    // Common routes
    LOGIN: '/login',
    HEALTH_CHECK: '/health-check',
}

const ROUTES_VALUES = Object.values(routes)
const UNAUTHENTICATED_ROUTES = [routes.LOGIN, routes.HEALTH_CHECK]

const AUTHENTICATED_ROUTES = UNAUTHENTICATED_ROUTES.filter(
    (route) => !ROUTES_VALUES.includes(route),
)

export {
    UNAUTHENTICATED_ROUTES,
    AUTHENTICATED_ROUTES,
    CATEGORY_ROUTES,
}
export default routes
