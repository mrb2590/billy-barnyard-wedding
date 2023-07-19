<script setup>
  import {computed} from 'vue';

  const emit = defineEmits(['update:checked']);

  const props = defineProps({
    checked: {
      type: [Array, Boolean],
      default: null
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
    class="rounded-sm border-primary-700 bg-white text-primary-700 transition checked:bg-primary-700 focus:border-primary-700 focus:ring-1 focus:ring-primary-700 focus:ring-offset-2 focus:ring-offset-primary-400 error:border-danger-700 error:focus:ring-danger-700"
  />
</template>
