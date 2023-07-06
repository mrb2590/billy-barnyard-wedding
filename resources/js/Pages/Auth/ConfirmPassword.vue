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

  const form = useForm({
    password: ''
  });

  const submit = () => {
    form.post(route('password.confirm'), {
      onFinish: () => form.reset()
    });
  };
</script>

<template>
  <AuthCard>
    <Head title="Confirm Password" />

    <div class="mb-4">
      This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="password" value="Password" />
        <TextInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="current-password"
          autofocus
        />
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="flex justify-end mt-4">
        <ThemeButton type="submit" class="ml-4" :processing="form.processing" variant="secondary">
          Confirm
        </ThemeButton>
      </div>
    </form>
  </AuthCard>
</template>
