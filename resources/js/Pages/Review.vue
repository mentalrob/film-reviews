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
                        v-model="reviewForm.rate"
                        text-class="text-white"
                        @rating-selected="submitRating"
                    />
                    <div>
                        <textarea
                            class="mt-8 w-full rounded-lg border border-grey-500 shadow"
                            rows="5"
                            v-model="commentForm.comment"
                        ></textarea>
                        <button
                            class="bg-green-500 px-2 py-1 rounded-lg text-white shadow"
                            @click="submitComment"
                        >
                            Comment
                        </button>
                    </div>
                </div>
            </div>

            <div class="p-6 sm:px-20 container flex flex-col">
                <div
                    class="rounded-lg border border-grey-800 shadow p-4 flex"
                    v-for="comment in film.comments"
                    :key="comment.id"
                >
                    <div class="flex flex-col">
                        <img
                            class="w-8 h-8 rounded-full"
                            src=""
                            alt="user"
                            srcset=""
                        />
                        <span class="text-xs">Mentalrob</span>
                    </div>
                    <p class="ml-5">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Minima et veniam magnam asperiores velit corporis fugiat
                        adipisci totam illo alias deserunt ipsum sapiente
                        consectetur recusandae architecto expedita, qui nobis
                        amet?
                    </p>
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
    data() {
        return {
            reviewForm: this.$inertia.form({
                rate: this.review ? this.review.rate : 0
            }),
            commentForm: this.$inertia.form({
                comment: ""
            })
        };
    },
    methods: {
        submitRating() {
            this.reviewForm.post(route("film.rate", this.film.id), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    this.$vToastify.success("Your review is saved !");
                }
            });
        },
        submitComment() {
            this.commentForm.post(route("film.comment", this.film.id), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    this.$vToastify.success("Comment is saved.");
                }
            });
        }
    },
    components: {
        Toolbar,
        StarIcon,
        StarRating
    }
};
</script>

<style></style>
