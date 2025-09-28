<script>
import { ref } from 'vue';
import CartItem from './components/CartItem.vue';
export default{
  components: {CartItem},
  setup(){
    const items = ref([
      {
        id:1,
        name:"Product X",
        price: 20,
        quantity:1
      }
    ])
    const handleRemove = (data) => items.value.splice(0,1)
    return {items,handleRemove}
  }
}
</script>

<template>
  <CartItem v-for="item in items" :cart-item="item" :key="item.id" @remove="handleRemove"/>
</template>


<style scoped>
</style>
