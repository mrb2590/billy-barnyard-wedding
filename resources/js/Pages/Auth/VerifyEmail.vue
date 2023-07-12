<script setup>
  import {useForm} from '@inertiajs/vue3';
  import {computed} from 'vue';

  import AppHead from '@/Components/AppHead.vue';
  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import PageSection from '@/Components/PageSection.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import ThemeLink from '@/Components/ThemeLink.vue';
  import HomeLayout from '@/Layouts/HomeLayout.vue';

  defineOptions({
    layout: HomeLayout
  });

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
  <PageSection
    ref="section"
    has-header
    has-footer
    class="flex flex-col items-center justify-center"
  >
    <AppHead title="Email Vertification" description="Verify your email here." />

    <BackgroundImage image="flowers" />

    <FancyCard animate logo raised class="w-full max-w-md">
      <div class="mb-4">
        Thanks for signing up! Before getting started, could you verify your email address by
        clicking on the link we just emailed to you? If you didn't receive the email, we will gladly
        send you another.
      </div>

      <div class="mb-4">
        You can access
        <ThemeLink :href="route('profile.edit')">your profile here</ThemeLink>
        if you need to update your email address or delete your account.
      </div>

      <div v-if="verificationLinkSent" class="mb-4 text-success-700">
        A new verification link has been sent to the email address you provided during registration.
      </div>

      <form @submit.prevent="submit">
        <div class="mt-4 flex items-center justify-between">
          <ThemeButton :processing="form.processing" variant="secondary">
            Resend Verification Email
          </ThemeButton>

          <ThemeLink :href="route('logout')" method="post" as="button">Log Out</ThemeLink>
        </div>
      </form>
    </FancyCard>
  </PageSection>
</template>
