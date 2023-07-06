<script setup>
  import {Link} from '@inertiajs/vue3';

  import ApplicationLogo from '@/Components/ApplicationLogo.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import OurNames from '@/Components/OurNames.vue';
</script>

<template>
  <FancyCard raised class="relative w-full sm:max-w-md overflow-hidden">
    <div class="w-full flex flex-col justify-center items-center">
      <Link :href="route('home')" class="flex flex-col justify-center items-center mb-6 space-y-6">
        <ApplicationLogo class="w-8 h-8" />
        <OurNames :animate="true" type="short" class="text-6xl" />
      </Link>
    </div>
    <slot />
  </FancyCard>
</template>
