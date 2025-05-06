// Use compensable for auto import instead of plugin from `useNuxtApp`
// https://nuxt.com/docs/guide/directory-structure/composables#access-plugin-injections
export function useServiceApi(): IApiInstance {
  return useNuxtApp().$api
}
