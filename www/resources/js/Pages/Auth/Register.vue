<template>

    <Head title="Register" />

    <form @submit.prevent="submit">
        <div>
            <InputLabel for="nome" value="Nome" />
            <TextInput id="nome" type="text" class="mt-1 block w-full" v-model="form.nome" required autofocus autocomplete="nome" />
            <InputError class="mt-2" :message="form.errors.nome" />
        </div>

        <div class="mt-4">
            <InputLabel for="username" value="Username" />
            <TextInput id="username" type="text" class="mt-1 block w-full" v-model="form.username" required autocomplete="username" />
            <InputError class="mt-2" :message="form.errors.username" />
        </div>

        <div class="mt-4">
            <InputLabel for="password" value="Password" />
            <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4">
            <InputLabel for="role" value="Role" />
            <select v-model="form.role" class="block w-full px-4 py-2 mt-2 bg-white border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                <option disabled value="">Selecione uma opção</option>
                <option v-for="option in options" :value="option.value" :key="option.value">{{ option.label }}</option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Register
            </PrimaryButton>
        </div>
    </form>

</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    nome: '',
    username: '',
    password: '',
    password_confirmation: '',
    role: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const options = [
    { label: 'Secretaria', value: '1' },
    { label: 'Psicólogo', value: '2' },
];
</script>
