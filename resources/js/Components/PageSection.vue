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
    class="relative h-full min-h-screen w-full overflow-hidden px-6"
    :class="`${paddingTop} ${paddingBottom}`"
  >
    <slot />
  </section>
</template>
