<script setup>
  import {Head, useForm} from '@inertiajs/vue3';
  import {onMounted, ref} from 'vue';

  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PageHeading from '@/Components/PageHeading.vue';
  import PageSection from '@/Components/PageSection.vue';
  import RadioButton from '@/Components/RadioButton.vue';
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
    class="flex flex-col justify-center items-center"
  >
    <Head title="RSVP">
      <meta
        head-key="description"
        name="description"
        content="Find your invitation to our wedding and RSVP!"
      />
    </Head>

    <BackgroundImage image="flowers" />

    <div class="relative w-full flex flex-col flex-center items-center">
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
          <form @submit.prevent="submit">
            <div v-for="(guest, i) in form.guests" :key="i">
              <h2 class="mb-6 text-xl md:text-2xl">
                {{ props.party.guests.find((g) => g.id === guest.id).name }}
              </h2>

              <div
                v-if="props.party.guests.find((g) => g.id === guest.id).has_rehearsal_invite"
                class="w-full"
              >
                <p class="mb-6">
                  We would like to invite you to a welcome dinner on Friday, September 15th at the
                  same address.
                </p>
                <InputLabel class="mb-2" value="Welcome Dinner" />
                <div
                  class="w-full flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 justify-between items-center mb-6"
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

              <InputLabel :for="`guest${guest.id}Accept`" class="mb-2" value="The Party" />
              <div
                class="w-full flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 justify-between items-center mb-6"
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

              <div class="my-6 border border-primary-300" />
            </div>
            <div class="flex justify-end">
              <ThemeButton type="submit" variant="secondary">Send RSVP</ThemeButton>
            </div>
          </form>
        </FancyCard>

        <FancyCard v-else animate raised class="w-full max-w-md text-center">
          <h2 class="mb-6 text-xl">Thank you</h2>
          <p>
            You may come back to update your RSVP at any time if necessarry, so please keep your
            RSVP code handy.
          </p>
        </FancyCard>
      </Transition>
    </div>
  </PageSection>
</template>
