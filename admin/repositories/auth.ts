import { EHttpMethod } from '~/enums/common'

export interface IAuthRepo {
    login: <ILoginResponse>(credentials: ILoginForm) => Promise<ILoginResponse>
    me: <IUser>() => Promise<IUser>
    logout: () => Promise<void>
}

export const AuthRepo = (fetcher: typeof $fetch): IAuthRepo => {
    return {
        login: async <ILoginResponse>(
            credentials: ILoginForm,
        ): Promise<ILoginResponse> => {
            return await fetcher('/login', {
                method: EHttpMethod.POST,
                body: credentials,
            })
        },

        me: async <IUser>(): Promise<IUser> => {
            return await fetcher('/profile', {
                method: EHttpMethod.GET,
            })
        },

        logout: async (): Promise<void> => {
            return await fetcher('/logout', {
                method: EHttpMethod.POST,
            })
        },
    }
}
