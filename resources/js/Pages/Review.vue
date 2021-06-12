<template>
    <div class="text-grey-700">
        <toolbar />
        <div class="container p-6">
            <h1 class="text-xl font-semibold tracking-normal">
                Review {{ film.title }}
            </h1>
            <div class="flex flex-wrap my-4">
                <img :src="film.poster" alt="" />
                <div class="ml-8">
                    <table>
                        <tbody>
                            <tr>
                                <th class="text-left">Writer</th>
                                <td class="pl-8">{{ film.writer }}</td>
                            </tr>
                            <tr>
                                <th class="text-left">Actors</th>
                                <td class="pl-8">{{ film.actors }}</td>
                            </tr>
                            <tr>
                                <th class="text-left">Director</th>
                                <td class="pl-8">{{ film.director }}</td>
                            </tr>
                            <tr>
                                <th class="text-left">Genre</th>
                                <td class="pl-8">{{ film.genre }}</td>
                            </tr>
                            <tr>
                                <th class="text-left">Published At</th>
                                <td class="pl-8">{{ film.published_at }}</td>
                            </tr>
                            <tr>
                                <th class="text-left">Year</th>
                                <td class="pl-8">{{ film.year }}</td>
                            </tr>
                            <tr>
                                <th class="text-left">Plot</th>
                                <td class="pl-8">{{ film.plot }}</td>
                            </tr>
                            <tr>
                                <th class="text-left">Reviews</th>
                                <td class="pl-8 flex items-center">
                                    <StarIcon
                                        class="mr-1 text-yellow-600"
                                        size="12"
                                    />{{ film.review_point }}
                                    / 10
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <star-rating
                        :read-only="!canReview"
                        :max-rating="10"
                        :star-size="25"
                        animate
                        text-class="text-white"
                    />
                    <div>
                        <textarea
                            class="mt-8 w-full rounded-lg border border-grey-500 shadow"
                            rows="5"
                        ></textarea>
                        <button
                            class="bg-green-500 px-2 py-1 rounded-lg text-white shadow"
                        >
                            Comment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Toolbar from "@/Components/Toolbar.vue";
import StarRating from "vue-star-rating";
import { StarIcon } from "vue-feather-icons";
export default {
    props: {
        film: Object,
        review: Object,
        canReview: Boolean
    },
    components: {
        Toolbar,
        StarIcon,
        StarRating
    }
};
</script>

<style></style>
