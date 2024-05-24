<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Histórico de Consultas
      </h2>
    </template>

    <div class="py-10">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="divide-y divide-gray-200">
              <template v-if="consultas.length === 0">
                <div class="py-2 text-center text-gray-800 text-base">
                  Não existe um histórico de consultas.
                </div>
              </template>
              <template v-else v-for="consulta in consultas" :key="consulta.id">
                <div class="py-4 flex space-x-3">
                  <div class="flex-shrink-0">
                    <div class="h-8 w-8 rounded-full bg-info-100 flex items-center justify-center text-info-700">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path
                          fill-rule="evenodd"
                          d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                          clip-rule="evenodd" />
                      </svg>
                    </div>
                  </div>
                  <div class="flex-1">
                    <p class="text-sm text-gray-500">{{ formatDate(consulta.data) }}</p>
                    <h3 class="text-lg font-medium text-gray-900">{{ formatTime(consulta.horario_inicio) }} às {{ formatTime(consulta.horario_fim) }}</h3>
                    <p class="text-gray-500">Dr(a). {{ consulta.user.nome }}</p>
                  </div>
                </div>
                
                <!--
                <div v-if="$page.props.user.roles.includes('psicologo')">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Editar</button>
                </div>
                -->
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
  import { ref, defineProps } from 'vue';
  import { Head } from '@inertiajs/inertia-vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

  const props = defineProps({
    consultas: {
      type: Array,
      required: true,
    },
  });

  // Função para formatar a data
  const formatDate = (date) => {
    const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
    const adjustedDate = new Date(date);
    adjustedDate.setDate(adjustedDate.getDate() + 1); // Ajuste para corrigir o dia exibido

    return adjustedDate.toLocaleDateString('pt-BR', options);
  };

  // Função para formatar o horário
  const formatTime = (time) => {
    const [hour, minute] = time.split(':');
    return `${hour}:${minute}`;
  };
  
</script>

<style scoped>
/* Estilos adicionais conforme necessário */
</style>