import { EHttpMethod } from '~/enums/common'
import type {
  ICategoryItem,
  ICategoryList,
  ICategoryListResponse,
  IRegisterCategoryParams,
  IRegisterCategoryResponse,
  IAddCategoryResponse,
  IDeleteCategoryResponse,
  IUpdateCategoryResponse,
} from '~/types/category'

export interface ICategoryRepo {
  getCategoryList: () => Promise<ICategoryListResponse>
    deleteCategory: (id: number) => Promise<IDeleteCategoryResponse>
    addCategory: (params: any) => Promise<IAddCategoryResponse>
    // updateCategory: (
    //   params: any,
    //   id: number,
    // ) => Promise<IUpdateCategoryResponse>
    // getCategoryDetail: (id: number) => Promise<ICategoryDetailResponse>
}

export const CategoryRepo = (fetcher: typeof $fetch): ICategoryRepo => {
  return {
    getCategoryList: async (): Promise<ICategoryListResponse> => {
      return await fetcher('/categories', {
        method: EHttpMethod.GET,
      })
    },
    deleteCategory: async (id: number): Promise<IDeleteCategoryResponse> => {
      return fetcher(`/categories/${id}`, {
        method: EHttpMethod.DELETE,
      })
    },
    addCategory: async (params): Promise<IUpdateCategoryResponse> => {
      return await fetcher(`/categories`, {
        method: EHttpMethod.POST,
        body: { params },
      })
    },
    // updateCategory: async (params, id): Promise<IUpdateCategoryResponse> => {
    //   return await fetcher(`/drink-categories/${id}`, {
    //     method: EHttpMethod.PUT,
    //     body: { ...params, check_validate: false },
    //   })
    // },
    // getCategoryDetail: async (id): Promise<ICategoryDetailResponse> => {
    //   return await fetcher(`/drink-categories/${id}`, {
    //     method: EHttpMethod.GET,
    //   })
    // },
  }
}
