export interface IAuth {
    id: number;
    name: string;
    email: string;
}

export type TLoginParams = {
    email: string;
    password: string;
};

export const LOGIN_PARAMS = { email: "", password: "" };

export default class Auth implements IAuth {
    id!: number;
    name!: string;
    email!: string;

    constructor(props?: IAuth) {
        this.id = _get(props, "id", 0);
        this.name = _get(props, "name", "");
        this.email = _get(props, "email", "");
    }
}
