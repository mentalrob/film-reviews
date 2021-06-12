<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-grey-800 leading-tight">
                {{ user.name }} | Edit
            </h2>
        </template>
        <div class="py-12 text-grey-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <jet-form-section @submitted="submit">
                            <template #title>
                                Edit User
                            </template>

                            <template #description>
                                Edit User {{ user.name }}
                            </template>

                            <template #form>
                                <div class="col-span-6 sm:col-span-4">
                                    <!-- Profile Photo File Input -->
                                    <input
                                        type="file"
                                        class="hidden"
                                        ref="poster"
                                        @change="uploadImage"
                                    />

                                    <jet-label
                                        for="profile picture"
                                        value="profile Picture"
                                    />

                                    <!-- Current Profile Photo -->
                                    <div class="mt-2">
                                        <img
                                            v-if="!preview"
                                            :src="user.profile_photo_url"
                                            :alt="user.name"
                                            class="h-12 w-12 object-cover rounded-full"
                                        />
                                        <img
                                            v-if="preview"
                                            :src="preview"
                                            :alt="user.name"
                                            class="h-12 w-12 object-cover rounded-full"
                                        />
                                    </div>

                                    <!-- New Profile Photo Preview -->

                                    <jet-secondary-button
                                        class="mt-2 mr-2"
                                        type="button"
                                        @click.native.prevent="selectNewPhoto"
                                    >
                                        Select A New Image
                                    </jet-secondary-button>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label for="name" value="name" />
                                    <jet-input
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="editUser.name"
                                        autofocus
                                    />
                                    <jet-input-error
                                        :message="editUser.errors.name"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label for="email" value="email" />
                                    <jet-input
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="editUser.email"
                                        autofocus
                                    />
                                    <jet-input-error
                                        :message="editUser.errors.email"
                                        class="mt-2"
                                    />
                                </div>
                            </template>

                            <template #actions>
                                <jet-action-message
                                    :on="editUser.recentlySuccessful"
                                    class="mr-3"
                                >
                                    Updated.
                                </jet-action-message>

                                <jet-button
                                    :class="{
                                        'opacity-25': editUser.processing
                                    }"
                                    :disabled="editUser.processing"
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
        user: Object
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
        selectNewPhoto() {
            this.$refs.poster.click();
        },
        uploadImage() {
            const reader = new FileReader();
            reader.onload = e => {
                this.preview = e.target.result;
            };
            reader.readAsDataURL(this.$refs.poster.files[0]);
            this.editUser.photo = this.$refs.poster.files[0];
        },
        submit() {
            this.editUser.post(route("admin.users.update", this.user.id), {
                preserveScroll: true,
                preserveState: true,
                forceFormData: true,
                onSuccess: () => {
                    this.$vToastify.success("User is updated");
                }
            });
        }
    },
    data() {
        return {
            preview: null,
            editUser: this.$inertia.form({
                _method: "put",
                name: this.user.name,
                email: this.user.email,
                photo: null
            })
        };
    }
};
</script>

<style></style>
