<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Pagina do Cliente" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Agendar Consulta
                </h2>
                <a :href="route('dashboard')" class="text-gray-800 font-bold hover:underline ml-2">Home do Cliente</a>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submitForm" class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <label for="user" class="w-32 text-right">Psicólogo:</label>
                                <select v-model="form.user_id" id="user" required class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-1/3">
                                    <option v-for="user in users" :key="user.id" :value="user.id">
                                        {{ user.nome }}
                                    </option>
                                </select>
                            </div>

                            <div class="flex items-center space-x-4">
                                <label for="data" class="w-32 text-right">Data:</label>
                                <input class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-1/3" type="date" v-model="form.data" id="data" required>
                            </div>

                            <div class="flex items-center space-x-4">
                                <label for="horario_inicio" class="w-32 text-right">Horário de Início:</label>
                                <input class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-1/3" type="time" v-model="form.horario_inicio" id="horario_inicio" @change="calcularHorarioFim" required>
                            </div>

                            <p v-if="horarioFimCalculado" class="mt-4">Horário de Fim: {{ horarioFimCalculado }}</p>

                            <div class="flex justify-end mt-4">
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">Agendar Consulta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style scoped>
.input-label {
    width: 120px;
}
</style>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    props: {
        users: Array
    },
    data() {
        return {
            form: {
                user_id: '',
                data: '',
                horario_inicio: '',
                horario_fim: ''
            },
            horarioFimCalculado: ''
        };
    },
    methods: {
        async submitForm() {
            try {
                await Inertia.post(route('consultas.store'), this.form, {
                    onSuccess: () => {
                        this.form = {
                            user_id: '',
                            data: '',
                            horario_inicio: '',
                            horario_fim: ''
                        };
                        Inertia.visit(route('consultas.create'));
                    },
                    onError: (errors) => {
                        console.error('Erro ao agendar consulta:', errors);
                    }
                });
            } 
            catch (error) {
                console.error('Erro ao agendar consulta:', error);
            }
        },

        calcularHorarioFim() {
            if (this.form.horario_inicio) {
                const inicio = new Date(`1970-01-01T${this.form.horario_inicio}`);
                const fim = new Date(inicio.getTime() + 50 * 60000); // Adiciona 50 minutos
                this.horarioFimCalculado = fim.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
                this.form.horario_fim = this.horarioFimCalculado;
            }
        }
    }
};
</script>
