<template>
    <div>
        <p v-if="mensagem">{{ mensagem }}</p>
    </div>
</template>

<script>
import Pusher from 'pusher-js';

export default {
    props: {
        pusherKey: String,
        pusherCluster: String
    },
    data() {
        return {
            mensagem: ''
        };
    },
    mounted() {
        // Certifique-se de que o Pusher está disponível antes de usar
        if (typeof Pusher === 'undefined') {
            console.error('Pusher is not defined');
            return;
        }

        // Inicialize o Pusher
        const pusher = new Pusher('4243b598e31c20dcb0f9', {
            cluster: 'ap1'
        });

        // Subscreva ao canal
        const channel = pusher.subscribe('paciente-chegou');

        // Escute os eventos do canal
        channel.bind('paciente.chegou', (data) => {
            // Processar o evento recebido
            this.mensagem = `O paciente ${data.paciente.nome} chegou.`;
        });
    }
};
</script>
