<template>
    <!-- Código do formulário de cadastro -->
    <button @click="pacienteChegou(paciente?.id)">Avisar que paciente chegou</button>
</template>

<script>
import axios from 'axios';
import Pusher from 'pusher-js';

export default {
    props: {
        pusherKey: String,
        pusherCluster: String
    },
    data() {
        return {
            paciente: null, // Inicialmente null
        };
    },
    methods: {
        async pacienteChegou(pacienteId) {
            if (!pacienteId) {
                console.error('Paciente ID não definido');
                return;
            }
            try {
                const response = await axios.post('/paciente-chegou', { paciente_id: pacienteId });
                alert(response.data.message);
            } catch (error) {
                console.error('Erro ao enviar aviso:', error);
            }
        }
    },
    mounted() {
        // Simulando a definição do paciente. Substitua isso pelo seu próprio método de obtenção do paciente.
        this.paciente = {
            id: 1,
            nome: 'John Doe'
        };
    }
};
</script>
