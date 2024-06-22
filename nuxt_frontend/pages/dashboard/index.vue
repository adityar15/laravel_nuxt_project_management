<template>
    <MetaTags title="Project app" description="Project description" />
    <div>
       This is {{user?.email}}
    </div>
</template>

<script setup>

const {user}= useAuth()


</script>

<style lang="scss" scoped>

</style>