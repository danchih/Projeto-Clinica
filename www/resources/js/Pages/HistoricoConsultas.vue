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
              <div class="carousel">
                <div v-for="consulta in consultas" :key="consulta.id" class="slide">
                  <h3>{{ consulta.data }}</h3>
                  <h3>{{ consulta.horario_inicio }} às {{ consulta.horario_fim }}</h3>
                  <p>Psicólogo: {{ consulta.psicologo.nome }}</p>
                </div>
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
  
  </script>
  
  <style scoped>
  .carousel {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
  }
  
  .slide {
    flex: 0 0 auto;
    width: 300px;
    scroll-snap-align: start;
    margin-right: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  </style>
  