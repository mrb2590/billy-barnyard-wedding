<script setup>
  import {Link} from '@inertiajs/vue3';

  defineProps({
    href: {
      type: String,
      required: true
    }
  });
</script>

<template>
  <Link
    :href="href"
    class="block w-full px-4 py-2 text-left font-primary font-bold uppercase not-italic leading-5 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
  >
    <slot />
  </Link>
</template>
