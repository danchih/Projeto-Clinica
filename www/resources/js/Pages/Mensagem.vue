<template>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Olá, {{ $page.props.auth.user.nome }}
        </h2>
      </template>
      <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4 text-center">Lista de Consultas</h1>
        <div class="overflow-x-auto">
          <table class="min-w-full bg-white border">
            <thead>
              <tr>
                <th class="px-4 py-2 border">Paciente</th>
                <th class="px-4 py-2 border">Psicologo</th>
                <th class="px-4 py-2 border">Data</th>
                <th class="px-4 py-2 border">Horario de Inicio</th>
                <th class="px-4 py-2 border">Horario de Fim</th>
                <th class="px-4 py-2 border">Avisar Chegada</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="consulta in consultas" :key="consulta.id" class="hover:bg-gray-100 text-center">
                <td class="px-4 py-2 border">{{ consulta.paciente.nome }}</td>
                <td class="px-4 py-2 border">{{ consulta.user.nome }}</td>
                <td class="px-4 py-2 border">{{ consulta.data }}</td>
                <td class="px-4 py-2 border">{{ consulta.horario_inicio }}</td>
                <td class="px-4 py-2 border">{{ consulta.horario_fim }}</td>
                <td class="px-4 py-2 border">
                  <button @click="pacienteChegou(consulta)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Avisar que paciente chegou</button>
                </td>
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
    axios.get('/allconsultas')
      .then(response => {
        consultas.value = response.data.map(consulta => ({ ...consulta, editing: false }));
      })
      .catch(error => {
        console.error('Error fetching consultations:', error);
      });
  };
  
  const pacienteChegou = async (consulta) => {
    if (!consulta || !consulta.id) {
      console.error('Consulta ou ID da consulta não definido');
      return;
    }
    try {
      const response = await axios.post('/paciente-chegou', { paciente_id: consulta.paciente.id, paciente_nome: consulta.paciente.nome, psicologo_id: consulta.user.id });
      alert(response.data.message);
    } catch (error) {
      console.error('Erro ao enviar aviso:', error);
    }
  };
  </script>
  