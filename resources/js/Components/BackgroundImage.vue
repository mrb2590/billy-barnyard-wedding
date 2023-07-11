<script setup>
  import {inject, onMounted, ref} from 'vue';

  import {getStaticAsset} from '@/Library/static-asset';

  const props = defineProps({
    image: {
      type: String,
      required: true
    },
    bgSize: {
      type: String,
      default: null
    },
    start: {
      type: String,
      default: 'top bottom'
    },
    end: {
      type: String,
      default: 'bottom top'
    },
    animate: {
      type: Boolean,
      default: false
    }
  });

  const gsap = inject('gsap');
  const wrapper = ref();
  const backgroundImage = ref();
  const images = ref({});
  const bgHeight = ref('h-[125%]');

  if (!props.animate) {
    bgHeight.value = 'h-full';
  }

  for (let i = 1; i <= 3; i++) {
    images.value[`x${i}`] = getStaticAsset(`${props.image}${i > 1 ? `@${i}x` : ''}.webp`);
  }

  onMounted(() => {
    if (props.animate) {
      gsap.to(backgroundImage.value, {
        scrollTrigger: {
          trigger: wrapper.value,
          scrub: 2,
          start: props.start,
          end: props.end
        },
        yPercent: -15
      });
    }
  });

  defineExpose({wrapper});
</script>

<template>
  <div ref="wrapper" class="absolute left-0 top-0 z-0 h-full w-full overflow-hidden">
    <div
      ref="backgroundImage"
      class="w-full bg-cover bg-fixed bg-no-repeat"
      :class="`${bgSize} ${bgHeight}`"
      :style="{
        backgroundImage: `url(${images.x3})`,
        backgroundImage: `image-set(url(${images.x1}) 1x, url(${images.x2}) 2x, url(${images.x3}) 3x)`,
        backgroundImage: `-webkit-image-set(url(${images.x1}) 1x, url(${images.x2}) 2x, url(${images.x3}) 3x)`
      }"
    />
    <div class="absolute left-0 top-0 h-full w-full bg-black/30" />
  </div>
</template>
