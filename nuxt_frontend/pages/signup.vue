<template>
    <MetaTags title="Sign Up" description="Sign Up to your account" />
    <div>
       <AuthForm formType="signup" />
    </div>
</template>

<script setup>

definePageMeta({
   middleware: ['guest']
})

</script>

<style lang="scss" scoped>

</style>