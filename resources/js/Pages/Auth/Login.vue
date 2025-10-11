<template>
    <SignUpLoginLayout>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            @csrf

            <div class="Login-Wrapper">
                <div class="Login-Header">Iniciar Sesión</div>
                <h5 class="Information text-center">Ingrese su informacion de usuario para acceder <br> a su perfil.
                </h5>
                <div class="Login-Form">
                    <div class="Input-Wrapper">
                        <TextInput id="email" type="email" class="Input-Field" v-model="form.email" required autofocus
                            autocomplete="username" />

                        <InputLabel class="Label" for="email" value="Email" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="Input-Wrapper">
                        <TextInput id="password" type="password" class="Input-Field" v-model="form.password" required
                            autocomplete="current-password" />

                        <InputLabel class="Label" for="password" value="Password" />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="Login-Check">
                        <div class="Remember">
                            <Checkbox id="Remember-Me" name="remember" v-model:checked="form.remember" />

                            <label for="Remember-Me">Recordarme</label>
                        </div>
                        <div class="Forgot">
                            <Link v-if="canResetPassword" :href="route('password.request')"
                                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
                            Forgot your password?
                            </Link>
                        </div>
                    </div>

                    <div class="Input-Wrapper">
                        <PrimaryButton class="Input-Login" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Iniciar Sesión
                        </PrimaryButton>
                    </div>

                    <div class="Login-Register mt-2 text-center">
                        <span>No tienes una cuenta: <a :href="route('register')">Registrate</a></span>
                    </div>
                </div>
            </div>
        </form>
    </SignUpLoginLayout>
</template>

<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import SignUpLoginLayout from '@/Layouts/SignUpLoginLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<style src="bootstrap/dist/css/bootstrap.css"></style>
<style src="bootstrap-icons/font/bootstrap-icons.css"></style>
<style src="../../../css/login.css"></style>