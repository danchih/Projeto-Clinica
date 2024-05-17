<template>
    <Head title="Paciente"></Head>

    <div class="text-3xl text-gray-700 leading-relaxed text-center">
            <p class="mt-6">Cadastro de Pacientes</p>
    </div>

    <div class="leading-relaxed text-center max-w-md mx-auto">
    <form @submit.prevent="submit">
        <div class="mt-6">
            <label for="nome" class="block text-left mb-2">Nome:</label>
            <input type="text" v-model="form.nome" class="w-full px-3 py-2 border rounded" />
            <span v-if="errors.nome" class="text-red-500">{{ errors.nome[0] }}</span>
        </div>

        <div class="mt-2">
            <label for="endereco" class="block text-left mb-2">Endereco:</label>
            <input type="text" v-model="form.endereco" class="w-full px-3 py-2 border rounded" />
            <span v-if="errors.endereco">{{ errors.endereco[0] }}</span>
        </div>

        <div class="mt-2">
            <label for="telefone" class="block text-left mb-2">Telefone:</label>
            <input type="text" v-model="form.telefone" class="w-full px-3 py-2 border rounded" />
            <span v-if="errors.telefone">{{ errors.telefone[0] }}</span>
        </div>

        <div class="mt-2">
            <label for="login" class="block text-left mb-2">Login:</label>
            <input type="text" v-model="form.login" class="w-full px-3 py-2 border rounded" />
            <span v-if="errors.login">{{ errors.login[0] }}</span>
        </div>

        <div class="mt-2">
            <label for="senha" class="block text-left mb-2">Senha:</label>
            <input type="password" v-model="form.senha" class="w-full px-3 py-2 border rounded" />
            <span v-if="errors.senha">{{ errors.senha[0] }}</span>
        </div>

        <div class="mt-2">
            <button class="ml-4" :class="{ 'opacity-25': processing }" :disabled="processing">
                Cadastrar
            </button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                nome: '',
                endereco: '',
                telefone: '',
                login: '',
                senha: ''
            },
            errors: {},
            processing: false
        };
    },
    methods: {
        async submit() {
            this.processing = true;
            try {
                let response = await axios.post('/pacientes', this.form);
                alert(response.data.message);
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            } finally {
                this.processing = false;
            }
        }
    }
};
</script>
