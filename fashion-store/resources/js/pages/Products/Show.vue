<script setup lang="ts">
defineProps({
  product: Object
})
</script>

<template>
  <div>
    <h1>{{ product.name }}</h1>
    <p>{{ product.description }}</p>
    <p>Rp {{ product.price }}</p>
  </div>
</template>