<template>
    <button v-bind="$attrs"
        :class="`layout ${variant}`">
        <slot></slot>
    </button>
</template>

<script setup>
defineProps({
    variant: {
        type: String,
        default: 'primary',
        validator: prop => ['primary', 'secondary', 'bordered', 'danger','success', 'ghost'].includes(prop)
    }
})
</script>

<style scoped>
.layout{
    @apply flex justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 ease-in-out duration-150 transition-all;
}

.primary{
    @apply bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600;
}

.secondary{
    @apply bg-gray-600 text-white hover:bg-gray-500 focus-visible:outline-gray-600;
}


.bordered{
    @apply bg-white text-indigo-800 border border-indigo-500 hover:bg-gray-50 focus-visible:outline-indigo-600;
}

.danger{
    @apply bg-red-600 text-white hover:bg-red-500 focus-visible:outline-red-600;
}

.success{
    @apply bg-green-600 text-white hover:bg-green-500 focus-visible:outline-green-600;
}

.ghost{
    @apply bg-transparent text-indigo-600 hover:bg-indigo-50 focus-visible:outline-indigo-600;
}

</style>