<script setup>
  import {Head} from '@inertiajs/vue3';

  import ParallaxBackgroundImage from '@/Components/ParallaxBackgroundImage.vue';
  import HomeLayout from '@/Layouts/HomeLayout.vue';
  import AlexAndMike from '@/Pages/Home/Partials/AlexAndMike.vue';

  import WhenAndWhere from './Partials/WhenAndWhere.vue';

  defineOptions({layout: HomeLayout});
</script>

<template>
  <div class="min-h-screen w-full">
    <Head title="Alex & Mike">
      <meta
        head-key="description"
        name="description"
        content="Celebrate the marriage of Alexandra Zephirin and Michael Buonomo. Read our story, see our timeline, and RSVP to our wedding!"
      />
    </Head>

    <AlexAndMike />

    <div class="relative w-full">
      <ParallaxBackgroundImage image="flowers" :animate="false" />
      <div class="absolute blur-mask bg-gradient-to-b from-black top-0 left-0 w-full h-14" />
      <div
        class="absolute blur-mask-reverse bg-gradient-to-t from-black bottom-0 left-0 w-full h-14"
      />

      <WhenAndWhere />
    </div>
  </div>
</template>
