<template>
    <div>
        <ul>
            <li v-for="(notificacao, index) in notificacoes" :key="index">
                <span>{{ notificacao }}</span><span>{{ notificacao.mensagem }}</span>
                <button @click="marcarComoLida(notificacao.id)">Marcar como lida</button>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            notificacoes: [],
            polling: null,
        };
    },
    mounted() {
        this.verificarNotificacoes();
        // Configure o polling para verificar notificações a cada 10 segundos
        this.polling = setInterval(this.verificarNotificacoes, 10000); // 10 segundos
    },
    methods: {
        async verificarNotificacoes() {
            try {
                const response = await axios.get('/verificar-notificacoes');
                this.notificacoes = response.data;
            } catch (error) {
                console.error('Erro ao verificar notificações:', error);
            }
        },
        async marcarComoLida(notificacaoId) {
            try {
                const response = await axios.post('/marcar-notificacao-como-lida', { id: notificacaoId });
                console.log(response.data.message);
                // Remova a notificação da lista após marcá-la como lida
                this.notificacoes = this.notificacoes.filter(notificacao => notificacao.id !== notificacaoId);
            } catch (error) {
                console.error('Erro ao marcar notificação como lida:', error);
            }
        }
    },
    beforeDestroy() {
        clearInterval(this.polling);
    }
};
</script>
