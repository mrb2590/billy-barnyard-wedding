<script setup>
  import AppHead from '@/Components/AppHead.vue';
  import GuestResponses from '@/Components/Charts/GuestResponses.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import AdminLayout from '@/Layouts/AdminLayout.vue';

  defineOptions({
    layout: AdminLayout
  });

  const props = defineProps({
    receptionResponses: {
      type: Array,
      default: () => [0, 0, 0]
    },
    welcomeDinnerResponses: {
      type: Array,
      default: () => [0, 0, 0]
    }
  });
</script>

<template>
  <div class="container mx-auto p-6">
    <AppHead title="Dashboard" description="View your account dashboard." />

    <div class="flex flex-row flex-wrap">
      <div class="w-full p-3 md:w-1/2">
        <FancyCard raised>
          <h2 class="heading-text mb-6 text-center text-xl">Recption Responses</h2>
          <div class="w-full">
            <GuestResponses :data="props.receptionResponses" />
          </div>
        </FancyCard>
      </div>

      <div class="w-full p-3 md:w-1/2">
        <FancyCard raised>
          <h2 class="heading-text mb-6 text-center text-xl">Welcome Dinner Responses</h2>
          <div class="w-full">
            <GuestResponses :data="props.welcomeDinnerResponses" />
          </div>
        </FancyCard>
      </div>
    </div>
  </div>
</template>
