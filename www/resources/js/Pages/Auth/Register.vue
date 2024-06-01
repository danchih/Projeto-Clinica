<template>
    <AuthenticatedLayout>
        <Head title="Register" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Olá, {{ $page.props.auth.user.nome }}
            </h2>
        </template>
        
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <!-- Notification Element -->
                <div v-if="notification.message" :class="`p-4 mb-4 text-sm ${notification.type === 'error' ? 'text-red-700 bg-red-100' : 'text-green-700 bg-green-100'}`">
                    {{ notification.message }}
                </div>
                
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
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    nome: '',
    username: '',
    password: '',
    password_confirmation: '',
    role: '',
});

const notification = ref({
    message: '',
    type: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
        onSuccess: () => {
            notification.value = {
                message: 'Usuário cadastrado com sucesso!',
                type: 'success',
            };
        },
        onError: (errors) => {
            notification.value = {
                message: 'Erro ao cadastrar paciente.',
                type: 'error',
            };
        },
    });
};

const options = [
    { label: 'Secretaria', value: '1' },
    { label: 'Psicólogo', value: '2' },
];
</script>
