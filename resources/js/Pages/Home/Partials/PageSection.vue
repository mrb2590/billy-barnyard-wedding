<script setup>
  import {ref} from 'vue';

  const props = defineProps({
    hasHeader: {
      type: Boolean,
      default: false
    },
    hasFooter: {
      type: Boolean,
      default: false
    }
  });

  const section = ref();
  const paddingTop = props.hasHeader ? 'pt-36' : 'pt-6';
  const paddingBottom = props.hasFooter ? 'pb-20' : 'pb-6';

  defineExpose({section});
</script>

<template>
  <section
    ref="section"
    class="w-full h-full min-h-screen px-6 relative overflow-hidden"
    :class="`${paddingTop} ${paddingBottom}`"
  >
    <slot />
  </section>
</template>
