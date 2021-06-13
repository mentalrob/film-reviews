<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-grey-800 leading-tight">
                Reviews
            </h2>
        </template>
        <div class="py-12 text-grey-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 sm:px-20 bg-white flex items-center justify-between"
                    >
                        <h1 class="text-lg font-semibold tracking-widest">
                            Reviews
                        </h1>
                    </div>
                    <div class="flex flex-col p-6 sm:px-10">
                        <table>
                            <thead>
                                <tr class="border-b border-grey-500 ">
                                    <th class="pb-2">#</th>
                                    <th class="pb-2">Name</th>
                                    <th class="pb-2">Film</th>
                                    <th class="pb-2">Rate</th>
                                    <th class="pb-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="review in reviews.data"
                                    :key="review.id"
                                >
                                    <td class="text-center py-2">
                                        {{ review.id }}
                                    </td>
                                    <td
                                        class="text-center py-2 flex items-center justify-center"
                                    >
                                        <img
                                            :src="review.user.profile_photo_url"
                                            class="w-8 h-8 rounded-full object-cover"
                                            alt=""
                                            srcset=""
                                        />
                                        <span class="ml-2">{{
                                            review.user.name
                                        }}</span>
                                    </td>
                                    <td class="text-center py-2">
                                        {{ review.film.title }}
                                    </td>
                                    <td class="text-center py-2">
                                        {{ review.rate }}
                                    </td>
                                    <td class="text-center py-2">
                                        <inertia-link
                                            class="px-2 py-1 text-blue border text-center mr-2 rounded-lg border-blue"
                                            :href="
                                                route('admin.reviews.edit', {
                                                    review: review.id
                                                })
                                            "
                                        >
                                            Edit
                                        </inertia-link>
                                        <button
                                            class="px-2 py-1 text-red border rounded-lg border-red"
                                            @click="deleteReview(review.id)"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination class="mt-6" :links="reviews.links" />
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
        reviews: Object
    },
    components: {
        AppLayout,
        ChevronRightIcon,
        Pagination
    },
    methods: {
        deleteReview(id) {
            let form = this.$inertia.form({
                id
            });
            form.delete(route("admin.reviews.destroy", id), {
                preserveScroll: true,
                preserveState: true,
                forceFormData: true,
                onSuccess: () => {
                    this.$vToastify.success("Review is removed");
                }
            });
        }
    }
};
</script>

<style></style>
