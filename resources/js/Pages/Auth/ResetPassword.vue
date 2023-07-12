<script setup>
  import {Head, useForm} from '@inertiajs/vue3';

  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PageSection from '@/Components/PageSection.vue';
  import TextInput from '@/Components/TextInput.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import HomeLayout from '@/Layouts/HomeLayout.vue';

  defineOptions({
    layout: HomeLayout
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
  <PageSection
    ref="section"
    has-header
    has-footer
    class="flex flex-col items-center justify-center"
  >
    <Head title="Confirm Password" />

    <BackgroundImage image="flowers" />

    <FancyCard animate logo raised class="w-full max-w-md">
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

        <div class="mt-4 flex items-center justify-end">
          <ThemeButton :processing="form.processing" variant="secondary"
            >Reset Password</ThemeButton
          >
        </div>
      </form>
    </FancyCard>
  </PageSection>
</template>
