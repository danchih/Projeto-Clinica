<template>
    <div>
        <!-- Botão para sinalizar que o paciente chegou -->
        <button @click="pacienteChegou(pacienteId)">Avisar que paciente chegou</button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            pacienteId: 1 // ID do paciente. Pode ser obtido de qualquer forma necessária
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
    }
};
</script>
