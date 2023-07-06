<script setup>
  import {Head, useForm} from '@inertiajs/vue3';

  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import TextInput from '@/Components/TextInput.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import GuestLayout from '@/Layouts/GuestLayout.vue';
  import AuthCard from '@/Pages/Auth/Partials/AuthCard.vue';

  defineOptions({
    layout: GuestLayout
  });

  defineProps({
    status: {
      type: String,
      default: null
    }
  });

  const form = useForm({
    email: ''
  });

  const submit = () => {
    form.post(route('password.email'));
  };
</script>

<template>
  <AuthCard>
    <Head title="Forgot Password" />

    <div class="mb-4">
      Forgot your password? No problem. Just let us know your email address and we will email you a
      password reset link that will allow you to choose a new one.
    </div>

    <div v-if="status" class="mb-4 text-success-700">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="email" value="Email" :error="form.errors.email" />
        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="username"
          :error="form.errors.email"
        />
        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <ThemeButton :processing="form.processing" variant="secondary">
          Email Password Reset Link
        </ThemeButton>
      </div>
    </form>
  </AuthCard>
</template>
