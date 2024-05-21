<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Pagina do Cliente" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Olá, {{ $page.props.auth.user.name }}
            </h2>
        </template>

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
    </AuthenticatedLayout>
</template>
