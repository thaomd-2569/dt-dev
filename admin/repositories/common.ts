import { EHttpMethod } from '~/enums/common'
import type { IGenerateUploadImageUrlRequestBody, IGenerateUploadImageUrlResponse, IUploadFileToS3RequestBody } from '~/types/upload'


export interface ICommonRepo {
    generateUploadImageUrl: (
        body: IGenerateUploadImageUrlRequestBody,
    ) => Promise<IGenerateUploadImageUrlResponse>
    uploadFileToS3: (body: IUploadFileToS3RequestBody) => Promise<any>
}

export const CommonRepo = (fetcher: typeof $fetch): ICommonRepo => {
    return {
        generateUploadImageUrl: async (body) => {
            return await fetcher('/file/presigned-upload-url', {
                method: EHttpMethod.POST,
                body,
            })
        },

        uploadFileToS3: async ({ url, presignedFormInput, file }) => {
            const formData = new FormData()

            Object.keys(presignedFormInput).forEach((key) => {
                formData.append(key, presignedFormInput[key])
            })

            formData.append('file', file)

            const response = await fetch(url, {
                method: EHttpMethod.POST,
                body: formData,
            })

            return response
        },
    }
}
