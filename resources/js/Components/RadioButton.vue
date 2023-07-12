<script setup>
  import {computed} from 'vue';

  import Check from '@/Components/Check.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';

  const emit = defineEmits(['update:checked']);

  const props = defineProps({
    checked: {
      type: [String, Number, Boolean, Array],
      required: true
    },
    value: {
      type: [String, Number, Boolean, Array],
      default: null
    },
    name: {
      type: String,
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
  <div class="inline-flex">
    <ThemeButton
      type="button"
      class="block w-full transition-all"
      :variant="props.checked === props.value ? 'success' : 'primary'"
      @click="proxyChecked = props.value"
    >
      <slot />
      <span v-if="props.checked === props.value">
        <Check class="ml-2 h-3 w-3" />
      </span>
    </ThemeButton>
    <input
      v-model="proxyChecked"
      class="!hidden"
      type="radio"
      :name="props.name"
      :value="props.value"
    />
  </div>
</template>
