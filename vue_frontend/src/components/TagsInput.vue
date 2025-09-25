<template>
    <div v-for="(tag, index) in tags">
        {{ index }}:{{ tag }}
    </div>
    <input type="text" v-bind:value="newTag">
</template>

<script>
export default {
    data: () => ({
        tags: ["vue","react","angular"],
        newTag:"preact"
    })
}
</script>