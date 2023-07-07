<script setup>
  import {ref} from 'vue';

  const props = defineProps({
    raised: {
      type: Boolean,
      default: false
    }
  });

  const card = ref();

  defineExpose({card});
</script>

<template>
  <div ref="card" class="bg-white text-primary-700 p-2 rounded-sm" :class="{raised: props.raised}">
    <div class="h-full w-full border border-primary-700 p-6 rounded-sm">
      <slot />
    </div>
  </div>
</template>
