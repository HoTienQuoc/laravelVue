<script>
  import { ref, reactive, toRef, toRefs } from 'vue';

  export default {
    setup(){
      const message = ref("Hello World");
      const quantity = ref(1);

      const item = reactive({
        name:"Product 1",
        price:10
      })

      const increment = () => quantity.value++
      const decrement = () => quantity.value--

      const swapProduct = () => {
        item.name = "Product A",
        item.price = 30
      }

      // const nameRef = toRef(item, 'name');
      // console.log(nameRef.value);
      // item.name = "New Product"
      // console.log(nameRef.value);

      // const itemRefs = toRefs(item);
      // console.log('name:', itemRefs.name.value)
      // console.log('price:', itemRefs.price.value)

      // item.name="New Product";
      // item.price=11;
      // console.log('name:', itemRefs.name.value)
      // console.log('price:', itemRefs.price.value)

      const {name, price} = toRefs(item);




      return {
        message,
        quantity,
        increment,
        decrement,
        name,
        price,
        swapProduct
      };
    }
  }
</script>

<template>
  <h1>{{ name }}:{{ price }}</h1>
  <button @click="swapProduct">Swap product</button>
  <h1>{{ message }}</h1>
  <input type="text" v-model="message"/>
  <h1>{{ quantity }}</h1>
  <button @click="increment">+</button>
  <button @click="decrement">-</button>
</template>


<style scoped>
</style>
