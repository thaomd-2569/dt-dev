import { type IAuthRepo } from '~/repositories/auth'
import { ICategoryRepo } from '../repositories/category'

export {}

declare global {
  interface IApiInstance {
    // common: ICommonRepo
    auth: IAuthRepo
    category: ICategoryRepo
  }
}
