<script setup>
  import {Head, useForm} from '@inertiajs/vue3';

  import Checkbox from '@/Components/Checkbox.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import TextInput from '@/Components/TextInput.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import ThemeLink from '@/Components/ThemeLink.vue';
  import GuestLayout from '@/Layouts/GuestLayout.vue';
  import AuthCard from '@/Pages/Auth/Partials/AuthCard.vue';

  defineOptions({
    layout: GuestLayout
  });

  const props = defineProps({
    canResetPassword: {
      type: Boolean
    },
    status: {
      type: String,
      default: null
    }
  });

  const form = useForm({
    email: '',
    password: '',
    remember: false
  });

  const submit = () => {
    form.post(route('login'), {
      onFinish: () => form.reset('password')
    });
  };
</script>

<template>
  <AuthCard>
    <Head title="Log in" />

    <div v-if="status" class="mb-4 text-success-700">
      {{ props.status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="email" value="Email" />
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
        <InputLabel for="password" value="Password" />
        <TextInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="current-password"
          :error="form.errors.password"
        />
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="block mt-4">
        <InputLabel class="flex items-center">
          <Checkbox v-model:checked="form.remember" name="remember" />
          <span class="ml-2">Remember me</span>
        </InputLabel>
      </div>

      <div class="flex items-center justify-end mt-4">
        <ThemeLink v-if="props.canResetPassword" :href="route('password.request')">
          Forgot your password?
        </ThemeLink>

        <ThemeButton variant="secondary" type="submit" class="ml-4" :processing="form.processing">
          Log in
        </ThemeButton>
      </div>
    </form>
  </AuthCard>
</template>
