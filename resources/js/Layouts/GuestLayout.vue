<script setup>
  import BackgroundImage from '@/Components/BackgroundImage.vue';
</script>

<template>
  <div class="relative min-h-screen w-full flex flex-col sm:justify-center items-center p-6">
    <BackgroundImage image="flowers" start="top top" />

    <Transition
      enter-active-class="transition ease-out duration-500"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition ease-in duration-500"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
      appear
      mode="out-in"
    >
      <slot />
    </Transition>
  </div>
</template>
