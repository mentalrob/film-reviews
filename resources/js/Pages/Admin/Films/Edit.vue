<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-grey-800 leading-tight">
                {{ film.title }} | Edit
            </h2>
        </template>
        <div class="py-12 text-grey-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <jet-form-section @submitted="submit">
                            <template #title>
                                Edit Film
                            </template>

                            <template #description>
                                Edit film {{ film.title }}
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

                                    <jet-label for="poster" value="Poster" />

                                    <!-- Current Profile Photo -->
                                    <div class="mt-2">
                                        <img
                                            v-if="!preview"
                                            :src="editFilm.poster"
                                            :alt="editFilm.title"
                                            class="h-48 w-24 object-scale-down"
                                        />
                                        <img
                                            v-if="preview"
                                            :src="preview"
                                            :alt="editFilm.title"
                                            class="h-48 w-24 object-scale-down"
                                        />
                                    </div>

                                    <!-- New Profile Photo Preview -->

                                    <jet-secondary-button
                                        class="mt-2 mr-2"
                                        type="button"
                                        @click.native.prevent="selectNewPhoto"
                                    >
                                        Select A New Poster
                                    </jet-secondary-button>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label for="title" value="Title" />
                                    <jet-input
                                        id="title"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="editFilm.title"
                                        autofocus
                                    />
                                    <jet-input-error
                                        :message="editFilm.errors.title"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label for="writer" value="writer" />
                                    <jet-input
                                        id="writer"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="editFilm.writer"
                                        autofocus
                                    />
                                    <jet-input-error
                                        :message="editFilm.errors.writer"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label for="actors" value="actors" />
                                    <jet-input
                                        id="actors"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="editFilm.actors"
                                        autofocus
                                    />
                                    <jet-input-error
                                        :message="editFilm.errors.actors"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label
                                        for="director"
                                        value="director"
                                    />
                                    <jet-input
                                        id="director"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="editFilm.director"
                                        autofocus
                                    />
                                    <jet-input-error
                                        :message="editFilm.errors.director"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label for="genre" value="genre" />
                                    <jet-input
                                        id="genre"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="editFilm.genre"
                                        autofocus
                                    />
                                    <jet-input-error
                                        :message="editFilm.errors.genre"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label
                                        for="published_at"
                                        value="published at"
                                    />
                                    <jet-input
                                        id="published_at"
                                        type="date"
                                        class="mt-1 block w-full"
                                        v-model="editFilm.published_at"
                                        autofocus
                                    />
                                    <jet-input-error
                                        :message="editFilm.errors.published_at"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label for="year" value="year" />
                                    <jet-input
                                        id="year"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="editFilm.year"
                                        autofocus
                                    />
                                    <jet-input-error
                                        :message="editFilm.errors.year"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label for="plot" value="plot" />
                                    <textarea
                                        id="plot"
                                        type="date"
                                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                        rows="5"
                                        v-model="editFilm.plot"
                                        autofocus
                                    />
                                    <jet-input-error
                                        :message="editFilm.errors.plot"
                                        class="mt-2"
                                    />
                                </div>
                            </template>

                            <template #actions>
                                <jet-action-message
                                    :on="editFilm.recentlySuccessful"
                                    class="mr-3"
                                >
                                    Updated.
                                </jet-action-message>

                                <jet-button
                                    :class="{
                                        'opacity-25': editFilm.processing
                                    }"
                                    :disabled="editFilm.processing"
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
        film: Object
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
            this.editFilm.poster = this.$refs.poster.files[0];
        },
        submit() {
            this.editFilm.post(route("admin.films.update", this.film.id), {
                preserveScroll: true,
                preserveState: true,
                forceFormData: true,
                onSuccess: () => {
                    this.$vToastify.success("Film is updated");
                }
            });
        }
    },
    data() {
        return {
            preview: null,
            editFilm: this.$inertia.form({
                _method: "put",
                poster: this.film.poster,
                title: this.film.title,
                writer: this.film.writer,
                actors: this.film.actors,
                director: this.film.director,
                genre: this.film.genre,
                published_at: this.film.published_at,
                year: this.film.year,
                plot: this.film.plot
            })
        };
    }
};
</script>

<style></style>
