<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-grey-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12 text-grey-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <div class="p-6 sm:px-20 bg-white">
                       <h1 class="text-lg font-semibold tracking-widest">My Reviews</h1>
                       <table class="w-full mt-4">
                           <thead>
                               <tr class="border-b border-grey-700">
                                   <th class="pb-2">#</th>
                                   <th class="pb-2">Film</th>
                                   <th class="pb-2">Point</th>
                               </tr>
                           </thead>
                           <tbody>
                               <tr>
                                   <td class="text-center py-2">1</td>
                                   <td class="text-center py-2">Avengers</td>
                                   <td class="text-center py-2">7.5</td>
                               </tr>
                           </tbody>
                       </table>
                   </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
    }
</script>
