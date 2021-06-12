<template>
    <div>
        <toolbar />
        <!-- Popular movies -->
        <div class="container p-8">
            <h1
                class="text-lg text-grey-700 font-semibold tracking-widest mb-8"
            >
                LATEST MOVIES
            </h1>
            <div class="grid grid-flow-row grid-cols-5 gap-12">
                <div
                    class="flex flex-col text-grey-700 h-full"
                    v-for="film in films"
                    :key="film.id"
                >
                    <div class="rounded-lg overflow-hidden shadow">
                        <img :src="film.poster" alt="" />
                    </div>
                    <div class="mt-auto"></div>
                    <div class="px-2 py-1">
                        <p class="font-semibold">{{ film.title }}</p>
                        <div class="flex items-center text-xs">
                            <StarIcon size="16" class="text-yellow-700" />
                            <p class="font-semibold ml-2">
                                {{ film.review_point }}
                            </p>
                            <p class="mx-2">/</p>
                            <p>{{ film.published_at }}</p>
                        </div>
                        <p class="text-xs">{{ film.genre }}</p>

                        <div class="mt-auto p-2">
                            <inertia-link
                                :href="route('film.review', film.id)"
                                class="px-2 py-1 text-center bg-green-500 rounded-lg py-1 text-white shadow text-sm"
                                >Make A Review</inertia-link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Toolbar from "../Components/Toolbar.vue";
import { StarIcon } from "vue-feather-icons";

export default {
    props: ["films"],
    components: {
        Toolbar,
        StarIcon
    }
};
</script>
