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
  <div ref="card" class="rounded-sm bg-white p-2 text-primary-700" :class="{raised: props.raised}">
    <div class="h-full w-full rounded-sm border border-primary-700 p-6">
      <div v-if="props.logo" class="flex w-full flex-col items-center justify-center">
        <Link
          :href="route('home')"
          class="mb-6 flex flex-col items-center justify-center space-y-6"
        >
          <ApplicationLogo class="h-8 w-8" />
          <OurNames type="short" class="text-6xl" />
        </Link>
      </div>
      <slot />
    </div>
  </div>
</template>
