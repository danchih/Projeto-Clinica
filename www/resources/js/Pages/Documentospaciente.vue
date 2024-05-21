<template>
  <div class="container mx-auto py-8 flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4">Documentos de pacientes</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="bg-white p-4 rounded shadow text-center">
        <h2 class="text-xl font-semibold mb-2">Encaminhamentos</h2>
        <!-- Conteúdo do componente -->
        <textarea v-model="encaminhamentos" class="w-full px-3 py-2 text-base leading-6 text-gray-700 border rounded-lg focus:outline-none focus:ring" rows="10"></textarea>
        <button @click="salvarDocumento('encaminhamentos')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 text-center">Salvar Encaminhamentos</button>
        <button @click="exportarPDF('encaminhamentos')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Exportar PDF</button>
      </div>
      <div class="bg-white p-4 rounded shadow text-center">
        <h2 class="text-xl font-semibold mb-2">Atestados de Atendimento</h2>
        <!-- Conteúdo do componente -->
        <textarea v-model="atestados" class="w-full px-3 py-2 text-base leading-6 text-gray-700 border rounded-lg focus:outline-none focus:ring" rows="10"></textarea>
        <button @click="salvarDocumento('atestados')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Salvar Atestados de Atendimento</button>
        <button @click="exportarPDF('atestados')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Exportar PDF</button>
      </div>
    </div>

    <!-- Modais -->
    <div v-if="modalAberto" class="fixed z-10 inset-0 overflow-y-auto">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m4-4H9m4 8H9m12 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Texto Salvo</h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">{{ textoSalvo }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button @click="fecharModal" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Fechar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import jsPDF from 'jspdf'; // biblioteca para salvar em pdf 

export default {
  data() {
    return {
      encaminhamentos: 'Eu, Psicóloga encaminho o paciente (nome) para...',
      atestados: 'Psicólogo(a) O paciente (nome) esteve em consulta comigo durante o horario ()',
      modalAberto: false,
      textoSalvo: ''
    }
  },
  methods: {
    salvarDocumento(tipo) {
      
      this.textoSalvo = tipo === 'encaminhamentos' ? this.encaminhamentos : this.atestados;
      this.modalAberto = true;
    },
    fecharModal() {
      this.modalAberto = false;
      this.textoSalvo = '';
    },
    exportarPDF(tipo) {
      const doc = new jsPDF();
      const texto = tipo === 'encaminhamentos' ? this.encaminhamentos : this.atestados;
      doc.text(texto, 10, 10);
      doc.save(`${tipo}.pdf`);
    }
  }
}
</script>

<style scoped>
/* Seu CSS local aqui */
</style>
