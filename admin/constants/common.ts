const COMMON_ERROR_MESSAGE = 'Something went wrong!'

const MAX_LENGTH = {
    // account
    ACCOUNT: {
        EMAIL: 255,
        PASSWORD: 255,
    },

    // category
    CATEGORY : {
        NAME: 255,
        DESCRIPTION: 1000,
    },

    // post
    POST : {
        TITLE: 255,
        DESCRIPTION: 1000,
    }
}

const CATEGORY_STATUS = {
    DRAFT: 1,
    PUBLIC: 2,
}

const POST_STATUS = {
    DRAFT: 1,
    PUBLIC: 2,
}

// Cookies
const COOKIE_MAX_AGE_IN_SECS = 34560000 // 400 * 24 * 60 * 60 (seconds) (Limit 400 days)

// HTTP
const HTTP_STATUS_CODE = {
    UNAUTHORIZED: 401,
    FORBIDDEN: 403,
    NOT_FOUND: 404,
    INTERNAL_SERVER_ERROR: 500,
    UNPROCESSABLE_ENTITY: 422,
}

export {
    COMMON_ERROR_MESSAGE,
    MAX_LENGTH,
    CATEGORY_STATUS,
    POST_STATUS,
    COOKIE_MAX_AGE_IN_SECS,
    HTTP_STATUS_CODE
}

// Inactivity threshold
export const INACTIVITY_THRESHOLD = 2 * 60 * 60 * 1000 // 2 hours
export const UPDATE_LAST_ACTIVE_TIME_PERIOD = 1 * 60 * 1000 // 1 minute
export const LAST_ACTIVE_TIME_KEY = 'last_active_time'
export const DOWNLOAD_TIMEOUT = 600 // 10 minutes
