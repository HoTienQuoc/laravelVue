<script>
  import TagsInput from './components/TagsInput.vue';
  export default {
    data: ()=> ({
      jsFrameworks: ["react.js", "vue.js", "angular"],
      backendFrameworks: []
    }),
    mounted(){
      setTimeout(()=>{
        this.jsFrameworks.push('svelte.js');
      }, 3000)
    },
    methods:{
      handleChange(tags){
        this.jsFrameworks = [...tags];
      }
    }

  }
</script>

<template>
  <h1>Your favorite frameworks</h1>
  <div>{{ jsFrameworks }}</div>
  <tags-input :selected-tags="jsFrameworks" @change="handleChange"/>
  <div>{{ backendFrameworks }}</div>
  <tags-input :selected-tags="backendFrameworks" @change="backendFrameworks=[...$event]"/>
</template>

<style>
h1{
  color:blue
}
</style>
