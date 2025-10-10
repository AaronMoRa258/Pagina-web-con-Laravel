<template>
    <SignUpLoginLayout>

        <Head title="Register" />

        <form @submit.prevent="submit" class="Wrapper">
            <div class="Login-Wrapper">
                <div class="Login-Header">Registrarse</div>
                <h5 class="Information text-center">Favor de llenar el formulario para <br> poder registrarse.</h5>
                <div class="Login-Form">
                    <div class="Input-Wrapper">
                        <TextInput id="name" type="text" class="Input-Field" v-model="form.name" required 
                            name="name" autocomplete="name" />

                        <InputLabel class="Label" for="name" value="Nombre" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="Input-Wrapper">
                        <TextInput id="user" type="text" class="Input-Field" v-model="form.user" required name="user"
                            autocomplete="username" />

                        <InputLabel class="Label" for="user" value="Usuario" />

                        <InputError class="mt-2" :message="form.errors.user" />
                    </div>

                    <div class="Input-Wrapper">
                        <TextInput id="email" type="email" class="Input-Field" v-model="form.email" required
                            name="email" autocomplete="email" />

                        <InputLabel class="Label" for="email" value="Email" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="Input-Wrapper">
                        <TextInput id="password" type="password" class="Input-Field" v-model="form.password" required
                            name="password" autocomplete="new-password" />

                        <InputLabel class="Label" for="password" value="Password" />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="Input-Wrapper">
                        <TextInput id="password_confirmation" type="password" class="Input-Field"
                            v-model="form.password_confirmation" required autocomplete="new-password" />

                        <InputLabel class="Label" for="password_confirmation" value="Confirm Password" />

                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <Link :href="route('login')"
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
                        Already registered?
                        </Link>

                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Register
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </form>

    </SignUpLoginLayout>
</template>

<script setup>
import SignUpLoginLayout from '@/Layouts/SignUpLoginLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    user: ""
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<style src="bootstrap/dist/css/bootstrap.css"></style>
<style src="bootstrap-icons/font/bootstrap-icons.css"></style>
<style src="../../../css/login.css"></style>