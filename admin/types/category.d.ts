interface ICategoryItem {
  id: number
  ctitle: string
  description: string
  position: number
  status: int
}

interface IDeleteCategoryResponse {}


interface ICategoryList {
  page?: number
  per_page?: number
}

interface ICategoryListResponse {
  data: {
    data: ICategoryItem[]
    meta: {
      total: number
      per_page: number
    }
  }
}

interface IRegisterCategoryParams {
  id?: number
  title: string
  description: string0
  position?: number
  status?: number
}

interface IAddCategoryResponse {
  data: {
    id: number
    title: string
    description: string
    status: number
  }
}

interface IUpdateCategoryResponse extends IAddCategoryResponse {}


// interface IRegisterShopErrorMessages {
//   name?: string[]
//   company_id?: string[]
//   company_name?: string[]
//   license?: string[]
//   is_active?: string[]
//   login_id?: string[]
//   password?: string[]
// }

interface IRegisterCategoryResponse {
  data?: ICategoryItem
  // message?: IRegisterShopErrorMessages
}

export type {
  ICategoryItem,
  ICategoryList,
  ICategoryListResponse,
  IRegisterCategoryParams,
  IRegisterCategoryResponse,
  IDeleteCategoryResponse,
  IAddCategoryResponse,
  IUpdateCategoryResponse,
}
