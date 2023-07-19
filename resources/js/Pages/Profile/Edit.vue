<script setup>
  import AppHead from '@/Components/AppHead.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
  import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
  import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

  defineOptions({
    layout: AdminLayout
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
  <div class="container mx-auto space-y-6 p-6">
    <AppHead title="Profile" description="Edit your profile here." />

    <FancyCard raised>
      <UpdateProfileInformationForm
        :must-verify-email="props.mustVerifyEmail"
        :status="props.status"
        class="max-w-xl"
      />
    </FancyCard>

    <FancyCard raised>
      <UpdatePasswordForm class="max-w-xl" />
    </FancyCard>

    <FancyCard raised>
      <DeleteUserForm class="max-w-xl" />
    </FancyCard>
  </div>
</template>
