<template>
    <label
        class="capitalize tracking-wider block font-medium text-sm text-grey-700"
    >
        <span v-if="value">{{ value }}</span>
        <span v-else><slot></slot></span>
    </label>
</template>

<script>
export default {
    props: ["value"]
};
</script>
