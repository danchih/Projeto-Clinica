<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

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
            <h3>secretaria aqui</h3>
        </div>

        <div v-if="$page.props.user.roles.includes('psicologo')">
            <h3>psicologo aqui</h3>
        </div>
        
        <div v-if="$page.props.user.roles.includes('cliente')">
            <h3>cliente aqui</h3>
        </div>

    </AuthenticatedLayout>
</template>
