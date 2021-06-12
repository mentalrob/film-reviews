<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-grey-800 leading-tight">
                Films
            </h2>
        </template>
        <div class="py-12 text-grey-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 sm:px-20 bg-white flex items-center justify-between"
                    >
                        <h1 class="text-lg font-semibold tracking-widest">
                            Films
                        </h1>
                        <inertia-link
                            class="text-center border border-green rounded-lg text-green px-2 py-1"
                            :href="route('admin.films.create')"
                        >
                            Create
                        </inertia-link>
                    </div>
                    <div class="flex flex-col p-6 sm:px-10">
                        <table>
                            <thead>
                                <tr class="border-b border-grey-500 ">
                                    <th class="pb-2">#</th>
                                    <th class="pb-2">Poster</th>
                                    <th class="pb-2">Title</th>
                                    <th class="pb-2">Writer</th>
                                    <th class="pb-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="film in films.data" :key="film.id">
                                    <td class="text-center py-2">
                                        {{ film.id }}
                                    </td>
                                    <td class="text-center py-2">
                                        <img
                                            class="object-scale-down h-24 w-full"
                                            :src="film.poster"
                                            alt=""
                                        />
                                    </td>
                                    <td class="text-center py-2">
                                        {{ film.title }}
                                    </td>
                                    <td class="text-center py-2">
                                        {{ film.writer }}
                                    </td>
                                    <td class="text-center py-2">
                                        <inertia-link
                                            class="px-2 py-1 text-blue border text-center mr-2 rounded-lg border-blue"
                                            :href="
                                                route('admin.films.edit', {
                                                    film: film.id
                                                })
                                            "
                                        >
                                            Edit
                                        </inertia-link>
                                        <button
                                            class="px-2 py-1 text-red border rounded-lg border-red"
                                            @click="deleteFilm(film.id)"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination class="mt-6" :links="films.links" />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { ChevronRightIcon } from "vue-feather-icons";
export default {
    props: {
        films: Object
    },
    components: {
        AppLayout,
        ChevronRightIcon,
        Pagination
    },
    methods: {
        deleteFilm(id) {
            let form = this.$inertia.form({
                id
            });
            form.delete(route("admin.films.destroy", id), {
                preserveScroll: true,
                preserveState: true,
                forceFormData: true,
                onSuccess: () => {
                    this.$vToastify.success("Film is removed");
                }
            });
        }
    }
};
</script>

<style></style>
