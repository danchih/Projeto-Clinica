<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>

    <!--comando abaixo verifica quais sao os roles e permission do user logado-->
    <!--
    <div>
        {{ $page.props }}
    </div>
    -->

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>

        <div v-if="$page.props.user.roles.includes('secretaria')">

            <Head title="Secretaria"></Head>
            
            <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>

            <div class="text-3xl text-gray-700 leading-relaxed text-center">
                <p class="mt-6">Cadastro de Pacientes</p>
            </div>

            <div class="leading-relaxed text-center max-w-md mx-auto">
                <form @submit="submit">
                    <div class="mt-6">
                        <label for="nome" class="block text-left mb-2">Nome:</label>
                        <input type="text" v-model="form.nome" class="w-full px-3 py-2 border rounded" />
                        <span v-if="errors.nome" class="text-red-500">{{ errors.nome[0] }}</span>
                    </div>

                    <div class="mt-2">
                        <label for="cep" class="block text-left mb-2">CEP:</label>
                        <input type="text" v-model="form.cep" @blur="preencherEndereco" class="w-full px-3 py-2 border rounded" />
                        <span v-if="errors.cep" class="text-red-500">{{ errors.cep[0] }}</span>
                    </div>

                    <div class="mt-2">
                        <label for="endereco" class="block text-left mb-2">Endereço:</label>
                        <input type="text" v-model="form.endereco" class="w-full px-3 py-2 border rounded" />
                        <span v-if="errors.endereco" class="text-red-500">{{ errors.endereco[0] }}</span>
                    </div>

                    <div class="mt-2">
                        <label for="bairro" class="block text-left mb-2">Bairro:</label>
                        <input type="text" v-model="form.bairro" class="w-full px-3 py-2 border rounded" />
                        <span v-if="errors.bairro" class="text-red-500">{{ errors.bairro[0] }}</span>
                    </div>

                    <div class="mt-2">
                        <label for="cidade" class="block text-left mb-2">Cidade:</label>
                        <input type="text" v-model="form.cidade" class="w-full px-3 py-2 border rounded" />
                        <span v-if="errors.cidade" class="text-red-500">{{ errors.cidade[0] }}</span>
                    </div>

                    <div class="mt-2">
                        <label for="estado" class="block text-left mb-2">Estado:</label>
                        <input type="text" v-model="form.estado" class="w-full px-3 py-2 border rounded" />
                        <span v-if="errors.estado" class="text-red-500">{{ errors.estado[0] }}</span>
                    </div>

                    <div class="mt-2">
                        <label for="telefone" class="block text-left mb-2">Telefone:</label>
                        <input type="text" v-model="form.telefone" class="w-full px-3 py-2 border rounded" />
                        <span v-if="errors.telefone" class="text-red-500">{{ errors.telefone[0] }}</span>
                    </div>

                    <div class="mt-2">
                        <label for="username" class="block text-left mb-2">Username:</label>
                        <input type="text" v-model="form.username" class="w-full px-3 py-2 border rounded" />
                        <span v-if="errors.username" class="text-red-500">{{ errors.username[0] }}</span>
                    </div>

                    <div class="mt-2">
                        <label for="password" class="block text-left mb-2">Password:</label>
                        <input type="password" v-model="form.password" class="w-full px-3 py-2 border rounded" />
                        <span v-if="errors.password" class="text-red-500">{{ errors.password[0] }}</span>
                    </div>

                    <div class="mt-2">
                        <button class="ml-4" :class="{ 'opacity-25': processing }" :disabled="processing">
                            Cadastrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div v-if="$page.props.user.roles.includes('psicologo')">
            <Head title="Psicologo"></Head>
            <h3>psicologo aqui</h3>
        </div>
        
        <div v-if="$page.props.user.roles.includes('cliente')">
            <Head title="Cliente"></Head>
            <h3>cliente aqui</h3>
        </div>

    </AuthenticatedLayout>
</template>


<script>
export default {
    data() {
        return {
            form: {
                nome: '',
                cep: '',
                endereco: '',
                bairro: '',
                cidade: '',
                estado: '',
                telefone: '',
                username: '',
                password: ''
            },
            errors: {},
            processing: false
        };
    },
    methods: {
        async preencherEndereco() {
            if (this.form.cep.length === 8) {
                try {
                    const response = await fetch(`https://viacep.com.br/ws/${this.form.cep}/json/`);
                    const data = await response.json();
                    if (data.erro) {
                        this.errors.cep = ['CEP inválido.'];
                    } else {
                        this.form.endereco = data.logradouro;
                        this.form.bairro = data.bairro;
                        this.form.cidade = data.localidade;
                        this.form.estado = data.uf;
                    }
                } catch (error) {
                    console.error('Erro ao preencher endereço:', error);
                }
            }
        },
        async submit(event) {
            event.preventDefault();
            this.processing = true;
            try {
                const response = await axios.post('/pacientes', this.form);
                alert(response.data.message);
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            } finally {
                this.processing = false;
            }
        }
    }
};
</script>
