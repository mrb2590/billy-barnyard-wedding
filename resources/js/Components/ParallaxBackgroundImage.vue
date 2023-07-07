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
    }
  });

  const gsap = inject('gsap');
  const wrapper = ref();
  const backgroundImage = ref();
  const images = ref({});

  for (let i = 1; i <= 3; i++) {
    images.value[`x${i}`] = getStaticAsset(`${props.image}${i > 1 ? `@${i}x` : ''}.webp`);
  }

  onMounted(() => {
    gsap.to(backgroundImage.value, {
      scrollTrigger: {
        trigger: wrapper.value,
        scrub: 2,
        start: props.start
      },
      yPercent: -15
    });
  });

  defineExpose({wrapper});
</script>

<template>
  <div ref="wrapper" class="absolute top-0 left-0 h-full w-full overflow-hidden z-0">
    <div
      ref="backgroundImage"
      class="w-full h-[125%] bg-fixed bg-no-repeat bg-cover"
      :class="bgSize"
      :style="{
        backgroundImage: `url(${images.x3})`,
        backgroundImage: `image-set(url(${images.x1}) 1x, url(${images.x2}) 2x, url(${images.x3}) 3x)`,
        backgroundImage: `-webkit-image-set(url(${images.x1}) 1x, url(${images.x2}) 2x, url(${images.x3}) 3x)`
      }"
    />
    <div class="absolute top-0 left-0 w-full h-full bg-black/30" />
  </div>
</template>
