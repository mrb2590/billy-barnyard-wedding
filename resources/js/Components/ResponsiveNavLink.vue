<script setup>
  import {Link} from '@inertiajs/vue3';
  import {computed} from 'vue';

  const props = defineProps({
    href: {
      type: String,
      required: true
    },
    active: {
      type: Boolean
    }
  });

  const classes = computed(() => (props.active ? 'border-l-4 border-primary-700' : ''));
</script>

<template>
  <Link
    :href="href"
    :class="classes"
    class="block w-full pl-3 pr-4 py-2 text-left text-lg font-bold font-primary uppercase not-italic text-primary-700 hover:bg-primary-100 focus:outline-none transition duration-150 ease-in-out"
  >
    <slot />
  </Link>
</template>
