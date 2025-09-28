<script setup>
import CartItem from './components/CartItem.vue';
import useCart from './useCart';

    const {items,addItem,removeItem} = useCart();
    addItem(
      {
        id:1,
        name:"Product X",
        price: 20,
        quantity:1
      }
    )


</script>

<template>
  <CartItem v-for="item in items" :cart-item="item" :key="item.id" @remove="removeItem"/>
</template>


<style scoped>
</style>
