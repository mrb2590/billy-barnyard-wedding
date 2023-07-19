<script setup>
  const props = defineProps({
    modelValue: {
      type: [String, Boolean, Number],
      default: null
    },
    error: {
      type: [Array, String],
      default: null
    },
    options: {
      type: Object,
      required: true
    }
  });

  defineEmits(['update:modelValue']);
</script>

<template>
  <select
    ref="input"
    :data-error="!!props.error"
    class="rounded-sm border-primary-700 bg-white p-2 font-primary font-bold tracking-widest text-primary-700 transition focus:border-primary-700 focus:ring-1 focus:ring-primary-700 focus:ring-offset-2 focus:ring-offset-primary-400 error:border-danger-700 error:focus:ring-danger-700"
    :value="props.modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  >
    <option :value="null">Select One</option>
    <option
      v-for="(option, i) in props.options"
      :key="i"
      :value="option.value"
      :selected="option.value === props.modelValue"
    >
      {{ option.title }}
    </option>
  </select>
</template>
