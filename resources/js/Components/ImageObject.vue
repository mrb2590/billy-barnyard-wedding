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
    },
    extension: {
      type: String,
      default: 'jpg'
    },
    hasWebp: {
      type: Boolean,
      default: true
    }
  });

  const images = {};

  for (let i = 1; i <= 3; i++) {
    images[`x${i}`] = getStaticAsset(`${props.image}${i > 1 ? `@${i}x` : ''}.${props.extension}`);

    if (props.hasWebp) {
      images[`webp_x${i}`] = getStaticAsset(`${props.image}${i > 1 ? `@${i}x` : ''}.webp`);
    }
  }
</script>

<template>
  <picture>
    <source
      v-if="props.hasWebp"
      :srcset="`${images.webp_x1} 1x, ${images.webp_x2} 2x, ${images.webp_x3} 3x`"
      type="image/webp"
    />
    <source :srcset="`${images.x1} 1x, ${images.x2} 2x, ${images.x3} 3x`" />
    <img :src="images.x3" alt="Billy Barnyard Wedding" :class="props.class" />
  </picture>
</template>
