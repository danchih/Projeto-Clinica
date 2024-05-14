<template>
    <div class="bg-gray-100 min-h-screen flex flex-col">
      <Navbar />
      <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
          <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Clínica de Psicologia</h1>
          <div class="text-lg text-gray-700 leading-relaxed text-center">
            <p>
              Nossa equipe está empenhada em proporcionar um ambiente acolhedor e um atendimento eficaz para nossos clientes, visando o bem-estar e a saúde mental de cada um deles. 
              Nosso compromisso se estende a oferecer um suporte clínico qualificado, utilizando métodos específicos adaptados para diversas situações individuais.
              Na Clínica de Psicologia, contamos com profissionais especializados em diferentes abordagens terapêuticas, garantindo uma ampla gama de recursos para atender às necessidades de cada paciente. Oferecemos sessões de terapia individuais, 
              terapia de casal e familiar, bem como acompanhamento psicológico em situações específicas.
              Nossos serviços incluem um ambiente acolhedor e seguro para as sessões, uma variedade de recursos terapêuticos, como testes psicológicos e técnicas de intervenção comprovadas, e profissionais qualificados em diversas áreas da Psicologia Clínica.
              Para agendar uma consulta, entre em contato conosco por telefone, estamos disponíveis 6 dias por semana (sujeito à disponibilidade de horários).
              Estamos prontos para ajudá-lo a dar o primeiro passo em direção a uma vida mais equilibrada e saudável.
            </p>
            <p class="mt-8">
              <strong>Contate-nos:</strong> Telefone: (19) 98210-1158 / (19) 99274-6359
            </p>
            <p class="mb-12">
              Agende sua consulta hoje e permita-se surpreender com os nossos serviços dedicados ao seu bem-estar psicológico.
            </p>


            <p id="descricao" class="mt-8">
              <strong> Descrição do Projeto:</strong> Somos uma clínica de psicologia e necessitamos desenvolver um sistema que seja usado pelos nossos clientes para nos encontrarem na internet e também para nos conhecerem!
            Esse sistema também deve ser utilizado pelos profissionais da clínica (psicólogos e atendentes), existindo a possibilidade de consultar e acrescentar informações dos clientes (cada profissional com sua devida permissão de acesso e visualização).
            </p>

            <p id="depoimentos" class="mt-8">
              <strong> Depoimentos:</strong> Somos uma clínica de psicologia e necessitamos desenvolver um sistema que seja usado pelos nossos clientes para nos encontrarem na internet e também para nos conhecerem!
            Esse sistema também deve ser utilizado pelos profissionais da clínica (psicólogos e atendentes), existindo a possibilidade de consultar e acrescentar informações dos clientes (cada profissional com sua devida permissão de acesso e visualização).
            </p>

            <p id="contato" class="mt-8">
            <strong> Entre em contato</strong>
            </p>

          </div>
        </div>
      </div>
            <p id="contatos" class="mt-8">
            <Fimdapagina />
            </p>
            
    </div>
  </template>
  
  <script setup>
  import Navbar from './Navbar.vue';
  import Fimdapagina from './Fimdapagina.vue';
  import { Head } from '@inertiajs/inertia-vue3';
  defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  })
  </script>
  
  <style scoped>
  /* Estilos personalizados */
  .container {
    /* Adicione estilos de largura e margens aqui, conforme necessário */
  }
  </style>