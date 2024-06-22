<template>
    <TicketLayout class="p-2" v-bind="$attrs">
        <Heading as="h6" class="text-start">
            {{ props.ticket?.title }}
        </Heading>
    </TicketLayout>
</template>

<script setup>
const props = defineProps({
    ticket: Object
})
</script>