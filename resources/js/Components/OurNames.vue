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
  <div ref="wrapper" class="uppercase font-primary not-italic origin-center whitespace-nowrap">
    <span
      v-if="['short', 'both'].includes(props.type)"
      class="flex flex-row justify-center items-center"
      :class="{'md:hidden': props.type === 'both'}"
    >
      A<span class="mx-[0.2em] w-[0.1em] border-l-[0.05em] border-l-current h-[1em]" />M
    </span>
    <span
      v-if="['long', 'both'].includes(props.type)"
      class="flex flex-row justify-center items-center relative"
      :class="{'hidden md:flex': props.type === 'both'}"
    >
      <span class="z-10">Alexandra</span>
      <span class="-mx-[0.175em] text-primary-300 text-[3em] z-0">&amp;</span>
      <span class="z-10">Michael</span>
    </span>
  </div>
</template>
