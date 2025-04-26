export {}

declare global {
  interface IToken {
    plaintext: string
  }

  interface ILoginForm {
    login_id: string
    password: string
  }

  interface IError {
    title?: string
    detail: string | null
    code: number
    message: string
  }

  interface IShop {
    id: number
    name: string
    mode: number
    type_sake: boolean
    type_wine: boolean
    type_drink: boolean
    type_food: boolean
  }

  interface IUser {
    id: number
    login_id: string
    role: number
    shop: IShop | null
  }

  interface ILoginResponse {
    data: {
      refresh_token: IToken
      access_token: IToken
      admin?: IUser
    }
  }

  interface IRefreshTokenResponse {
    data: {
      refresh_token: IToken
      access_token: IToken
    }
  }

  interface IGetProfileResponse {
    data: IUser
  }

  interface IAuthError {
    message: string
  }

  interface IRefreshResponse extends ILoginResponse {}
}
