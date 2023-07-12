<script setup>
  import {Head} from '@inertiajs/vue3';

  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import HomeLayout from '@/Layouts/HomeLayout.vue';
  import AlexAndMike from '@/Pages/Home/Partials/AlexAndMike.vue';
  import Registry from '@/Pages/Home/Partials/Registry.vue';
  import WhenAndWhere from '@/Pages/Home/Partials/WhenAndWhere.vue';

  import OurStory from './Partials/OurStory.vue';

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
      <BackgroundImage image="flowers" />
      <div class="absolute left-0 top-0 z-20 h-14 w-full bg-gradient-to-b from-black blur-mask" />

      <WhenAndWhere />
      <OurStory />

      <div
        class="absolute bottom-0 left-0 z-20 h-14 w-full bg-gradient-to-t from-black blur-mask-reverse"
      />
    </div>

    <Registry />
  </div>
</template>
