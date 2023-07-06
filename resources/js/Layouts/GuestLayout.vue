<script setup>
  import ParallaxBackgroundImage from '@/Components/ParallaxBackgroundImage.vue';
</script>

<template>
  <div class="relative min-h-screen flex flex-col sm:justify-center items-center p-6">
    <ParallaxBackgroundImage image="flowers" />

    <Transition
      enter-active-class="transition ease-out duration-300"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition ease-in duration-300"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
      appear
      mode="out-in"
    >
      <slot />
    </Transition>
  </div>
</template>
