<script setup>
  import {onMounted, ref} from 'vue';

  const props = defineProps({
    modelValue: {
      type: String,
      required: true
    },
    error: {
      type: String,
      default: null
    }
  });

  defineEmits(['update:modelValue']);

  const input = ref(null);

  onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
      input.value.focus();
    }
  });

  defineExpose({focus: () => input.value.focus()});
</script>

<template>
  <input
    ref="input"
    :data-error="!!props.error"
    class="text-primary-700 focus:ring-1 focus:ring-primary-700 focus:ring-offset-1 focus:ring-offset-primary-400 error:focus:ring-danger-700 error:border-danger-700 border-primary-700 focus:border-primary-700 font-primary font-bold tracking-widest rounded-sm bg-white p-2 transition"
    :value="props.modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>
