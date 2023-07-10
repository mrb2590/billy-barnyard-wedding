<script setup>
  import {computed} from 'vue';

  const emit = defineEmits(['update:checked']);

  const props = defineProps({
    checked: {
      type: [Array, Boolean],
      required: true
    },
    value: {
      type: [String, Number, Boolean],
      default: null
    }
  });

  const proxyChecked = computed({
    get() {
      return props.checked;
    },

    set(val) {
      emit('update:checked', val);
    }
  });
</script>

<template>
  <input
    v-model="proxyChecked"
    type="checkbox"
    :value="props.value"
    class="focus:ring-1 focus:ring-primary-700 focus:ring-offset-2 focus:ring-offset-primary-400 error:focus:ring-danger-700 error:border-danger-700 border-primary-700 checked:bg-primary-700 focus:border-primary-700 text-primary-700 rounded-sm bg-white transition"
  />
</template>
