<template>
    <div class="login-container">
        <a-card class="login-card" title="Welcome Back" :bordered="false">
            <div class="logo-container">
                <img src="/images/Login.png" alt="Company Logo" width="80" height="80"/>
            </div>

            <!-- Login Form -->
            <a-form :model="formState" name="login" @finish="onFinish"
                :validate-messages="validateMessages">
                <a-form-item name="login_id" :rules="[{ required: true }]">
                    <a-input v-model:value="formState.login_id" placeholder="Login ID">
                        <template #prefix>
                            <user-outlined />
                        </template>
                    </a-input>
                </a-form-item>

                <a-form-item name="password" :rules="[{ required: true, min: 5 }]">
                    <a-input-password v-model:value="formState.password" placeholder="Password">
                        <template #prefix>
                            <lock-outlined />
                        </template>
                    </a-input-password>
                </a-form-item>

                <div class="login-options">
                    <a-checkbox v-model:checked="formState.remember">Remember me</a-checkbox>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <a-form-item>
                    <a-button type="primary" html-type="submit" :loading="loading" block>
                        Log in
                    </a-button>
                </a-form-item>
            </a-form>

            <!-- Divider -->
            <div class="divider">
                <span class="divider-text">or continue with</span>
            </div>

            <!-- Social Login Buttons -->
            <div class="social-buttons">
                <a-button class="social-btn google" @click="socialLogin('google')">
                    <template #icon><google-outlined /></template>
                    Google
                </a-button>
                <a-button class="social-btn facebook" @click="socialLogin('facebook')">
                    <template #icon><facebook-outlined /></template>
                    Facebook
                </a-button>
                <a-button class="social-btn line" @click="socialLogin('line')">
                    <template #icon><message-outlined /></template>
                    Line
                </a-button>
            </div>

            <!-- Register Link -->
            <div class="register-link">
                Don't have an account? <a href="/register">Sign up</a>
            </div>
        </a-card>
    </div>
</template>

<script setup lang="ts">
definePageMeta({
    layout: 'empty'
})
import { reactive } from 'vue'
import { message } from 'ant-design-vue'
import {
    UserOutlined,
    LockOutlined,
    GoogleOutlined,
    FacebookOutlined,
    MessageOutlined
} from '@ant-design/icons-vue'

interface FormState {
    login_id: string
    password: string
}
const formState = reactive < FormState > ({
    login_id: '',
    password: '',
})

// Loading state
const loading = ref(false)
const authStore = useAuthStore()
const error = ref('')
const isLoggingIn = ref(false)
const { user } = storeToRefs(authStore)

// Form validation messages
const validateMessages = {
    required: '${label} is required!',
    types: {
        email: '${label} is not a valid email!',
    },
}

// Form submission handlers
const onFinish = async (values: any) => {
    try {
        error.value = ''
        isLoggingIn.value = true
        if (!formState.login_id.trim() && formState.password.trim()) {
            error.value = 'Please enter your login ID'
            return
        }
        if (!formState.password.trim() && formState.login_id.trim()) {
            error.value = 'Please enter your password'
            return
        }
        if (!formState.login_id.trim() && !formState.password.trim()) {
            error.value = 'Please enter your login ID and password'
            return
        }
        await authStore.login({
            login_id: values.login_id,
            password: values.password,
        })

        return navigateTo('/')
    } catch (err) {
        error.value = err?.data?.message
    } finally {
        isLoggingIn.value = false
    }
}

const onFinishFailed = (errorInfo) => {
    console.error('Failed:', errorInfo)
    message.error('Please check your input')
}

// Social login handler
const socialLogin = (provider) => {
    message.loading(`Logging in with ${provider}...`, 1.5)
    console.log(`Initiating ${provider} login flow`)

    // Here you would implement OAuth flow for each provider
    // This is where you'd integrate with your authentication services
}
</script>

<style scoped>
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f5f5f5;
    padding: 20px;
}

.login-card {
    width: 100%;
    max-width: 400px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    border-radius: 8px;
}

.logo-container {
    display: flex;
    justify-content: center;
    margin-bottom: 24px;
}

.login-options {
    display: flex;
    justify-content: space-between;
    margin-bottom: 24px;
}

.forgot-link {
    color: #1890ff;
    font-size: 14px;
}

.divider {
    display: flex;
    align-items: center;
    margin: 16px 0;
    color: rgba(0, 0, 0, 0.45);
}

.divider::before,
.divider::after {
    content: '';
    flex: 1;
    border-top: 1px solid rgba(0, 0, 0, 0.06);
}

.divider-text {
    padding: 0 16px;
    font-size: 14px;
}

.social-buttons {
    display: flex;
    gap: 8px;
    margin-bottom: 24px;
}

.social-btn {
    flex: 1;
    text-align: center;
}

.google {
    color: #DB4437;
    border-color: #DB4437;
}

.facebook {
    color: #4267B2;
    border-color: #4267B2;
}

.line {
    color: #06C755;
    border-color: #06C755;
}

.register-link {
    text-align: center;
    font-size: 14px;
}
</style>
