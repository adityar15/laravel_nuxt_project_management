export default defineEventHandler(async (event) => {
    deleteCookie(event, 'token')
    deleteCookie(event, 'XSRF-TOKEN')

    return {message: "Cookie removed successfully"}
})