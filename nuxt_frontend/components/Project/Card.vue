<template>
    <div class="flex flex-col gap-2 p-4 rounded-lg shadow relative">
        <TrashIcon @click="deleteProject" class="size-5 text-red-600 absolute right-5 top-4" />
        <NuxtLink :to="`/dashboard/projects/${project.id}`">
            <Heading as="h6" class="text-start flex items-center justify-between">
                <span>{{ project?.title }}</span>
            </Heading>
            <p class="text-gray-600">{{ project?.description }}</p>
        </NuxtLink>
    </div>

</template>

<script setup>
import { TrashIcon } from "@heroicons/vue/24/outline"

const props = defineProps({
    project: Object
})

const { api } = useAxios()

const emit = defineEmits(['delete'])

function deleteProject() {
    api.delete(`/api/project/${props.project.id}`).then(() => {
        emit('delete', props.project)
    })

}

</script>

<style lang="scss" scoped></style>