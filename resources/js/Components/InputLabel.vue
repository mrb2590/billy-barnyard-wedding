<script setup>
  const props = defineProps({
    value: {
      type: String,
      default: null
    },
    error: {
      type: String,
      default: null
    }
  });
</script>

<template>
  <label
    :data-error="!!props.error"
    class="text-primary-700 error:text-danger-700 heading-text w-fit"
  >
    <span v-if="props.value">{{ props.value }}</span>
    <slot v-else />
  </label>
</template>
