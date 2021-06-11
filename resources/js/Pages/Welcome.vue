<template>
    <div>
        <toolbar />
        <!-- Popular movies -->
        <div class="container p-8">
            <h1 class="text-lg text-grey-700 font-semibold tracking-widest mb-8">POPULAR MOVIES</h1>
            <div class="grid grid-flow-row grid-cols-5 gap-12">
                <div class="flex flex-col text-grey-700" v-for="i in 10" :key="i">
                    <div class="rounded-lg overflow-hidden shadow">
                        <img src="/sizetest.jpg" alt="">
                    </div>
                    <div class="px-2 py-1">
                        <p class="font-semibold">Guardians of galaxy</p>
                        <div class="flex items-center text-xs">
                            <StarIcon size="16" class="text-yellow-700" /> <p class="font-semibold ml-2">7.5</p>
                            <p class="mx-2"> / </p>
                            <p>2020-10-10</p>
                        </div>
                        <p class="text-xs">Action, Comedy, Scifi</p>
                        <div class="px-6">
                            <button class="w-full bg-green-500 rounded-lg py-1 text-white shadow mt-3 text-sm">Make A Review</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Toolbar from '../Components/Toolbar.vue'
import { StarIcon } from 'vue-feather-icons'

export default {
    components: {
        Toolbar,
        StarIcon
    },
}
</script>
