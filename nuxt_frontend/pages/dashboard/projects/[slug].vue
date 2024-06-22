<template>
    <MetaTags :title="project?.title" />
    <div class="flex flex-col gap-5">
        <Heading class="text-start">{{ project?.title }}</Heading>
        <p class="text-gray-500">{{ project?.description }}</p>

        <div>
            <Button variant="primary" @click="showBoard = !showBoard">Add Board</Button>
        </div>

        <div class="w-full overflow-x-auto flex gap-7">
            <BoardStatic v-if="showBoard" :project="project" />
            <BoardDynamic v-for="board in project?.boards" :key="board?.id" :board="board" />
        </div>
        <!-- static board  -->
        <!-- list of boards -->

    </div>
</template>

<script setup>

const route = useRoute()

const {project} = useProject()

const { api } = useAxios()
const showBoard = ref(false)

onMounted(() => {
    api.get(`/api/project/${route.params.slug}`).then(({ data }) => {
        project.value = data.data
        console.log("project", project)
    })
})


</script>

<style lang="scss" scoped></style>