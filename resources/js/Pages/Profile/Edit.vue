<script setup>
  import {Head} from '@inertiajs/vue3';

  import FancyCard from '@/Components/FancyCard.vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

  import DeleteUserForm from './Partials/DeleteUserForm.vue';
  import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
  import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

  defineOptions({
    layout: AuthenticatedLayout
  });

  const props = defineProps({
    mustVerifyEmail: {
      type: Boolean
    },
    status: {
      type: String,
      default: null
    }
  });
</script>

<template>
  <div>
    <Head title="Profile" />

    <div class="container mx-auto p-6 space-y-6">
      <FancyCard>
        <UpdateProfileInformationForm
          :must-verify-email="props.mustVerifyEmail"
          :status="props.status"
          class="max-w-xl"
        />
      </FancyCard>

      <FancyCard>
        <UpdatePasswordForm class="max-w-xl" />
      </FancyCard>

      <FancyCard>
        <DeleteUserForm class="max-w-xl" />
      </FancyCard>
    </div>
  </div>
</template>
