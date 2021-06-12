<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-grey-800 leading-tight">
                Admin Dashboard
            </h2>
        </template>
        <div class="py-12 text-grey-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white">
                        <h1 class="text-lg font-semibold tracking-widest">
                            Items
                        </h1>
                    </div>
                    <div class="flex flex-col sm:px-10">
                        <inertia-link
                            class="text-grey-800 text-xl mb-4 p-6 sm:px-10 rounded-lg border border-grey-500 shadow flex items-center justify-between"
                            :href="route('admin.films.index')"
                        >
                            <span>Films</span>
                            <ChevronRightIcon />
                        </inertia-link>
                        <inertia-link
                            class="text-grey-800 text-xl mb-4 p-6 sm:px-10 rounded-lg border border-grey-500 shadow flex items-center justify-between"
                            href="/"
                        >
                            <span>Users</span>
                            <ChevronRightIcon />
                        </inertia-link>
                        <inertia-link
                            class="text-grey-800 text-xl mb-4 p-6 sm:px-10 rounded-lg border border-grey-500 shadow flex items-center justify-between"
                            href="/"
                        >
                            <span>Reviews</span>
                            <ChevronRightIcon />
                        </inertia-link>
                        <inertia-link
                            class="text-grey-800 text-xl mb-4 p-6 sm:px-10 rounded-lg border border-grey-500 shadow flex items-center justify-between"
                            href="/"
                        >
                            <span>Comments</span>
                            <ChevronRightIcon />
                        </inertia-link>
                        <inertia-link
                            class="text-grey-800 text-xl mb-4 p-6 sm:px-10 rounded-lg border border-grey-500 shadow flex items-center justify-between"
                            href="/"
                        >
                            <span>Roles</span>
                            <ChevronRightIcon />
                        </inertia-link>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ChevronRightIcon } from "vue-feather-icons";
export default {
    components: {
        AppLayout,
        ChevronRightIcon
    }
};
</script>

<style></style>
