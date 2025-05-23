import CommonModel from './common'

export type CategoryType = {
    id: number
    title: string
    description: string
    position: number
    status: number
}

export default class CategoryModel extends CommonModel {
    id: number
    title: string
    description: string
    position: number
    status: number

    constructor(props?: CategoryType) {
        super()
        this.id = props?.id ?? 0
        this.title = props?.title ?? ''
        this.description = props?.description ?? ''
        this.position = props?.position ?? 0
        this.status = props?.status ?? 0
    }
}
