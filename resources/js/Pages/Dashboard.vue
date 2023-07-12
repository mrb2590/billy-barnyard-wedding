<script setup>
  import AppHead from '@/Components/AppHead.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

  defineOptions({
    layout: AuthenticatedLayout
  });
</script>

<template>
  <div class="container mx-auto p-6">
    <AppHead title="Dashboard" description="View your account dashboard." />

    <FancyCard raised> You're logged in! </FancyCard>
  </div>
</template>
