<script>
  import { ref, reactive, toRef, toRefs, computed, watch, watchEffect } from 'vue';

  export default {
    setup(){
      const message = ref("Hello World");
      // const quantity = ref(1);

      const item = reactive({
        name:"Product 1",
        price:10,
        quantity:1
      })

      const increment = () => item.quantity++
      const decrement = () => item.quantity--

      const swapProduct = () => {
        item.name = "Product A",
        item.price = 30
      }

      const total = computed(()=>item.price*quantity.value)

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

      const {name, price, quantity} = toRefs(item);

      // watch(total, (newValue,oldValue)=>{
      //   console.log("newValue: "+newValue+", oldValue: "+oldValue)
      // },{immediate:true});

      watch(()=>item.quantity, ()=>{
        if(item.quantity===5){
          alert("you cannot add more item")
        }
      },{immediate:true});

      watchEffect(()=>{
        console.log(item.price)
      });


      return {
        message,
        quantity,
        increment,
        decrement,
        name,
        price,
        quantity,
        total,
        swapProduct
      };
    }
  }
</script>

<template>
  <h1>{{ name }}:{{ price }}</h1>
  <button @click="swapProduct">Swap product</button>
  <button @click="price++">Increment Price</button>
  <h1>{{ message }}</h1>
  <input type="text" v-model="message"/>
  <h1>{{ quantity }}</h1>
  <button @click="increment">+</button>
  <button @click="decrement">-</button>
  <h3>Total: {{ total }}</h3>
</template>


<style scoped>
</style>
