<script setup>
  import {format, parseISO} from 'date-fns';
  import {onMounted, ref} from 'vue';

  import AppHead from '@/Components/AppHead.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import PaginatedTable from '@/Components/PaginatedTable.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import AdminLayout from '@/Layouts/AdminLayout.vue';

  defineOptions({
    layout: AdminLayout
  });

  const columns = ref([]);

  onMounted(() => {
    columns.value = [
      {
        title: 'First Name',
        field: 'first_name',
        href: (row) => route('admin.guests.show', row.id)
      },
      {
        title: 'Last Name',
        field: 'last_name'
      },
      {
        title: 'Party',
        field: 'party',
        getValue: (value) => value.name
      },
      {
        title: 'Email',
        field: 'email'
      },
      {
        title: 'Reception',
        field: 'is_attending',
        getValue: (value) => {
          return value === null ? '-' : value ? 'Yes' : 'No';
        },
        align: 'center'
      },
      {
        title: 'Welcome Dinner Invited',
        field: 'has_rehearsal_invite',
        getValue: (value) => {
          return value === null ? '-' : value ? 'Yes' : 'No';
        },
        align: 'center'
      },
      {
        title: 'Welcome Dinner',
        field: 'is_attending_rehearsal',
        getValue: (value) => {
          return value === null ? '-' : value ? 'Yes' : 'No';
        },
        align: 'center'
      },
      {
        title: 'Responded',
        field: 'rsvp_responded_at',
        getValue: (value) => {
          return value === null ? '-' : format(parseISO(value), 'MMM dd, yyyy h:mmaaa');
        }
      }
    ];
  });
</script>

<template>
  <div class="container mx-auto p-6">
    <AppHead title="Guests - Admin" description="View your the wedding guests." />

    <FancyCard raised>
      <div
        class="mb-6 flex flex-col items-center justify-center space-y-4 sm:flex-row sm:justify-between sm:space-y-0"
      >
        <h1 class="text-lg">Guests</h1>

        <ThemeButton :href="route('admin.guests.create')" variant="secondary"> Create </ThemeButton>
      </div>

      <PaginatedTable :api-route="route('api.guests.index')" :columns="columns" />
    </FancyCard>
  </div>
</template>
