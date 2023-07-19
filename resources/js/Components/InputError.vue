<script setup>
  const props = defineProps({
    message: {
      type: [Array, String],
      default: null
    }
  });
</script>

<template>
  <div v-show="props.message">
    <p v-if="!Array.isArray(props.message)" class="text-danger-700">
      {{ props.message }}
    </p>
    <p v-for="(line, i) in props.message" v-else :key="i" class="text-danger-700">
      {{ line }}
    </p>
  </div>
</template>
