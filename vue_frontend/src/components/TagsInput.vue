<template>
    <div v-for="(tag, index) in tags">
        {{ index }}:{{ tag }}:
        <a href="#" @click.prevent="removeTag(index)">&times;</a>
    </div>
    <div>{{ newTag }}</div>
    <input type="text"
        v-model.trim="newTag"
        v-on:keydown.enter="addNewTag()"
        @keydown.delete="removeLastTag()"
        v-on:keydown.tab.prevent="addNewTag()"
    >
    <!-- <button v-on:click="tags.push(newTag)">Ok</button> -->
</template>

<script>
export default {
    data: () => ({
        tags: ["vue","react","angular"],
        newTag:"preact"
    }),
    methods: {
        addNewTag(){
            if(this.newTag){
                this.tags.push(this.newTag);
                this.newTag="";
            }
        },
        removeTag(index){
            this.tags.splice(index, 1)
        },
        removeLastTag(){
            if(this.newTag.length===0){
                this.removeTag(this.tags.length-1)
            }
        }
    }
}
</script>