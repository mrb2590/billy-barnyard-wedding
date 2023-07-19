<script setup>
  import {router} from '@inertiajs/vue3';
  import {format, parseISO} from 'date-fns';
  import {ref} from 'vue';

  import AppHead from '@/Components/AppHead.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import Modal from '@/Components/Modal.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import AdminLayout from '@/Layouts/AdminLayout.vue';

  defineOptions({
    layout: AdminLayout
  });

  const props = defineProps({
    guest: {
      type: Object,
      required: true
    }
  });

  const confirmingDeletion = ref(false);
  const processingDeletion = ref(false);

  const deleteGuest = () => {
    processingDeletion.value = true;

    axios
      .delete(route('api.guests.destroy', props.guest.data.id))
      .then(() => router.visit(route('admin.guests.index')))
      .finally(() => (processingDeletion.value = false));
  };
</script>

<template>
  <div class="container mx-auto p-6">
    <AppHead
      :title="`${props.guest.data.name} - Guests - Admin`"
      description="View a wedding guest."
    />

    <FancyCard raised>
      <div
        class="mb-6 flex flex-col items-center justify-center space-y-4 sm:flex-row sm:justify-between sm:space-y-0"
      >
        <h1 class="text-lg">{{ props.guest.data.name }}</h1>

        <div class="space-x-4">
          <ThemeButton :href="route('admin.guests.edit', props.guest.data.id)" variant="secondary">
            Edit
          </ThemeButton>

          <ThemeButton variant="danger" @click="confirmingDeletion = true">Delete</ThemeButton>
        </div>
      </div>

      <div class="space-y-3 text-sm">
        <div>
          <div class="heading-text mb-1 text-base">First Name</div>
          <div>
            {{ props.guest.data.first_name }}
          </div>
        </div>

        <div>
          <div class="heading-text mb-1 text-base">Last Name</div>
          <div>
            {{ props.guest.data.last_name }}
          </div>
        </div>

        <div v-if="props.guest.data.email">
          <div class="heading-text mb-1 text-base">Email address</div>
          <div>
            {{ props.guest.data.email }}
          </div>
        </div>

        <div>
          <div class="heading-text mb-1 text-base">Invited to Welcome Dinner</div>
          <div>
            {{ props.guest.data.has_rehearsal_invite ? 'Yes' : 'No' }}
          </div>
        </div>

        <div v-if="props.guest.data.has_rehearsal_invite">
          <div class="heading-text mb-1 text-base">Attending Welcome Dinner</div>
          <div>
            {{
              props.guest.data.is_attending_rehearsal === null
                ? 'No response'
                : props.guest.data.is_attending_rehearsal
                ? 'Yes'
                : 'No'
            }}
          </div>
        </div>

        <div>
          <div class="heading-text mb-1 text-base">Atending Receiption</div>
          <div>
            {{
              props.guest.data.is_attending === null
                ? 'No response'
                : props.guest.data.is_attending
                ? 'Yes'
                : 'No'
            }}
          </div>
        </div>

        <div>
          <div class="heading-text mb-1 text-base">Adult or Child</div>
          <div>
            {{ props.guest.data.is_child ? 'Child' : 'Adult' }}
          </div>
        </div>

        <div>
          <div class="heading-text mb-1 text-base">Is Guest of a Guest</div>
          <div>
            {{ props.guest.data.is_guest ? 'Yes' : 'No' }}
          </div>
        </div>

        <div v-if="props.guest.data.side">
          <div class="heading-text mb-1 text-base">Side</div>
          <div>
            {{ props.guest.data.side }}
          </div>
        </div>

        <div v-if="props.guest.data.relation">
          <div class="heading-text mb-1 text-base">Relation</div>
          <div>
            {{ props.guest.data.relation }}
          </div>
        </div>

        <div v-if="props.guest.data.message_to_guest">
          <div class="heading-text mb-1 text-base">Message to Guest (Shown on RSVP)</div>
          <div>
            {{ props.guest.data.message_to_guest }}
          </div>
        </div>

        <div v-if="props.guest.data.message_from_guest">
          <div class="heading-text mb-1 text-base">Message from Guest (Set on RSVP)</div>
          <div>
            {{ props.guest.data.message_from_guest }}
          </div>
        </div>

        <div>
          <div class="heading-text mb-1 text-base">RSVP Responded</div>
          <div>
            {{
              props.guest.data.rsvp_responded_at
                ? format(parseISO(props.guest.data.rsvp_responded_at), 'MMM dd, yyyy h:mmaaa')
                : 'No response'
            }}
          </div>
        </div>
      </div>
    </FancyCard>

    <Modal :show="confirmingDeletion" @close="confirmingDeletion = false">
      <div class="p-6">
        <h2 class="text-lg">Are you sure you want to delete the guest?</h2>

        <div class="mt-6 flex justify-end">
          <ThemeButton @click="confirmingDeletion = false">Cancel</ThemeButton>

          <ThemeButton
            class="ml-3"
            :processing="processingDeletion"
            variant="danger"
            @click="deleteGuest"
          >
            Delete Guest
          </ThemeButton>
        </div>
      </div>
    </Modal>
  </div>
</template>
