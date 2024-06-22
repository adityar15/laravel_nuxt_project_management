<template>
    <MetaTags title="Sign In" description="Sign in to your account" />
    <div>
       <AuthForm />
    </div>
</template>

<script setup>

definePageMeta({
   middleware: ['guest']
})

</script>

<style lang="scss" scoped>

</style>