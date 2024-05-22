<template>
  <div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4 text-center">Lista de Pacientes</h1>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border">
        <thead>
          <tr>
            <th class="px-4 py-2 border">Nome</th>
            <th class="px-4 py-2 border">CEP</th>
            <th class="px-4 py-2 border">Endereço</th>
            <th class="px-4 py-2 border">Bairro</th>
            <th class="px-4 py-2 border">Cidade</th>
            <th class="px-4 py-2 border">Estado</th>
            <th class="px-4 py-2 border">Telefone</th>
            <th class="px-4 py-2 border">Editar Informações</th>
            <th class="px-4 py-2 border">Informações da sessão</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="paciente in pacientes" :key="paciente.id" class="hover:bg-gray-100 text-center">
            <td class="px-4 py-2 border">
              <input v-if="paciente.editing" v-model="paciente.nome" class="w-full px-2 py-1 border" />
              <span v-else>{{ paciente.nome }}</span>
            </td>
            <td class="px-4 py-2 border">
              <input v-if="paciente.editing" v-model="paciente.cep" @blur="preencherEndereco(paciente)" class="w-full px-2 py-1 border" />
              <span v-else>{{ paciente.cep }}</span>
            </td>
            <td class="px-4 py-2 border">
              <input v-if="paciente.editing" v-model="paciente.endereco" class="w-full px-2 py-1 border" />
              <span v-else>{{ paciente.endereco }}</span>
            </td>
            <td class="px-4 py-2 border">
              <input v-if="paciente.editing" v-model="paciente.bairro" class="w-full px-2 py-1 border" />
              <span v-else>{{ paciente.bairro }}</span>
            </td>
            <td class="px-4 py-2 border">
              <input v-if="paciente.editing" v-model="paciente.cidade" class="w-full px-2 py-1 border" />
              <span v-else>{{ paciente.cidade }}</span>
            </td>
            <td class="px-4 py-2 border">
              <input v-if="paciente.editing" v-model="paciente.estado" class="w-full px-2 py-1 border" />
              <span v-else>{{ paciente.estado }}</span>
            </td>
            <td class="px-4 py-2 border">
              <input v-if="paciente.editing" v-model="paciente.telefone" class="w-full px-2 py-1 border" />
              <span v-else>{{ paciente.telefone }}</span>
            </td>
            <td class="px-4 py-2 border">
              <button v-if="paciente.editing" @click="savePaciente(paciente)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Salvar</button>
              <button v-else @click="editPaciente(paciente)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Editar</button>
            </td>
            <td class="px-4 py-2 border">
              <button @click="abrirModalSessao(paciente)" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Informações</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Modal para Informações da Sessão -->
    <div v-if="modalAberto" class="fixed z-10 inset-0 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m4-4H9m4 8H9m12 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Informações da Sessão</h3>
                <div class="mt-2">
                  <textarea v-model="pacienteSessao" class="w-full px-3 py-2 text-base leading-6 text-gray-700 border rounded-lg focus:outline-none focus:ring" rows="10"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button @click="salvarSessao" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-yellow-500 text-base font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:ml-3 sm:w-auto sm:text-sm">Salvar</button>
            <button @click="fecharModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      pacientes: [],
      modalAberto: false,
      pacienteSessao: '',
      pacienteSelecionado: null
    };
  },
  created() {
    this.fetchPacientes();
  },
  methods: {
    fetchPacientes() {
      axios.get('/pacientes')
        .then(response => {
          this.pacientes = response.data.map(paciente => {
            return { ...paciente, editing: false };
          });
        })
        .catch(error => {
          console.error('Error fetching patients:', error);
        });
    },
    editPaciente(paciente) {
      paciente.editing = true;
    },

    async preencherEndereco(paciente) {
    if (paciente.cep.length === 8) {
        try {
            const response = await fetch(`https://viacep.com.br/ws/${paciente.cep}/json/`);
            const data = await response.json();
            if (data.erro) {
                console.error('CEP inválido.');
            } else {
                paciente.endereco = data.logradouro;
                paciente.bairro = data.bairro;
                paciente.cidade = data.localidade;
                paciente.estado = data.uf;
            }
        } catch (error) {
            console.error('Erro ao preencher endereço:', error);
        }
    }
},

    savePaciente(paciente) {
      axios.put(`/pacientes/${paciente.id}`, {
        nome: paciente.nome,
        cep: paciente.cep,
        endereco: paciente.endereco,
        bairro: paciente.bairro,
        cidade: paciente.cidade,
        estado: paciente.estado,
        telefone: paciente.telefone
      })
        .then(response => {
          paciente.editing = false;
          this.fetchPacientes();
        })
        .catch(error => {
          console.error('Error saving patient:', error);
        });
    },
    abrirModalSessao(paciente) {
      this.pacienteSessao = paciente.sessao || '';
      this.pacienteSelecionado = paciente;
      this.modalAberto = true;
    },
    salvarSessao() {
      axios.put(`/pacientes/${this.pacienteSelecionado.id}/sessao`, {
        sessao: this.pacienteSessao
      })
        .then(response => {
          this.pacienteSelecionado.sessao = this.pacienteSessao;
          this.fecharModal();
        })
        .catch(error => {
          console.error('Error saving session information:', error);
        }); }}}

</script>

<style scoped>
/* Seu CSS local aqui */
</style>
