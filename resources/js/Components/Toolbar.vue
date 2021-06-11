<template>
  <nav class="flex items-center w-full h-16 border-b border-grey-300 text-grey-700 px-4">
        <img class="w-10 h-10" src="/logo.png" alt="" srcset="">
        <p class="ml-3">Film Reviews App</p>
        <div class="mx-auto"></div>
         <div class="hidden sm:flex items-center">
            <inertia-link v-if="$page.props.user" href="/dashboard" class="text-blue-500 text-sm">
                User Dashboard
            </inertia-link>
            <template v-else>
                <inertia-link :href="route('login')" class="text-blue-500 text-sm">
                    Login
                </inertia-link>
                <p class="mx-1">/</p>
                <inertia-link :href="route('register')" class="text-blue-500 text-sm">
                    Register
                </inertia-link>
            </template>
        </div>
    </nav>
</template>

<script>
export default {

}
</script>

<style>

</style>