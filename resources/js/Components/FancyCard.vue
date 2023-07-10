<script setup>
  import {Link} from '@inertiajs/vue3';
  import {inject, onMounted, ref} from 'vue';

  import ApplicationLogo from './ApplicationLogo.vue';
  import OurNames from './OurNames.vue';

  const props = defineProps({
    raised: {
      type: Boolean,
      default: false
    },
    animate: {
      type: Boolean,
      default: false
    },
    logo: {
      type: Boolean,
      default: false
    }
  });

  const gsap = inject('gsap');
  const card = ref();

  const initAnimations = () => {
    if (!props.animate) {
      return;
    }

    gsap.from(card.value, {
      y: 100,
      ease: 'circ.out'
    });
  };

  onMounted(initAnimations);
  defineExpose({card});
</script>

<template>
  <div ref="card" class="bg-white text-primary-700 p-2 rounded-sm" :class="{raised: props.raised}">
    <div class="h-full w-full border border-primary-700 p-6 rounded-sm">
      <div v-if="props.logo" class="w-full flex flex-col justify-center items-center">
        <Link
          :href="route('home')"
          class="flex flex-col justify-center items-center mb-6 space-y-6"
        >
          <ApplicationLogo class="w-8 h-8" />
          <OurNames type="short" class="text-6xl" />
        </Link>
      </div>
      <slot />
    </div>
  </div>
</template>
