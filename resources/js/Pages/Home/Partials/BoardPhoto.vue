<script setup>
  import {getStaticAsset} from '@/Library/static-asset';

  const props = defineProps({
    image: {
      type: String,
      required: true
    },
    rotation: {
      type: Number,
      required: true
    },
    translation: {
      type: Number,
      required: true
    }
  });

  const images = {};

  for (let i = 1; i <= 3; i++) {
    images[`x${i}`] = getStaticAsset(`${props.image}${i > 1 ? `@${i}x` : ''}.webp`);
  }
</script>

<template>
  <div
    class="relative bg-white p-2 raised mx-6 h-full w-48"
    :style="{
      transform: `rotate(${props.rotation}deg) translateY(${props.translation}px)`
    }"
  >
    <picture>
      <source :srcset="`${images.x1} 1x, ${images.x2} 2x, ${images.x3} 3x`" />
      <img
        :src="images.x1"
        alt="Billy Barnyard Wedding"
        class="w-full h-full max-h-full max-w-full"
      />
    </picture>
  </div>
</template>
