<script setup>
  import {getStaticAsset} from '@/Library/static-asset';

  const props = defineProps({
    image: {
      type: String,
      required: true
    },
    class: {
      type: [Array, Object, String],
      default: null
    }
  });

  const images = {};

  for (let i = 1; i <= 3; i++) {
    images[`x${i}`] = getStaticAsset(`${props.image}${i > 1 ? `@${i}x` : ''}.webp`);
  }
</script>

<template>
  <picture>
    <source :srcset="`${images.x1} 1x, ${images.x2} 2x, ${images.x3} 3x`" />
    <img :src="images.x1" alt="Billy Barnyard Wedding" :class="props.class" />
  </picture>
</template>
