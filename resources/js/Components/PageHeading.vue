<script setup>
  import {ref} from 'vue';

  const heading = ref();

  defineExpose({heading});
</script>
<template>
  <div
    ref="heading"
    class="text-shadow-default text-4xl md:text-5xl heading-text mb-12 text-center"
  >
    <slot />
  </div>
</template>
