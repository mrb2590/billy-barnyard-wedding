<script setup>
  import {router} from '@inertiajs/vue3';
  import axios from 'axios';
  import {ref} from 'vue';

  import Checkbox from '@/Components/Checkbox.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import SelectInput from '@/Components/SelectInput.vue';
  import TextareaInput from '@/Components/TextareaInput.vue';
  import TextInput from '@/Components/TextInput.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';

  const props = defineProps({
    guest: {
      type: Object,
      default: null
    },
    parties: {
      type: Array,
      required: true
    },
    apiRoute: {
      type: String,
      required: true
    },
    method: {
      type: String,
      required: true
    }
  });

  const form = ref({
    first_name: props.guest ? props.guest.first_name : '',
    last_name: props.guest ? props.guest.last_name : '',
    email: props.guest ? props.guest.email : '',
    is_child: props.guest ? props.guest.is_child : false,
    is_guest: props.guest ? props.guest.is_guest : false,
    is_attending: props.guest ? props.guest.is_attending : null,
    has_rehearsal_invite: props.guest ? props.guest.has_rehearsal_invite : false,
    is_attending_rehearsal: props.guest ? props.guest.is_attending_rehearsal : null,
    side: props.guest ? props.guest.side : null,
    relation: props.guest ? props.guest.relation : '',
    message_to_guest: props.guest ? props.guest.message_to_guest : '',
    message_from_guest: props.guest ? props.guest.message_from_guest : '',
    notes: props.guest ? props.guest.notes : '',
    party_id: props.guest ? props.guest.party_id : null
  });
  const errors = ref({});

  const submit = () => {
    axios[props.method](props.apiRoute, form.value)
      .then((response) => {
        router.visit(route('admin.guests.show', response.data.data.id));
      })
      .catch((error) => {
        if (error.response.status === 422) {
          errors.value = error.response.data.errors;
        } else {
          console.log('other error');
        }
      });
  };
</script>

<template>
  <form class="mt-6 max-w-xl space-y-6" @submit.prevent="submit">
    <div>
      <InputLabel for="firstName" value="First Name" :error="errors.first_name" />
      <TextInput
        id="firstName"
        v-model="form.first_name"
        type="text"
        class="mt-1 block w-full"
        required
        :error="errors.first_name"
      />
      <InputError class="mt-2" :message="errors.first_name" />
    </div>

    <div>
      <InputLabel for="lastName" value="Last Name" :error="errors.last_name" />
      <TextInput
        id="lastName"
        v-model="form.last_name"
        type="text"
        class="mt-1 block w-full"
        required
        autocomplete="family-name"
        :error="errors.last_name"
      />
      <InputError class="mt-2" :message="errors.last_name" />
    </div>

    <div>
      <InputLabel for="email" value="Email" :error="errors.email" />
      <TextInput
        id="email"
        v-model="form.email"
        type="email"
        class="mt-1 block w-full"
        autocomplete="username"
        :error="errors.email"
      />
      <InputError class="mt-2" :message="errors.email" />
    </div>

    <div class="mt-4 block">
      <InputLabel class="flex items-center" :error="errors.is_child">
        <Checkbox v-model:checked="form.is_child" />
        <span class="ml-2">This guest is a child</span>
      </InputLabel>
      <InputError class="mt-2" :message="errors.is_child" />
    </div>

    <div class="mt-4 block">
      <InputLabel class="flex items-center" :error="errors.is_guest">
        <Checkbox v-model:checked="form.is_guest" />
        <span class="ml-2">This guest is a guest of another guest</span>
      </InputLabel>
      <InputError class="mt-2" :message="errors.is_guest" />
    </div>

    <div class="mt-4 block">
      <InputLabel class="flex items-center" :error="errors.has_rehearsal_invite">
        <Checkbox v-model:checked="form.has_rehearsal_invite" />
        <span class="ml-2">Invited to welcome dinner</span>
      </InputLabel>
      <InputError class="mt-2" :message="errors.has_rehearsal_invite" />
    </div>

    <div>
      <InputLabel for="side" value="Side" :error="errors.side" />
      <SelectInput
        id="side"
        v-model="form.side"
        class="mt-1 block w-full"
        :error="errors.side"
        required
        :options="[
          {value: 'his', title: 'His'},
          {value: 'hers', title: 'Hers'},
          {value: 'both', title: 'Both'}
        ]"
      />
      <InputError class="mt-2" :message="errors.side" />
    </div>

    <div>
      <InputLabel for="relation" value="Relation" :error="errors.relation" />
      <TextInput
        id="relation"
        v-model="form.relation"
        type="text"
        class="mt-1 block w-full"
        required
        :error="errors.relation"
      />
      <InputError class="mt-2" :message="errors.relation" />
    </div>

    <div>
      <InputLabel for="messageToGuest" value="Message to Guest" :error="errors.message_to_guest" />
      <TextareaInput
        id="messageToGuest"
        v-model="form.message_to_guest"
        type="text"
        class="mt-1 block w-full"
        :error="errors.message_to_guest"
      />
      <InputError class="mt-2" :message="errors.message_to_guest" />
    </div>

    <div>
      <InputLabel
        for="messageFromGuest"
        value="Message from Guest"
        :error="errors.message_from_guest"
      />
      <TextareaInput
        id="messageFromGuest"
        v-model="form.message_from_guest"
        type="text"
        class="mt-1 block w-full"
        :error="errors.message_from_guest"
      />
      <InputError class="mt-2" :message="errors.message_from_guest" />
    </div>

    <div>
      <InputLabel for="notes" value="Notes" :error="errors.notes" />
      <TextareaInput
        id="notes"
        v-model="form.notes"
        type="text"
        class="mt-1 block w-full"
        :error="errors.notes"
      />
      <InputError class="mt-2" :message="errors.notes" />
    </div>

    <div>
      <InputLabel for="partyId" value="Party" :error="errors.party_id" />
      <SelectInput
        id="partyId"
        v-model="form.party_id"
        class="mt-1 block w-full"
        :error="errors.party_id"
        required
        :options="
          props.parties.map((party) => {
            return {value: party.id, title: party.name};
          })
        "
      />
      <InputError class="mt-2" :message="errors.party_id" />
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
</template>
