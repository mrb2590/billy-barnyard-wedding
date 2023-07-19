<script setup>
  import {useForm} from '@inertiajs/vue3';
  import {onMounted, ref} from 'vue';

  import AppHead from '@/Components/AppHead.vue';
  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PageHeading from '@/Components/PageHeading.vue';
  import PageSection from '@/Components/PageSection.vue';
  import RadioButton from '@/Components/RadioButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import HomeLayout from '@/Layouts/HomeLayout.vue';

  defineOptions({
    layout: HomeLayout
  });

  const props = defineProps({
    party: {
      type: Object,
      required: true
    }
  });

  const showThankYou = ref(false);

  const form = useForm({
    rsvp_code: props.party.rsvp_code,
    guests: []
  });

  const submit = () => {
    form.patch(route('party.update', props.party.id), {
      preserveScroll: true,
      onSuccess: () => {
        form.reset();
        showThankYou.value = true;
      },
      onError: () => {}
    });
  };

  const buildForm = () => {
    form.guests = [
      ...props.party.guests.map((guest) => {
        return {
          id: guest.id,
          email: guest.email ?? '',
          is_attending: guest.is_attending,
          is_attending_rehearsal: guest.is_attending_rehearsal
        };
      })
    ];
  };

  onMounted(buildForm);
</script>

<template>
  <PageSection
    ref="section"
    has-header
    has-footer
    class="flex flex-col items-center justify-center"
  >
    <AppHead title="RSVP" description="Send your RSVP." />

    <BackgroundImage image="flowers" />

    <div class="flex-center relative flex w-full flex-col items-center">
      <PageHeading animate>
        <h1>RSVP</h1>
      </PageHeading>

      <Transition
        enter-active-class="transition ease-out duration-500"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-in duration-500"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
        appear
        mode="out-in"
      >
        <FancyCard v-if="!showThankYou" animate raised logo class="relative w-full max-w-md">
          <p class="mb-4 text-center">
            We ask that you RSVP by August 1st, but if you need to update your RSVP or are a bit
            late, we will still be notified and appretiate your response.
          </p>
          <p class="mb-4 text-center">
            Select Accept or Decline for each guest in your party, then click or tap the Send RSVP
            button at the bottom of the page to submit the form.
          </p>

          <div class="my-6 border border-primary-300" />

          <div v-if="party.message_to_party">
            <div class="heading-text mb-4">A message from the bride & groom</div>
            <p>{{ party.message_to_party }}</p>

            <div class="my-6 border border-primary-300" />
          </div>

          <form @submit.prevent="submit">
            <div v-for="(guest, i) in form.guests" :key="i">
              <h2 class="mb-6 text-xl md:text-2xl">
                {{ props.party.guests.find((g) => g.id === guest.id).name }}
              </h2>

              <div
                v-if="props.party.guests.find((g) => g.id === guest.id).message_to_guest"
                class="mb-6"
              >
                <p>{{ props.party.guests.find((g) => g.id === guest.id).message_to_guest }}</p>
              </div>

              <div
                v-if="props.party.guests.find((g) => g.id === guest.id).has_rehearsal_invite"
                class="w-full"
              >
                <p class="mb-6">
                  We would like to invite you to a welcome dinner on Friday, September 15th, 7:00PM
                  at the same address as the reception.
                </p>

                <InputLabel value="Welcome Dinner" />
                <div
                  class="mb-6 mt-2 flex w-full flex-col items-center justify-between space-y-4 md:flex-row md:space-x-4 md:space-y-0"
                >
                  <RadioButton
                    v-model:checked="
                      form.guests.find((g) => g.id === guest.id).is_attending_rehearsal
                    "
                    class="w-full md:w-auto"
                    :name="`guest${guest.id}RehearsalAccept`"
                    :value="true"
                  >
                    <span class="ml-2">Accepts</span>
                  </RadioButton>
                  <RadioButton
                    v-model:checked="
                      form.guests.find((g) => g.id === guest.id).is_attending_rehearsal
                    "
                    class="w-full md:w-auto"
                    :name="`guest${guest.id}RehearsalAccept`"
                    :value="false"
                  >
                    <span class="ml-2">Declines</span>
                  </RadioButton>
                </div>
              </div>

              <InputLabel :for="`guest${guest.id}Accept`" value="Reception" />
              <div
                class="mb-6 mt-2 flex w-full flex-col items-center justify-between space-y-4 md:flex-row md:space-x-4 md:space-y-0"
              >
                <RadioButton
                  v-model:checked="form.guests.find((g) => g.id === guest.id).is_attending"
                  class="w-full md:w-auto"
                  :name="`guest${guest.id}Accept`"
                  :value="true"
                >
                  <span class="ml-2">Accepts</span>
                </RadioButton>
                <RadioButton
                  v-model:checked="form.guests.find((g) => g.id === guest.id).is_attending"
                  class="w-full md:w-auto"
                  :name="`guest${guest.id}Accept`"
                  :value="false"
                >
                  <span class="ml-2">Declines</span>
                </RadioButton>
              </div>

              <div>
                <InputLabel
                  for="email"
                  value="Email Address"
                  :error="form.errors[`guests.${i}.email`]"
                />
                <TextInput
                  id="email"
                  v-model="form.guests.find((g) => g.id === guest.id).email"
                  type="text"
                  class="mt-1 block w-full"
                  autocomplete="email"
                  :error="form.errors[`guests.${i}.email`]"
                />
                <InputError class="mt-2" :message="form.errors[`guests.${i}.email`]" />
                <p class="mt-2 text-sm">
                  <span v-if="form.guests.find((g) => g.id === guest.id).email">
                    You will receive notifications regarding your RSVP and the wedding at the email
                    address above. You may clear your email address if you do not want to receive
                    any notifications.
                  </span>
                  <span v-else>
                    Enter your email address to recieve notifications about your RSVP and the
                    wedding.
                  </span>
                </p>
              </div>

              <div class="my-6 border border-primary-300" />
            </div>

            <InputError
              v-if="form.hasErrors"
              class="mb-4"
              message="Please fix all errors then try again."
            />

            <div class="flex justify-end">
              <ThemeButton type="submit" variant="secondary">Send RSVP</ThemeButton>
            </div>
          </form>
        </FancyCard>

        <FancyCard v-else animate raised class="w-full max-w-md text-center">
          <h2 class="mb-6 text-xl">Thank you</h2>
          <p class="mb-4">We have received your RSVP.</p>
          <p>
            You may come back to update your RSVP at any time if necessarry, so please keep your
            RSVP code handy.
          </p>
        </FancyCard>
      </Transition>
    </div>
  </PageSection>
</template>
