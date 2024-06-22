<template>
    <BoardLayout>
        <form class="flex flex-col gap-2" @submit.prevent="addBoard">
            <div class="flex items-center">
                <FormInput type="text" placeholder="Board title" v-model="boardForm.title" name="board_title" />
                <Button type="submit" variant="secondary">Add</Button>
            </div>
            <span class="text-red-500">{{ errorBag?.title }}</span>
        </form>
    </BoardLayout>
</template>

<script setup>
const props = defineProps({
    project: Object
})

const {api} =  useAxios()
const { errorBag,
        transformValidationErrors,
        resetErrorBag } = useCustomError()

    
const boardForm = reactive({
    title: '',
    project_id: props.project?.id
})

const {project} = useProject()



function addBoard()
{
    resetErrorBag()   
    boardForm.project_id = props.project.id
    api.post("/api/board", boardForm).then(({data})=> {
        project.value.boards.push(data.data)
    }).catch(err => {
        transformValidationErrors(err.response)
    })
}

</script>

<style lang="scss" scoped>

</style>