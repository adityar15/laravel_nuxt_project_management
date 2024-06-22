<template>
    <TicketLayout class="border-none shadow-none">
        <form class="flex flex-col gap-2" @submit.prevent="addTicket">
            <FormInput type="text" placeholder="Ticket title" name="ticket_title" v-model="ticketForm.title" />
            <p class="text-red-500">{{ errorBag?.title }}</p>
            <FormInput type="textarea" placeholder="Description" name="ticket_description" v-model="ticketForm.description" />
            <p class="text-red-500">{{ errorBag?.description }}</p>
            <div>
                <Button variant="secondary">Add</Button>
            </div>
        </form>
    </TicketLayout>
</template>

<script setup>

const props = defineProps({
    board: Object
})

const ticketForm = reactive({
    title: '',
    description: '',
    board_id: props.board?.id
})

const {api} = useAxios()
const {errorBag, resetErrorBag, transformValidationErrors} = useCustomError()

const {project} = useProject()
const emit = defineEmits(['add'])

function addTicket()
{
    const rank = props.board?.tickets.length + 1
    resetErrorBag()
    ticketForm.board_id = props.board.id
    api.post("/api/ticket", {...ticketForm, rank}).then(({data}) => {
       
       
        const currentBoard = project.value.boards.find(b => b.id === props.board.id)
        currentBoard.tickets.push(data.data)
        project.value.boards = project.value.boards.map(b => b.id == props.board.id ? currentBoard : b)

        emit('add')
        
    }).catch(err => {
        transformValidationErrors(err.response)
    })
}
</script>

<style scoped>

</style>