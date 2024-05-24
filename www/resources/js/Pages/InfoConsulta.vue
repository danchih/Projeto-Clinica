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
              <th class="px-4 py-2 border">Nome</th>
              <th class="px-4 py-2 border">Data</th>
              <th class="px-4 py-2 border">Horário de início</th>
              <th class="px-4 py-2 border">Horário de fim</th>
              <th class="px-4 py-2 border">Informação</th>
              <th class="px-4 py-2 border">Editar Informações</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="consulta in consultas" :key="consulta.id" class="hover:bg-gray-100 text-center">
              <td class="px-4 py-2 border">{{ consulta.paciente.nome }}</td>
              <td class="px-4 py-2 border">{{ consulta.data }}</td>
              <td class="px-4 py-2 border">{{ consulta.horario_inicio }}</td>
              <td class="px-4 py-2 border">{{ consulta.horario_fim }}</td>
              <td class="px-4 py-2 border">
                <div v-if="consulta.editing">
                  <input v-model="consulta.informacao" class="border rounded px-2 py-1" />
                </div>
                <div v-else>
                  {{ consulta.informacao }}
                </div>
              </td>
              <td class="px-4 py-2 border">
                <button v-if="consulta.editing" @click="saveConsulta(consulta)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Salvar</button>
                <button v-else @click="editConsulta(consulta)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Editar</button>
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
  axios.get('/consultas')
    .then(response => {
      // Adicionar o campo `editing` a cada consulta
      consultas.value = response.data.map(consulta => ({ ...consulta, editing: false }));
    })
    .catch(error => {
      console.error('Error fetching consultations:', error);
    });
};

const editConsulta = (consulta) => {
  consulta.editing = true;
};

const saveConsulta = (consulta) => {
  axios.put(`/consultas/${consulta.id}`, { informacao: consulta.informacao })
    .then(() => {
      consulta.editing = false;
    })
    .catch(error => {
      console.error('Error saving consultation:', error);
    });
};
</script>
