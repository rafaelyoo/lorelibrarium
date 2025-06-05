<script setup lang="ts">
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Livros',
        href: '/books',
    },
];

const props = defineProps({
    book: Object
});

const form = useForm({
    Titulo: props.book.Titulo,
    Editora: props.book.Editora,
    Edicao: props.book.Edicao,
    AnoPublicacao: props.book.AnoPublicacao,
    Preco: props.book.Preco,
    autores: [],
    assuntos: [],
    removerAutores: [],
    removerAssuntos: []
});

const submit = () => {
    form.autores = autores;
    form.assuntos = assuntos;
    form.removerAutores = autoresRemovidos;
    form.removerAssuntos = assuntosRemovidos;
    form.put(route('books.update', props.book.CodI), {
        preserveScroll: true,
        onSucess: () => form.reset()
    });
};

const autores = ref<string[]>([]);
const autoresRemovidos = ref<string[]>([]);
const novoAutor = ref('');

const assuntos = ref<string[]>([]);
const assuntosRemovidos = ref<string[]>([]);
const novoAssunto = ref('');

const adicionarAutor = () => {
    let autorLimpo = novoAutor.value.trim();

    if (autorLimpo !== '') {
        if (autorLimpo.length > 40) {
            autorLimpo = autorLimpo.slice(0, 40);
        }

        if (!autores.value.includes(autorLimpo)) {
            autores.value.push(autorLimpo);
        }

        novoAutor.value = '';
    }
};

const removerAutor = (index: number) => {
  const [removido] = autores.value.splice(index, 1);
  autoresRemovidos.value.push(removido);
};

const adicionarAssunto = () => {
    let assuntoLimpo = novoAssunto.value.trim();

    if (assuntoLimpo !== '') {
        if (assuntoLimpo.length > 20) {
            assuntoLimpo = assuntoLimpo.slice(0, 20);
        }

        if (!assuntos.value.includes(assuntoLimpo)) {
            assuntos.value.push(assuntoLimpo);
        }

        novoAssunto.value = '';
    }
};

const removerAssunto = (index: number) => {
  const [removido] = assuntos.value.splice(index, 1);
  assuntosRemovidos.value.push(removido);
};

const validateYear = () => {
  const AnoPublicacaoStr = form.AnoPublicacao.toString();
  if (AnoPublicacaoStr.length > 4) {
    form.AnoPublicacao = parseInt(AnoPublicacaoStr.slice(0, 4));
  }
};

autores.value = props.book.authors.map(a => a.Nome);
assuntos.value = props.book.subjects.map(s => s.Descricao);

</script>

<template>
    <Head title="Editar Livro" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <h1 class="text-2xl font-bold mb-4">Livro</h1>

            <form @submit.prevent="submit" class="flex flex-col gap-6">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="Título">Título</Label>
                        <Input id="Titulo" type="text" autofocus :tabindex="1" v-model="form.Titulo" placeholder="" />
                        <InputError :message="form.errors.Titulo" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="Editora">Editora</Label>
                        <Input id="Editora" type="text" :tabindex="2" v-model="form.Editora" placeholder="" />
                        <InputError :message="form.errors.Editora" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="Edição">Edição</Label>
                        <input
                            v-model="form.Edicao"
                            :tabindex="3"
                            type="number"
                            min="1"
                            max="9999999999999"
                            placeholder="1"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                        />
                        <InputError :message="form.errors.Edicao" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="Ano de publicação">Ano de publicação</Label>
                        <input
                            v-model="form.AnoPublicacao"
                            :tabindex="4"
                            type="number"
                            min="1000"
                            max="9999"
                            placeholder="2025"
                            @input="validateYear"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                        />
                        <InputError :message="form.errors.AnoPublicacao" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="price">Preço</Label>
                        <input
                            v-model="form.Preco"
                            :tabindex="5"
                            type="number"
                            step="0.01"
                            min="0"
                            placeholder="0.00"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                        />
                        <InputError :message="form.errors.Preco" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Autores</label>
                        <div class="flex flex-wrap gap-2 border border-gray-300 p-2 rounded">
                            <span
                            v-for="(autor, index) in autores"
                            :key="index"
                            class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs flex items-center"
                            >
                            {{ autor }}
                            <button
                                @click="removerAutor(index)"
                                class="ml-1 text-red-500 hover:text-red-700"
                            >
                                &times;
                            </button>
                            </span>
                            <input
                            v-model="novoAutor"
                            :tabindex="6"
                            @keydown.enter.prevent="adicionarAutor"
                            @blur="adicionarAutor"
                            placeholder="Digite e pressione Enter..."
                            class="flex-1 border-none focus:ring-0 text-sm"
                            />
                        </div>
                        </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Assuntos</label>
                        <div class="flex flex-wrap gap-2 border border-gray-300 p-2 rounded">
                            <span
                            v-for="(assunto, index) in assuntos"
                            :key="index"
                            class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs flex items-center"
                            >
                            {{ assunto }}
                            <button
                                @click="removerAssunto(index)"
                                class="ml-1 text-red-500 hover:text-red-700"
                            >
                                &times;
                            </button>
                            </span>
                            <input
                            v-model="novoAssunto"
                            :tabindex="7"
                            @keydown.enter.prevent="adicionarAssunto"
                            @blur="adicionarAssunto"
                            placeholder="Digite e pressione Enter..."
                            class="flex-1 border-none focus:ring-0 text-sm"
                            />
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <Button :tabindex="8">Salvar</Button>

                        <Link :tabindex="9" href="/books" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            Voltar
                        </Link>
                    </div>
                </div>
            </form>
        </div>
    </AppLayout>
</template>