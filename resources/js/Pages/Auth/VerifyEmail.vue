<script setup>
  import {Head, Link, useForm} from '@inertiajs/vue3';
  import {computed} from 'vue';

  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import GuestLayout from '@/Layouts/GuestLayout.vue';

  const props = defineProps({
    status: {
      type: String,
      default: null
    }
  });

  const form = useForm({});

  const submit = () => {
    form.post(route('verification.send'));
  };

  const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
  <GuestLayout>
    <Head title="Email Verification" />

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
      Thanks for signing up! Before getting started, could you verify your email address by clicking
      on the link we just emailed to you? If you didn't receive the email, we will gladly send you
      another.
    </div>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
      You can access
      <Link
        :href="route('profile.edit')"
        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
      >
        your profile here
      </Link>
      if you need to update your email address or delete your account.
    </div>

    <div
      v-if="verificationLinkSent"
      class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
    >
      A new verification link has been sent to the email address you provided during registration.
    </div>

    <form @submit.prevent="submit">
      <div class="mt-4 flex items-center justify-between">
        <PrimaryButton :class="{'opacity-25': form.processing}" :disabled="form.processing">
          Resend Verification Email
        </PrimaryButton>

        <Link
          :href="route('logout')"
          method="post"
          as="button"
          class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
        >
          Log Out
        </Link>
      </div>
    </form>
  </GuestLayout>
</template>