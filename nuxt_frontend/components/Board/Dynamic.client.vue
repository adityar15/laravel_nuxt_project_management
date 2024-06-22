<template>
    <BoardLayout class="p-2 overflow-y-auto">
        <Heading as="h3" class="flex justify-between items-center">
            <span>{{ props.board?.title }}</span>
            <PlusCircleIcon class="size-6 cursor-pointer stroke-green-500" @click="showTicketForm = !showTicketForm" />
        </Heading>

        <div class="flex flex-col gap-3 py-5">
            <TicketStatic @add="showTicketForm = false" :board="props.board" v-if="showTicketForm" />
            <Draggable group="board" v-model="props.board.tickets" @change="handleChange"
                class="flex flex-col gap-3 min-h-60">

                <template #item="{ element }">
                    <TicketDynamic :ticket="element" />
                </template>

            </Draggable>
        </div>
    </BoardLayout>
</template>

<script setup>
import Draggable from 'vuedraggable'
import { PlusCircleIcon } from "@heroicons/vue/24/outline"

const props = defineProps({
    board: Object
})

const showTicketForm = ref(false)

const { api } = useAxios()




function handleChange(event) {



    if (event?.moved) {

        const { element, newIndex, oldIndex } = event.moved


        updateTicket({
            ticketId: element.id,
            newIndex,
            oldIndex
        })


        // this is when ticket is moved in the same board
    }

    else if (event?.added) {

        const { element, newIndex, oldIndex } = event.added


        updateTicket({
            ticketId: element.id,
            newIndex,
            oldIndex,
            boardToId: props.board.id
        })
    }

}


function updateTicket(payload) {

  

    let requiredTicket = props.board.tickets.find(t => t.id == payload.ticketId)

    if (payload.boardToId) {
       
        // code to update ticket board
        requiredTicket = {
            ...requiredTicket,
            board_id: payload.boardToId
        }
    }

    requiredTicket = {
        ...requiredTicket,
        rank: payload.newIndex + 1
    }


    api.post(`/api/ticket/${payload.ticketId}/move`, requiredTicket).then(({data}) => {
        console.log("data", data)
    }).catch(err => {
        console.log("err",err.response.data)
    })

}
</script>

<style lang="scss" scoped></style>