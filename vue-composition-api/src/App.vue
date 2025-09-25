<script>
  import { ref } from 'vue';

  export default {
    setup(){
      const message = ref("Hello World");
      const quantity = ref(1);
      const increment = () => quantity.value++
      const decrement = () => quantity.value--

      return {
        message,
        quantity,
        increment,
        decrement
      };
    }
  }
</script>

<template>
  <h1>{{ message }}</h1>
  <input type="text" v-model="message"/>
  <h1>{{ quantity }}</h1>
  <button @click="increment">+</button>
  <button @click="decrement">-</button>
</template>


<style scoped>
</style>
