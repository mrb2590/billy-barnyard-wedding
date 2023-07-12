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
    class="rounded-sm border-primary-700 bg-white p-2 font-primary font-bold tracking-widest text-primary-700 transition focus:border-primary-700 focus:ring-1 focus:ring-primary-700 focus:ring-offset-2 focus:ring-offset-primary-400 error:border-danger-700 error:focus:ring-danger-700"
    :value="props.modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>
