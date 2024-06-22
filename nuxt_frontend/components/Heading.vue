<template>
     <component :is="as" :class="`text-center leading-9 tracking-tight ${as}`">
            <slot></slot>
     </component>
</template>

<script setup>
defineProps({
    as: {
        type: String,
        default: 'h2',
        validator: (value) => ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'].includes(value)
    }
})
</script>

<style scoped>
.h1 {
    @apply text-4xl font-bold text-gray-900;
}
.h2 {
    @apply text-2xl font-bold text-gray-900;
}
.h3 {
    @apply text-xl font-bold text-gray-900;
}
.h4 {
    @apply text-lg font-bold text-gray-900;
}
.h5 {
    @apply text-base font-bold text-gray-900;
}
.h6 {
    @apply text-sm font-bold text-gray-900;
}
</style>