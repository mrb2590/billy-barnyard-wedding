<script setup>
  import {useForm} from '@inertiajs/vue3';
  import {nextTick} from 'vue';

  import AppHead from '@/Components/AppHead.vue';
  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PageHeading from '@/Components/PageHeading.vue';
  import PageSection from '@/Components/PageSection.vue';
  import TextInput from '@/Components/TextInput.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import ThemeLink from '@/Components/ThemeLink.vue';
  import HomeLayout from '@/Layouts/HomeLayout.vue';

  defineOptions({
    layout: HomeLayout
  });

  const form = useForm({
    last_name: '',
    rsvp_code: ''
  });

  const submit = () => {
    form.post(route('party-search.store'), {
      preserveScroll: true,
      onSuccess: () => {
        form.reset();
      }
    });
  };

  const validateRSVPCode = () => {
    let code = form.rsvp_code;
    if (!/^[a-zA-Z0-9]{0,6}$/.test(code)) {
      code = code.substring(0, code.length - 1);
    }

    if (form.rsvp_code !== code)
      nextTick(() => {
        form.rsvp_code = code;
      });
  };
</script>

<template>
  <PageSection class="flex flex-col items-center justify-center" has-header has-footer>
    <AppHead
      title="RSVP"
      description="Search for your invitation with your last name and RSVP code and RSVP to our wedding."
    />

    <BackgroundImage image="flowers" />

    <PageHeading animate>
      <h1>RSVP</h1>
    </PageHeading>

    <FancyCard animate logo raised class="w-full max-w-md">
      <form @submit.prevent="submit">
        <p class="mb-4 text-center">
          Enter your last name and the RSVP code found under the QR code on your invitation. You may
          RSVP for all guests in your party.
        </p>
        <p class="mb-10 text-center">
          If you have any issues using the website to RSVP, please send us an email at
          <ThemeLink
            href="mailto:billybarnyard@buonomon.net?subject=RSVP%20for%20the%20Billy%20Barnyard%20Wedding"
            external
            >billybarnyard@buonomo.net</ThemeLink
          >.
        </p>

        <div>
          <InputLabel for="lastName" value="Last Name" :error="form.errors.last_name" />
          <TextInput
            id="lastName"
            v-model="form.last_name"
            type="text"
            class="mt-1 block w-full"
            autocomplete="family-name"
            :error="form.errors.last_name"
            required
          />
          <InputError class="mt-2" :message="form.errors.last_name" />
        </div>

        <div class="mt-4">
          <InputLabel for="rsvpCode" value="RSVP Code" :error="form.errors.rsvp_code" />
          <TextInput
            id="rsvpCode"
            v-model="form.rsvp_code"
            type="text"
            class="mt-1 block w-full uppercase"
            pattern="^[a-zA-Z0-9]{6}$"
            required
            :error="form.errors.rsvp_code"
            @input="validateRSVPCode"
          />
          <InputError class="mt-2" :message="form.errors.rsvp_code" />
        </div>

        <div class="flex justify-end">
          <ThemeButton
            type="submit"
            variant="secondary"
            class="mt-4 self-end"
            :processing="form.processing"
          >
            Search
          </ThemeButton>
        </div>
      </form>
    </FancyCard>
  </PageSection>
</template>
