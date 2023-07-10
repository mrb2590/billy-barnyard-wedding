<script setup>
  import ImageObject from '@/Components/ImageObject.vue';

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
</script>

<template>
  <div
    class="relative bg-white p-2 raised mx-6 h-full w-full aspect-[1.333]"
    :style="{
      transform: `rotate(${props.rotation}deg) translateY(${props.translation}px)`
    }"
  >
    <ImageObject :image="props.image" class="w-full h-full max-h-full max-w-full aspect-[1.333]" />
  </div>
</template>
