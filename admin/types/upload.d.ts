interface IGenerateUploadImageUrlRequestBody {
    file_name: string
    mimetype: string
    resource: string
    size: number
  }
  interface IGenerateUploadImageUrlResponse {
    data: {
      presigned_data: {
        form_attributes: {
          action: string
          method: string
          enctype: string
        }
        form_inputs: Record<string, string>
      }
      path: string
      id: number
    }
  }

  interface IUploadFileToS3RequestBody {
    url: string
    presignedFormInput: Record<string, string>
    file: File
  }

  export type {
    IGenerateUploadImageUrlRequestBody,
    IGenerateUploadImageUrlResponse,
    IUploadFileToS3RequestBody,
  }
