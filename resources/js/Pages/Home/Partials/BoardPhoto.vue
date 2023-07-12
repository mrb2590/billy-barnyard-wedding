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
    class="relative mx-6 aspect-[1.36] h-full w-full bg-white p-2 raised"
    :style="{
      transform: `rotate(${props.rotation}deg) translateY(${props.translation}px)`
    }"
  >
    <ImageObject :image="props.image" class="aspect-[1.36] h-full max-h-full w-full max-w-full" />
  </div>
</template>
