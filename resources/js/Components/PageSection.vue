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
  const paddingTop = props.hasHeader ? 'pt-20 sm:pt-36' : 'pt-8';
  const paddingBottom = props.hasFooter ? 'pb-20' : 'pb-8';

  defineExpose({section});
</script>

<template>
  <section
    ref="section"
    class="relative h-full min-h-screen w-full overflow-hidden px-8"
    :class="`${paddingTop} ${paddingBottom}`"
  >
    <slot />
  </section>
</template>
