<template>
    <div class="max-w-2xl mx-auto py-10">
      <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">Adicione Informações da Sessão</h2>
        <form @submit.prevent="submitForm">
          <div class="mb-4">
            <template v-for="consulta in consultas" :key="consulta.id">
            <p class="text-gray-500">{{ consulta.psicologo.nome }}</p>
            <p class="text-gray-500">{{ consulta.paciente.nome }}</p>
            </template>
            <label for="informacao" class="block text-gray-700">Informações</label>
            <textarea 
              id="informacao" 
              v-model="informacao" 
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
              rows="5"
              required
            ></textarea>
          </div>
          <div class="flex justify-end">
            <button 
              type="submit" 
              class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
            >
              Salvar
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useForm } from '@inertiajs/inertia-vue3';
  
  const informacao = ref('');
  
  const submitForm = () => {
    const form = useForm({
      informacao: informacao.value,
    });
  
    form.post('/caminho/para/salvar/informacao', {
      onSuccess: () => {
        // Limpa o campo após o sucesso
        informacao.value = '';
        // Exibe uma mensagem de sucesso ou toma outras ações necessárias
        alert('Informações salvas com sucesso!');
      },
    });
  };
  </script>
  
  <style scoped>
  /* Estilos adicionais, se necessário */
  </style>
  