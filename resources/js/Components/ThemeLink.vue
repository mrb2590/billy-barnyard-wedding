<script setup>
  import {Link} from '@inertiajs/vue3';

  const props = defineProps({
    href: {
      type: String,
      default: null
    },
    external: {
      type: Boolean,
      default: false
    }
  });

  const classes = [
    'focus:outline-none',
    'focus-visible:ring-2',
    'focus-visible:ring-primary-700',
    'focus-visible:ring-offset-1',
    'focus-visible:ring-offset-primary-400',
    'disabled:pointer-events-none',
    'text-secondary-600',
    'hover:text-secondary-500',
    'transition',
    'duration-150',
    'ease-in-out',
    'rounded-sm'
  ];
</script>

<template>
  <Link v-if="!props.external" :href="props.href" :class="classes">
    <slot />
  </Link>
  <a v-else :href="props.href" :class="classes">
    <slot />
  </a>
</template>
