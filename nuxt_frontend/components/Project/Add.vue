<template>
    <div class="flex flex-col">
        <div class="flex md:flex-row flex-col gap-4 md:items-center md:justify-between">
            <form class="grid grid-cols-1 md:grid-cols-3 gap-2 flex-grow" @submit.prevent="addProject" v-if="showForm">
                <FormGroup name="title" v-model="project.title" :errorMessage="errorBag.title" label="Title" />
                <FormGroup name="description" v-model="project.description" :errorMessage="errorBag.description"
                    label="Description" />
                <button type="submit" class="w-40 md:mt-5 text-purple-800 font-semibold" variant="ghost">Save</button>
            </form>
            <Button class="w-52 items-end" type="button" variant="primary" @click="showForm = !showForm">Add
                project</Button>
        </div>
    </div>
</template>

<script setup>
const project = reactive({
    title: "",
    description: ""
})

const showForm = ref(false)

const { api } = useAxios()
const { errorBag, transformValidationErrors, resetErrorBag } = useCustomError()

const emit = defineEmits(['add'])

function addProject() {
    console.log("adding project", project)
    resetErrorBag()
    api.post("/api/project", project).then(({ data }) => {
        console.log("details", project)
        emit('add', data)
    }).catch((error) => {
        transformValidationErrors(error.response)
    })
}
</script>

<style lang="scss" scoped></style>