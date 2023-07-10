<script setup>
  import {Head, useForm} from '@inertiajs/vue3';

  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PageSection from '@/Components/PageSection.vue';
  import TextInput from '@/Components/TextInput.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import ThemeLink from '@/Components/ThemeLink.vue';
  import HomeLayout from '@/Layouts/HomeLayout.vue';

  defineOptions({
    layout: HomeLayout
  });

  const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: ''
  });

  const submit = () => {
    form.post(route('register'), {
      onFinish: () => form.reset('password', 'password_confirmation')
    });
  };
</script>

<template>
  <PageSection
    ref="section"
    has-header
    has-footer
    class="flex flex-col justify-center items-center"
  >
    <Head title="Confirm Password" />

    <BackgroundImage image="flowers" />

    <FancyCard animate logo raised class="w-full max-w-md">
      <Head title="Register" />

      <form @submit.prevent="submit">
        <div>
          <InputLabel for="firstName" value="First Name" :error="form.errors.first_name" />
          <TextInput
            id="firstName"
            v-model="form.first_name"
            type="text"
            class="mt-1 block w-full"
            required
            autofocus
            autocomplete="given-name"
            :error="form.errors.first_name"
          />
          <InputError class="mt-2" :message="form.errors.first_name" />
        </div>

        <div class="mt-4">
          <InputLabel for="lastName" value="Last Name" :error="form.errors.last_name" />
          <TextInput
            id="lastName"
            v-model="form.last_name"
            type="text"
            class="mt-1 block w-full"
            required
            autocomplete="family-name"
            :error="form.errors.last_name"
          />
          <InputError class="mt-2" :message="form.errors.last_name" />
        </div>

        <div class="mt-4">
          <InputLabel for="email" value="Email" :error="form.errors.email" />
          <TextInput
            id="email"
            v-model="form.email"
            type="email"
            class="mt-1 block w-full"
            required
            autocomplete="username"
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
          <ThemeLink :href="route('login')">Already registered?</ThemeLink>

          <ThemeButton type="submit" class="ml-4" :processing="form.processing" variant="secondary">
            Register
          </ThemeButton>
        </div>
      </form>
    </FancyCard>
  </PageSection>
</template>
