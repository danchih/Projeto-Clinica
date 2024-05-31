<template>
    <p>Teste Flavia</p>
    <div>
        <ul>
            <li v-for="(notificacao, index) in notificacoes" :key="index">{{ notificacao }}</li>
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
                const novasNotificacoes = response.data;
                if (novasNotificacoes.length > 0) {
                    this.notificacoes.push(...novasNotificacoes);
                }
            } catch (error) {
                console.error('Erro ao verificar notificações:', error);
            }
        }
    },
    beforeDestroy() {
        clearInterval(this.polling);
    }
};
</script>
