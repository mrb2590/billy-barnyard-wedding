<script setup>
  import AppHead from '@/Components/AppHead.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import GuestForm from '@/Pages/Admin/Guests/Partials/GuestForm.vue';

  defineOptions({
    layout: AdminLayout
  });

  const props = defineProps({
    guest: {
      type: Object,
      required: true
    },
    parties: {
      type: Object,
      required: true
    }
  });
</script>

<template>
  <div class="container mx-auto p-6">
    <AppHead title="Create Guest - Admin" description="Create a wedding guest." />

    <FancyCard raised>
      <h1 class="mb-6 text-lg">Create Guest</h1>

      <GuestForm
        :guest="props.guest.data"
        :parties="props.parties.data"
        :api-route="route('api.guests.update', props.guest.data.id)"
        method="patch"
      />
    </FancyCard>
  </div>
</template>
