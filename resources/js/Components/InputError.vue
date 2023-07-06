<script setup>
  defineProps({
    message: {
      type: String,
      default: null
    }
  });
</script>

<template>
  <div v-show="message">
    <p class="text-danger-700">
      {{ message }}
    </p>
  </div>
</template>
