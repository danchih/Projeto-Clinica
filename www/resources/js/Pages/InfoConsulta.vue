<template>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Olá, {{ $page.props.auth.user.nome }}
        </h2>
      </template>
      <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4 text-center">Histórico de Consultas</h1>
        <div class="overflow-x-auto">
          <table class="min-w-full bg-white border">
            <thead>
              <tr>
                <th class="px-4 py-2 border">Id</th>
                <th class="px-4 py-2 border">Data</th>
                <th class="px-4 py-2 border">Horário de início</th>
                <th class="px-4 py-2 border">Horário de fim</th>
                <th class="px-4 py-2 border">Informação</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="consulta in consultas" :key="consulta.id" class="hover:bg-gray-100 text-center">
                <td class="px-4 py-2 border">{{ consulta.id }}</td>
                <td class="px-4 py-2 border">{{ consulta.data }}</td>
                <td class="px-4 py-2 border">{{ consulta.horario_inicio }}</td>
                <td class="px-4 py-2 border">{{ consulta.horario_fim }}</td>
                <td class="px-4 py-2 border">{{ consulta.informacao }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import axios from 'axios';
  
  const consultas = ref([]);
  
  onMounted(() => {
    fetchConsultas();
  });
  
  const fetchConsultas = () => {
    axios.get('/consultas')
      .then(response => {
        consultas.value = response.data;
      })
      .catch(error => {
        console.error('Error fetching consultations:', error);
      });
  };
  </script>
  
  <style scoped>
  /* Seu CSS local aqui */
  </style>