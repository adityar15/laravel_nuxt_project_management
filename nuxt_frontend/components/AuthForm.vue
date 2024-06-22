<template>

    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                alt="Your Company" />
            <Heading as="h2">
                <span v-if="props.formType == 'signin'">
                    Sign in to your account
                </span>
                <span v-else>
                    Create a new account
                </span>
            </Heading>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" @submit.prevent="handleForm">

                <FormGroup v-if="props.formType == 'signup'" label="Full name" name="name" type="text"
                    autocomplete="off" required labelFor="name" v-model="userForm.name"
                    :errorMessage="errorBag.name" />

                <FormGroup label="Email address" name="email" type="email" autocomplete="off" required
                    labelFor="email" v-model="userForm.email" :errorMessage="errorBag.email" />


                <div class="my-2">
                    <FormGroup label="Password" name="password" type="password" autocomplete="off" required
                        labelFor="password" v-model="userForm.password" :errorMessage="errorBag.password" />

                    <FormGroup v-if="props.formType == 'signup'" label="Confirm Password" name="password_confirmation"
                        type="password" autocomplete="off" required
                        v-model="userForm.password_confirmation" :errorMessage="errorBag.password" labelFor="password"
                        class="my-2" />

                    <div class="text-sm text-end" v-else>
                        <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                    </div>
                </div>



                <div>
                    <Button type="submit">
                        <span v-if="props.formType == 'signin'">
                            Sign in
                        </span>
                        <span v-else>
                            Sign up
                        </span>
                    </Button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                <span v-if="props.formType != 'signup'">
                    Not a member?
                    {{ ' ' }}
                    <NuxtLink to="/signup" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Start a
                        14 day free
                        trial</NuxtLink>
                </span>

                <span v-else>
                    Already a member?
                    {{ ' ' }}
                    <NuxtLink to="/" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Login to your
                        account</NuxtLink>
                </span>
            </p>
        </div>
    </div>
</template>

<script setup>


const props = defineProps({
    formType: {
        type: String,
        default: 'signin',
        validator: prop => ['signin', 'signup'].includes(prop)
    }
})

const userForm = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const { login, register, errorBag } = useAuth()


function handleForm()
{
    if (props.formType == 'signin') {
        login(userForm)
    } else {
        register(userForm)
    }
}
</script>