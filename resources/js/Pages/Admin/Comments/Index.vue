<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-grey-800 leading-tight">
                Comments
            </h2>
        </template>
        <div class="py-12 text-grey-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 sm:px-20 bg-white flex items-center justify-between"
                    >
                        <h1 class="text-lg font-semibold tracking-widest">
                            Comments
                        </h1>
                    </div>
                    <div class="flex flex-col p-6 sm:px-10">
                        <table>
                            <thead>
                                <tr class="border-b border-grey-500 ">
                                    <th class="pb-2">#</th>
                                    <th class="pb-2">Name</th>
                                    <th class="pb-2">Film</th>
                                    <th class="pb-2">Body</th>
                                    <th class="pb-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="comment in comments.data"
                                    :key="comment.id"
                                >
                                    <td class="text-center py-2">
                                        {{ comment.id }}
                                    </td>
                                    <td
                                        class="text-center py-2 flex items-center justify-center"
                                    >
                                        <img
                                            :src="
                                                comment.user.profile_photo_url
                                            "
                                            class="w-8 h-8 rounded-full object-cover"
                                            alt=""
                                            srcset=""
                                        />
                                        <span class="ml-2">{{
                                            comment.user.name
                                        }}</span>
                                    </td>
                                    <td class="text-center py-2">
                                        {{ comment.commentable.title }}
                                    </td>
                                    <td class="text-center py-2">
                                        {{ comment.body }}
                                    </td>
                                    <td class="text-center py-2">
                                        <inertia-link
                                            class="px-2 py-1 text-blue border text-center mr-2 rounded-lg border-blue"
                                            :href="
                                                route('admin.comments.edit', {
                                                    comment: comment.id
                                                })
                                            "
                                        >
                                            Edit
                                        </inertia-link>
                                        <button
                                            class="px-2 py-1 text-red border rounded-lg border-red"
                                            @click="deleteComment(comment.id)"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination class="mt-6" :links="comments.links" />
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
        comments: Object
    },
    components: {
        AppLayout,
        ChevronRightIcon,
        Pagination
    },
    methods: {
        deleteComment(id) {
            let form = this.$inertia.form({
                id
            });
            form.delete(route("admin.comments.destroy", id), {
                preserveScroll: true,
                preserveState: true,
                forceFormData: true,
                onSuccess: () => {
                    this.$vToastify.success("Comment is removed");
                }
            });
        }
    }
};
</script>

<style></style>
