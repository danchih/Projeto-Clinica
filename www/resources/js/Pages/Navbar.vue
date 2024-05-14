<!-- resources/js/Components/Navbar.vue -->
<template>
  <nav class="bg-gray-800 p-4">
    <div class="container mx-auto">
      <div class="flex items-center justify-between">
        <a href="/" class="text-white font-bold hover:underline">Clínica de psicologia</a>
        <div>
          <a href="#descricao"><button @click="scrollToContato" class="text-white font-bold hover:underline ">Descrição</button></a>
          <a href="#depoimentos"><button @click="scrollToContato" class="text-white font-bold hover:underline ml-4">Depoimentos</button></a>
          <a href="#contatos"><button @click="scrollToContato" class="text-white font-bold hover:underline ml-4">Contatos</button></a>
          <a href="#contatos"><button @click="scrollToContato" class="text-white font-bold hover:underline ml-4">Entre em contato</button></a>
          <a href="/login" class="text-white font-bold hover:underline ml-4">Login</a>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
  // Se necessário, você pode passar propriedades para a barra de navegação aqui
});
</script>

<style scoped>
/* Estilos específicos para a Navbar */
</style>