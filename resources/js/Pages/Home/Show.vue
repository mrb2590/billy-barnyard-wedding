<script setup>
  import {Head} from '@inertiajs/vue3';

  import HomeLayout from '@/Layouts/HomeLayout.vue';
  import AlexAndMike from '@/Pages/Home/Partials/AlexAndMike.vue';

  defineOptions({layout: HomeLayout});
</script>

<template>
  <div class="min-h-screen w-full h-full">
    <Head title="Alex & Mike">
      <meta
        head-key="description"
        name="description"
        content="Celebrate the marriage of Alexandra Zephirin and Michael Buonomo. Read our story, see our timeline, and RSVP to our wedding!"
      />
    </Head>

    <AlexAndMike />
  </div>
</template>
