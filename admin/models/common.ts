export default class CommonModel {
  toJSON() {
    return { ...this }
  }
}
