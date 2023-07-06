<script setup>
  import {inject, onMounted, onUnmounted, ref} from 'vue';

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
  const heading = ref();
  const mouse = {x: 0, y: 0};
  let cx = window.innerWidth / 2;
  let cy = window.innerHeight / 2;
  let request = null;

  const mouseMove = (event) => {
    mouse.x = event.pageX;
    mouse.y = event.pageY;

    cancelAnimationFrame(request);
    request = requestAnimationFrame(update);
  };

  const setWindowWidths = () => {
    cx = window.innerWidth / 2;
    cy = window.innerHeight / 2;
  };

  const update = () => {
    const dx = mouse.x - cx;
    const dy = mouse.y - cy;

    const tiltx = -dy / cy;
    const tilty = dx / cx;
    const radius = Math.sqrt(Math.pow(tiltx, 2) + Math.pow(tilty, 2));
    const degree = radius * 20;
    gsap.to(heading.value, {
      transform: 'rotate3d(' + tiltx + ', ' + tilty + ', 0, ' + degree + 'deg) perspective(1000px)',
      ease: 'power2.out'
    });
  };

  onMounted(() => {
    if (props.animate) {
      document.addEventListener('mousemove', mouseMove);
      window.addEventListener('resize', setWindowWidths);
    }
  });

  onUnmounted(() => {
    if (props.animate) {
      document.removeEventListener('mousemove', mouseMove);
      window.removeEventListener('resize', setWindowWidths);
    }
  });
</script>

<template>
  <div ref="heading" class="uppercase font-primary not-italic origin-center whitespace-nowrap">
    <span
      v-if="['short', 'both'].includes(props.type)"
      class="flex flex-row justify-center items-center"
      :class="{'md:hidden': props.type === 'both'}"
    >
      A<span class="mx-[0.2em] w-[0.05em] border-l-[0.05em] border-l-current h-[1em]" />M
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
