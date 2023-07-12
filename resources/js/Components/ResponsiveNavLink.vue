<script setup>
  import {Link} from '@inertiajs/vue3';
  import {computed} from 'vue';

  const props = defineProps({
    href: {
      type: String,
      default: null
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
    class="block w-full py-2 pl-3 pr-4 text-left font-primary text-lg font-bold uppercase not-italic text-primary-700 transition duration-150 ease-in-out hover:bg-primary-100 focus:outline-none"
  >
    <slot />
  </Link>
</template>
