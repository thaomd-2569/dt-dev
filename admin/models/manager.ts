import CommonModel from './common'

export default class ManagerModel extends CommonModel {
  id: number
  login_id: string
  role: number

  constructor(props?: IManager) {
    super()
    this.id = props?.id ?? 0
    this.login_id = props?.login_id ?? ''
    this.role = props?.role ?? 0
  }
}
