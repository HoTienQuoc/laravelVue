<template>
    <div v-for="(tag, index) in tags">
        {{ index }}:{{ tag }}
    </div>
    <input type="text"
        v-bind:value="newTag"
        v-on:keydown.enter="tags.push($event.target.value)"
        v-on:keydown.tab.prevent="tags.push($event.target.value)"
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