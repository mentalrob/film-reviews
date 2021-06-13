<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-grey-800 leading-tight">
                Edit Review
            </h2>
        </template>
        <div class="py-12 text-grey-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <jet-form-section @submitted="submit">
                            <template #title>
                                Edit Review
                            </template>

                            <template #description>
                                Edit Review #{{ review.id }}
                            </template>

                            <template #form>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label for="name" value="name" />
                                    <jet-input
                                        id="name"
                                        type="number"
                                        class="mt-1 block w-full"
                                        v-model="reviewForm.rate"
                                        autofocus
                                    />
                                    <jet-input-error
                                        :message="reviewForm.errors.rate"
                                        class="mt-2"
                                    />
                                </div>
                            </template>

                            <template #actions>
                                <jet-action-message
                                    :on="reviewForm.recentlySuccessful"
                                    class="mr-3"
                                >
                                    Updated.
                                </jet-action-message>

                                <jet-button
                                    :class="{
                                        'opacity-25': reviewForm.processing
                                    }"
                                    :disabled="reviewForm.processing"
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
        review: Object
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
            this.reviewForm.post(
                route("admin.reviews.update", this.review.id),
                {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        this.$vToastify.success("Review is updated");
                    }
                }
            );
        }
    },
    data() {
        return {
            preview: null,
            reviewForm: this.$inertia.form({
                _method: "put",
                rate: this.review.rate
            })
        };
    }
};
</script>

<style></style>
