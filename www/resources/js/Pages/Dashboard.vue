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
                Olá, {{ $page.props.auth.user.nome }}
            </h2>
        </template>

        <div v-if="$page.props.user.roles.includes('secretaria')">

            <Head title="Secretaria"></Head>           

            <div class="py-10"> 
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a href="/register" class="text-black-600 hover:text-black-800 font-bold text-lg">Registro</a>
                            <h1 class="ml-4 mt-2">Clique aqui e faca o registro de novos usuarios (secretarios ou psicologos).</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-0"> 
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a :href="route('cadastro')" class="text-black-600 hover:text-black-800 font-bold text-lg">Cadastro de Pacientes</a>
                            <h1 class="ml-4 mt-2">Clique aqui e faca cadastro de um novo paciente.</h1>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div v-if="$page.props.user.roles.includes('psicologo')">

            <Head title="Psicologo"></Head>

            <div class="py-10"> 
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a href="/listapaciente" class="text-black-600 hover:text-black-800 font-bold text-lg">Lista de Pacientes</a>
                            <h1 class="ml-4 mt-2">Clique no link acima para visualizar e editar as informacoes de todos os pacientes.</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-0"> 
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a href="/documentos" class="text-black-600 hover:text-black-800 font-bold text-lg">Documentos</a>
                            <h1 class="ml-4 mt-2">Clique aqui para gerar um documento.</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-10"> 
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a :href="route('info')" class="text-black-600 hover:text-black-800 font-bold text-lg">Histórico de Consultas</a>
                            <h1 class="ml-4 mt-2">Clique no link acima para verificar seu histórico de atendimentos.</h1>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <div v-if="$page.props.user.roles.includes('cliente')">

            <Head title="Cliente"></Head>

            <div class="py-10">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a :href="route('consultas.create')" class="text-black-600 hover:text-black-800 font-bold text-lg">Agendar Consultas</a>
                            <h1 class="ml-4 mt-2">Clique no link acima para agendar sua consulta com um de nossos psicólogos.</h1>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="py-0"> 
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a :href="route('consultas.historico')" class="text-black-600 hover:text-black-800 font-bold text-lg">Histórico de Consultas</a>
                            <h1 class="ml-4 mt-2">Clique no link acima para verificar seu histórico de atendimentos.</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-10">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a :href="route('consultas.futuras')" class="text-black-600 hover:text-black-800 font-bold text-lg">Consultas Futuras</a>
                            <h1 class="ml-4 mt-2">Clique no link acima para verificar suas próximas consultas agendadas.</h1>
                        </div>
                    </div>
                </div>
            </div>

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

<style>
.min-h-screen {
  min-height: 100vh;
}
.btn {
  transition: all 0.3s;
}
.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}
</style>
