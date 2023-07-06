<script setup>
  import {useForm, usePage} from '@inertiajs/vue3';

  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import TextInput from '@/Components/TextInput.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import ThemeLink from '@/Components/ThemeLink.vue';

  const props = defineProps({
    mustVerifyEmail: {
      type: Boolean,
      default: true
    },
    status: {
      type: String,
      default: null
    }
  });

  const user = usePage().props.auth.user;

  const form = useForm({
    first_name: user.first_name,
    last_name: user.last_name,
    email: user.email
  });
</script>

<template>
  <section>
    <header>
      <h2 class="text-lg">Profile Information</h2>

      <p class="mt-1">Update your account's profile information and email address.</p>
    </header>

    <form class="mt-6 space-y-6" @submit.prevent="form.patch(route('profile.update'))">
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

      <div>
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

      <div>
        <InputLabel for="email" value="Email" :error="form.errors.email" />
        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autocomplete="username"
          :error="form.errors.email"
        />
        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div v-if="props.mustVerifyEmail && user.email_verified_at === null">
        <p class="mt-2">
          Your email address is unverified.
          <ThemeLink :href="route('verification.send')" method="post" as="button">
            Click here to re-send the verification email.
          </ThemeLink>
        </p>

        <div
          v-show="props.status === 'verification-link-sent'"
          class="mt-2 font-medium text-sm text-success-700"
        >
          A new verification link has been sent to your email address.
        </div>
      </div>

      <div class="flex items-center gap-4">
        <ThemeButton :processing="form.processing" variant="secondary">Save</ThemeButton>

        <Transition
          enter-from-class="opacity-0"
          leave-to-class="opacity-0"
          class="transition ease-in-out"
        >
          <p v-if="form.recentlySuccessful" class="text-sm text-success-700">Saved.</p>
        </Transition>
      </div>
    </form>
  </section>
</template>
