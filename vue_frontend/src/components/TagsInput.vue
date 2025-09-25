<template>
    <div v-for="(tag, index) in tags">
        {{ index }}:{{ tag }}
    </div>
    <div>{{ newTag }}</div>
    <input type="text"
        v-model.trim="newTag"
        v-on:keydown.enter="tags.push(newTag)"
        v-on:keydown.tab.prevent="tags.push(newTag)"
    >
    <!-- <button v-on:click="tags.push(newTag)">Ok</button> -->
</template>

<script>
export default {
    data: () => ({
        tags: ["vue","react","angular"],
        newTag:"preact"
    })
}
</script>