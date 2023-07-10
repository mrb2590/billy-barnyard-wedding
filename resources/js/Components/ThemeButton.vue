<script setup>
  import {Link} from '@inertiajs/vue3';
  import {ref} from 'vue';

  const props = defineProps({
    href: {
      type: String,
      default: null
    },
    external: {
      type: Boolean,
      default: false
    },
    processing: {
      type: Boolean,
      default: false
    },
    processingText: {
      type: String,
      default: null
    },
    variant: {
      type: String,
      default: 'primary',
      validator(value) {
        return ['primary', 'secondary', 'nav', 'success', 'danger'].includes(value);
      }
    },
    raised: {
      type: Boolean,
      default: false
    }
  });

  const classes = ref([
    'active:scale-95',
    'disabled:active:scale-100',
    'disabled:hover:scale-100',
    'duration-150',
    'ease-in-out',
    'focus-visible:ring-2',
    'focus-visible:ring-offset-2',
    'focus-visible:ring-offset-primary-400',
    'focus-visible:ring-primary-700',
    'focus:outline-none',
    'font-bold',
    'font-primary',
    'hover:scale-105',
    'inline-flex',
    'items-center',
    'justify-center',
    'not-italic',
    'processing:cursor-',
    'px-3',
    'py-2',
    'rounded-sm',
    'tracking-widest',
    'transition',
    'uppercase',
    'whitespace-nowrap'
  ]);

  const variantClasses = {
    primary: [
      'bg-white',
      'border-primary-700',
      'border',
      'disabled:bg-gray-300',
      'text-primary-700'
    ],
    secondary: [
      'bg-primary-700',
      'border-primary-700',
      'border',
      'disabled:bg-gray-300',
      'text-white'
    ],
    nav: [
      'bg-transparent',
      'border-none',
      'disabled:bg-transparent',
      'text-xl',
      'text-shadow-default',
      'text-white'
    ],
    success: [
      'active:bg-success-800',
      'bg-success-700',
      'border-success-700',
      'border',
      'text-white'
    ],
    danger: ['active:bg-danger-800', 'bg-danger-700', 'border-danger-700', 'border', 'text-white']
  };

  if (props.href) {
    classes.value.push('processing:pointer-events-none');
  }

  if (props.raised) {
    classes.value.push('raised');
  }
</script>

<template>
  <Link
    v-if="props.href && !props.external"
    :data-processing="props.processing"
    :href="props.href"
    :class="classes.concat(variantClasses[props.variant])"
  >
    <span v-if="props.processingText && props.processing">
      {{ props.processingText }}
    </span>
    <slot v-else />
  </Link>
  <a
    v-else-if="props.href && props.external"
    :data-processing="props.processing"
    :href="props.href"
    :class="classes.concat(variantClasses[props.variant])"
  >
    <span v-if="props.processingText && props.processing">
      {{ props.processingText }}
    </span>
    <slot v-else />
  </a>
  <button
    v-else
    :data-processing="props.processing"
    :disabled="props.processing"
    :class="classes.concat(variantClasses[props.variant])"
  >
    <span v-if="props.processingText && props.processing">
      {{ props.processingText }}
    </span>
    <slot v-else />
  </button>
</template>
