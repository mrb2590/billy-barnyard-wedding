<script setup>
  import AppHead from '@/Components/AppHead.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import AdminLayout from '@/Layouts/AdminLayout.vue';

  defineOptions({
    layout: AdminLayout
  });
</script>

<template>
  <div class="container mx-auto p-6">
    <AppHead title="Dashboard" description="View your account dashboard." />

    <FancyCard raised> You're logged in! </FancyCard>
  </div>
</template>
