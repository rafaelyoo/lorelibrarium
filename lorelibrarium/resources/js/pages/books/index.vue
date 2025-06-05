<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Livros',
        href: '/books',
    },
];

const props = defineProps({
    books: Array
});

const editarLivro = (id: number) => {
    console.log('Editar livro:', id);
    // Ex.: this.$inertia.visit(`/books/${id}/edit`);
};

const removerLivro = (id: number) => {
    console.log('Remover livro:', id);
    // Ex.: this.$inertia.delete(`/books/${id}`);
};

const form = useForm();

function deleteBook(id) {
    if (confirm("Tem certeza que deseja excluir?")) {
        form.delete(route('books.destroy', id), {
            preserveScroll:true
        })
    }
}
</script>

<template>
    <Head title="Livros" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <h1 class="text-2xl font-bold mb-4">Livros</h1>

            <div>
                <Link href="/books/create" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-blue-600 transition">
                    Criar
                </Link>
            </div>

            <table class="min-w-full divide-y divide-gray-200 bg-white rounded shadow">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Editora</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Edição</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Publicação</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Preço</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Autores</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Assuntos</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="book in books" :key="book.id">
                    <td class="px-4 py-2 text-sm text-gray-900">{{ book.Titulo }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ book.Editora }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ book.Edicao }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ book.AnoPublicacao }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ book.Preco }}</td> 
                    <td class="px-4 py-2 text-sm text-gray-900">
                        {{ book.authors.map(a => a.Nome).join(', ') }}
                    </td>                   
                    <td class="px-4 py-2 text-sm text-gray-900">      
                        {{ book.subjects.map(s => s.Descricao).join(', ') }}
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-900 space-x-2">
                    <Link :href="`books/${book.CodI}/edit`" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                        Editar
                    </Link>
                    <Link @click="deleteBook(book.CodI)" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                        Remover
                    </Link>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
