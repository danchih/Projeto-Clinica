<template>
    <Head title="Paciente"></Head>

    <div class="text-3xl text-gray-700 leading-relaxed text-center">
        <p class="mt-6">Cadastro de Pacientes</p>
    </div>

    <div class="leading-relaxed text-center max-w-md mx-auto">
        <form @submit="submit">
            <div class="mt-6">
                <label for="nome" class="block text-left mb-2">Nome:</label>
                <input type="text" v-model="form.nome" class="w-full px-3 py-2 border rounded" />
                <span v-if="errors.nome" class="text-red-500">{{ errors.nome[0] }}</span>
            </div>

            <div class="mt-2">
                <label for="cep" class="block text-left mb-2">CEP:</label>
                <input type="text" v-model="form.cep" @blur="preencherEndereco" class="w-full px-3 py-2 border rounded" />
                <span v-if="errors.cep" class="text-red-500">{{ errors.cep[0] }}</span>
            </div>

            <div class="mt-2">
                <label for="endereco" class="block text-left mb-2">Endereço:</label>
                <input type="text" v-model="form.endereco" class="w-full px-3 py-2 border rounded" />
                <span v-if="errors.endereco" class="text-red-500">{{ errors.endereco[0] }}</span>
            </div>

            <div class="mt-2">
                <label for="bairro" class="block text-left mb-2">Bairro:</label>
                <input type="text" v-model="form.bairro" class="w-full px-3 py-2 border rounded" />
                <span v-if="errors.bairro" class="text-red-500">{{ errors.bairro[0] }}</span>
            </div>

            <div class="mt-2">
                <label for="cidade" class="block text-left mb-2">Cidade:</label>
                <input type="text" v-model="form.cidade" class="w-full px-3 py-2 border rounded" />
                <span v-if="errors.cidade" class="text-red-500">{{ errors.cidade[0] }}</span>
            </div>

            <div class="mt-2">
                <label for="estado" class="block text-left mb-2">Estado:</label>
                <input type="text" v-model="form.estado" class="w-full px-3 py-2 border rounded" />
                <span v-if="errors.estado" class="text-red-500">{{ errors.estado[0] }}</span>
            </div>

            <div class="mt-2">
                <label for="telefone" class="block text-left mb-2">Telefone:</label>
                <input type="text" v-model="form.telefone" class="w-full px-3 py-2 border rounded" />
                <span v-if="errors.telefone" class="text-red-500">{{ errors.telefone[0] }}</span>
            </div>

            <div class="mt-2">
                <label for="login" class="block text-left mb-2">Login:</label>
                <input type="text" v-model="form.login" class="w-full px-3 py-2 border rounded" />
                <span v-if="errors.login" class="text-red-500">{{ errors.login[0] }}</span>
            </div>

            <div class="mt-2">
                <label for="senha" class="block text-left mb-2">Senha:</label>
                <input type="password" v-model="form.senha" class="w-full px-3 py-2 border rounded" />
                <span v-if="errors.senha" class="text-red-500">{{ errors.senha[0] }}</span>
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
                cep: '',
                endereco: '',
                bairro: '',
                cidade: '',
                estado: '',
                telefone: '',
                login: '',
                senha: ''
            },
            errors: {},
            processing: false
        };
    },
    methods: {
        async preencherEndereco() {
            if (this.form.cep.length === 8) {
                try {
                    const response = await fetch(`https://viacep.com.br/ws/${this.form.cep}/json/`);
                    const data = await response.json();
                    if (data.erro) {
                        this.errors.cep = ['CEP inválido.'];
                    } else {
                        this.form.endereco = data.logradouro;
                        this.form.bairro = data.bairro;
                        this.form.cidade = data.localidade;
                        this.form.estado = data.uf;
                    }
                } catch (error) {
                    console.error('Erro ao preencher endereço:', error);
                }
            }
        },
        async submit(event) {
            event.preventDefault();
            this.processing = true;
            try {
                const response = await axios.post('/pacientes', this.form);
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
