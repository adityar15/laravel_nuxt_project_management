export default defineNuxtRouteMiddleware((to, from) => {


    const key = process.server ? 'token' : 'XSRF-TOKEN'

    const token = useCookie(key)


    if(!token.value)
        return navigateTo('/')



  })
  