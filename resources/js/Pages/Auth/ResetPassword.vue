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

  const props = defineProps({
    email: {
      type: String,
      required: true
    },
    token: {
      type: String,
      required: true
    }
  });

  const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: ''
  });

  const submit = () => {
    form.post(route('password.store'), {
      onFinish: () => form.reset('password', 'password_confirmation')
    });
  };
</script>

<template>
  <AuthCard>
    <Head title="Reset Password" />

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

      <div class="mt-4">
        <InputLabel for="password" value="Password" :error="form.errors.password" />
        <TextInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
          :error="form.errors.password"
        />
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-4">
        <InputLabel
          for="password_confirmation"
          value="Confirm Password"
          :error="form.errors.password_confirmation"
        />
        <TextInput
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
          :error="form.errors.password_confirmation"
        />
        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <ThemeButton :processing="form.processing" variant="secondary">Reset Password</ThemeButton>
      </div>
    </form>
  </AuthCard>
</template>
