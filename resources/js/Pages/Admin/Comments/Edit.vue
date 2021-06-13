<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-grey-800 leading-tight">
                Edit Comment
            </h2>
        </template>
        <div class="py-12 text-grey-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <jet-form-section @submitted="submit">
                            <template #title>
                                Edit Comment
                            </template>

                            <template #description>
                                Edit Comment #{{ comment.id }}
                            </template>

                            <template #form>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label for="body" value="body" />
                                    <jet-input
                                        id="body"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="commentForm.body"
                                        autofocus
                                    />
                                    <jet-input-error
                                        :message="commentForm.errors.body"
                                        class="mt-2"
                                    />
                                </div>
                            </template>

                            <template #actions>
                                <jet-action-message
                                    :on="commentForm.recentlySuccessful"
                                    class="mr-3"
                                >
                                    Updated.
                                </jet-action-message>

                                <jet-button
                                    :class="{
                                        'opacity-25': commentForm.processing
                                    }"
                                    :disabled="commentForm.processing"
                                >
                                    Update
                                </jet-button>
                            </template>
                        </jet-form-section>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import Pagination from "@/Components/Pagination.vue";
import { ChevronRightIcon } from "vue-feather-icons";
export default {
    props: {
        comment: Object
    },
    components: {
        AppLayout,
        ChevronRightIcon,
        JetFormSection,
        Pagination,
        JetButton,
        JetInput,
        JetLabel,
        JetInputError,
        JetActionMessage,
        JetSecondaryButton
    },
    methods: {
        submit() {
            this.commentForm.post(
                route("admin.comments.update", this.comment.id),
                {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        this.$vToastify.success("Comment is updated");
                    }
                }
            );
        }
    },
    data() {
        return {
            preview: null,
            commentForm: this.$inertia.form({
                _method: "put",
                body: this.comment.body
            })
        };
    }
};
</script>

<style></style>
