<script setup>
  import {inject, onMounted, ref, watch} from 'vue';

  import {animateMousePerspective} from '@/Library/animations';

  const props = defineProps({
    animate: {
      type: Boolean,
      default: false
    },
    type: {
      type: String,
      default: 'both',
      validator(value) {
        return ['long', 'short', 'both'].includes(value);
      }
    }
  });

  const gsap = inject('gsap');
  const wrapper = ref();
  const animation = animateMousePerspective(gsap, wrapper);

  watch(
    () => props.animate,
    () => {
      if (!props.animate) {
        animation.removeEventListeners();
      } else {
        animation.addEventListeners();
      }
    }
  );

  onMounted(() => {
    animation.init();
  });

  defineExpose({wrapper});
</script>

<template>
  <div ref="wrapper" class="origin-center whitespace-nowrap font-primary uppercase not-italic">
    <span
      v-if="['short', 'both'].includes(props.type)"
      class="flex flex-row items-center justify-center"
      :class="{'md:hidden': props.type === 'both'}"
    >
      A<span class="mx-[0.2em] h-[1em] w-[0.1em] border-l-[0.05em] border-l-current" />M
    </span>
    <span
      v-if="['long', 'both'].includes(props.type)"
      class="relative flex flex-row items-center justify-center"
      :class="{'hidden md:flex': props.type === 'both'}"
    >
      <span class="z-10">Alexandra</span>
      <span class="z-0 -mx-[0.175em] text-[3em] text-primary-300">&amp;</span>
      <span class="z-10">Michael</span>
    </span>
  </div>
</template>
