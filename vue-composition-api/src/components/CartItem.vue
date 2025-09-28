<script>
  import { reactive, toRefs, computed, onMounted, onUpdated, onUnmounted} from 'vue';

  export default {
    props:{
      cartItem:{
        type: Object,
        required: true
      }
    },
    emits:[
      'remove'
    ],
    setup(props,{emit}){
      // console.log(props.cartItem)
      const item = reactive(props.cartItem)

      const increment = () => item.quantity++
      const decrement = () => item.quantity--

      const total = computed(()=>item.price*quantity.value)

      const {name, price, quantity} = toRefs(item);

      const remove = () => emit("Remove",item)

      onMounted(()=>{
        console.log('Component mounted')
      })

      onUpdated(()=>{
        console.log('Component updated')
      })

      onUnmounted(()=>{
        console.log('Component unmounted')
      })


      return {
        quantity,
        increment,
        decrement,
        remove,
        name,
        price,
        quantity,
        total,
      };
    }
  }
</script>

<template>
  <h1>{{ name }}:{{ price }}:{{ quantity }}</h1>
  <button @click="increment">+</button>
  <button @click="decrement">-</button>
  <br>
  <button @click="remove">remove</button>
  <h3>Total: {{ total }}</h3>
</template>


<style scoped>
</style>
