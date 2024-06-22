<template>
    <MetaTags title="Project list" />

    <div class="flex flex-col gap-10">
        <Heading> Your projects </Heading>
        <ProjectAdd @add="handleProjectAddition" />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <ProjectCard @delete="handleProjectDeletion" v-for="project in projects" :key="project.id" :project="project" />
        </div>
    </div>
</template>

<script setup>
const { api } = useAxios()


const projects = ref([])

onMounted(() => {
    loadProjects()
})

function loadProjects() {
    api.get("/api/projects").then(({ data }) => {
        projects.value = data.data
    })
}

function handleProjectAddition(project) {
    projects.value = [project.data, ...projects.value]
}

function handleProjectDeletion(project) {
    projects.value = projects.value.filter(p => p.id != project.id)
}
</script>

<style lang="scss" scoped></style>