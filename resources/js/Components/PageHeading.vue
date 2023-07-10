<script setup>
  import {inject, onMounted, ref} from 'vue';

  const props = defineProps({
    animate: {
      type: Boolean,
      default: false
    }
  });

  const gsap = inject('gsap');
  const heading = ref();

  const initAnimations = () => {
    if (!props.animate) {
      return;
    }

    gsap.from(heading.value, {
      opacity: 0,
      y: -100
    });
  };

  onMounted(initAnimations);
  defineExpose({heading});
</script>
<template>
  <div ref="heading" class="text-shadow-default text-5xl heading-text mb-20 text-center">
    <slot />
  </div>
</template>
