<script>
import { ref } from 'vue';
import CartItem from './components/CartItem.vue';
import useCart from './useCart';

export default{
  components: {CartItem},
  setup(){
    const {items,addItem,removeItem} = useCart();
    addItem(
      {
        id:1,
        name:"Product X",
        price: 20,
        quantity:1
      }
    )
    return {items,removeItem}
  }
}
</script>

<template>
  <CartItem v-for="item in items" :cart-item="item" :key="item.id" @remove="removeItem"/>
</template>


<style scoped>
</style>
