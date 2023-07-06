<script setup>
  import {Head} from '@inertiajs/vue3';

  import FancyCard from '@/Components/FancyCard.vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

  defineOptions({
    layout: AuthenticatedLayout
  });
</script>

<template>
  <div class="container mx-auto p-6">
    <Head title="Dashboard" />

    <FancyCard> You're logged in! </FancyCard>
  </div>
</template>
