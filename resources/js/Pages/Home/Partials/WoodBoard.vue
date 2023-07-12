<script setup>
  import {inject, onMounted, ref} from 'vue';

  import {getStaticAsset} from '@/Library/static-asset';

  const props = defineProps({
    image: {
      type: String,
      required: true
    },
    animateDir: {
      type: String,
      required: true
    },
    scrollTrigger: {
      type: Function,
      required: true
    },
    scrub: {
      type: Number,
      default: 3
    }
  });

  const gsap = inject('gsap');
  const board = ref();
  const images = {};
  const startXPercent = props.animateDir === 'left' ? -20 : 20;

  for (let i = 1; i <= 3; i++) {
    images[`x${i}`] = getStaticAsset(`${props.image}${i > 1 ? `@${i}x` : ''}.webp`);
  }

  const initAnimations = () => {
    gsap.set(board.value, {xPercent: startXPercent});

    gsap.to(board.value, {
      scrollTrigger: {
        trigger: props.scrollTrigger(),
        scrub: props.scrub,
        start: 'top 200%',
        end: 'bottom top'
      },
      ease: 'none',
      xPercent: -startXPercent
    });
  };

  onMounted(initAnimations);
</script>

<template>
  <div
    ref="board"
    class="relative aspect-11 h-[22vh] min-h-[12rem] bg-center bg-repeat raised"
    :style="{
      backgroundImage: `url(${images.x3})`,
      backgroundImage: `image-set(url(${images.x1}) 1x, url(${images.x2}) 2x, url(${images.x3}) 3x)`,
      backgroundImage: `-webkit-image-set(url(${images.x1}) 1x, url(${images.x2}) 2x, url(${images.x3}) 3x)`
    }"
  >
    <div
      class="relative flex h-full w-full flex-row flex-nowrap items-center justify-between p-10 shadow-[inset_0_0_20px_20px_rgba(0,0,0,0.5)]"
    >
      <slot />
      <div class="absolute left-0 top-0 h-full w-full bg-black/30" />
    </div>
  </div>
</template>
