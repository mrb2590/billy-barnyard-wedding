<script setup>
  import {useForm} from '@inertiajs/vue3';
  import {nextTick, ref} from 'vue';

  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import Modal from '@/Components/Modal.vue';
  import TextInput from '@/Components/TextInput.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';

  const confirmingUserDeletion = ref(false);
  const passwordInput = ref(null);

  const form = useForm({
    password: ''
  });

  const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
  };

  const deleteUser = () => {
    form.delete(route('profile.destroy'), {
      preserveScroll: true,
      onSuccess: () => closeModal(),
      onError: () => passwordInput.value.focus(),
      onFinish: () => form.reset()
    });
  };

  const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
  };
</script>

<template>
  <section class="space-y-6">
    <header>
      <h2 class="text-lg">Delete Account</h2>

      <p class="mt-1">
        Once your account is deleted, all of its resources and data will be permanently deleted.
        Before deleting your account, please download any data or information that you wish to
        retain.
      </p>
    </header>

    <ThemeButton variant="danger" @click="confirmUserDeletion">Delete Account</ThemeButton>

    <Modal :show="confirmingUserDeletion" @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg">Are you sure you want to delete your account?</h2>

        <p class="mt-1">
          Once your account is deleted, all of its resources and data will be permanently deleted.
          Please enter your password to confirm you would like to permanently delete your account.
        </p>

        <div class="mt-6">
          <InputLabel
            for="password"
            value="Password"
            class="sr-only"
            :error="form.errors.password"
          />
          <TextInput
            id="password"
            ref="passwordInput"
            v-model="form.password"
            type="password"
            class="mt-1 block w-3/4"
            placeholder="Password"
            :error="form.errors.password"
            @keyup.enter="deleteUser"
          />
          <InputError :message="form.errors.password" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
          <ThemeButton @click="closeModal">Cancel</ThemeButton>

          <ThemeButton
            class="ml-3"
            :processing="form.processing"
            variant="danger"
            @click="deleteUser"
          >
            Delete Account
          </ThemeButton>
        </div>
      </div>
    </Modal>
  </section>
</template>
