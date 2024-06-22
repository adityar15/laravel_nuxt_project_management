<template>
    <div v-bind="$attrs">
        <FormLabel :labelFor="labelFor" :class="labelClass">
            {{ label }}
        </FormLabel>
        <div class="mt-2">
            <FormInput v-model="model" :name="name" :type="type" :autocomplete="autocomplete" :required="required"
                :placeholder="placeholder" :class="inputClass" />
        </div>
        <p class="mt-2 text-sm text-red-600" v-if="errorMessage">{{ errorMessage }}</p>
    </div>
</template>

<script setup>


defineProps({
    label: String,
    labelFor: String,
    name: String,
    type: String,
    required: Boolean,
    placeholder: String,
    autocomplete: String,
    inputClass: String,
    labelClass: String,
    errorMessage: {
        type: String,
        default: ''
    }
})


const model = defineModel()

</script>
