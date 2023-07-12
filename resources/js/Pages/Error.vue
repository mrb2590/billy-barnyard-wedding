<script setup>
  import {computed} from 'vue';

  import ApplicationLogo from '@/Components/ApplicationLogo.vue';
  import OurNames from '@/Components/OurNames.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';

  const props = defineProps({
    status: {
      type: Number,
      default: null
    }
  });

  const title = computed(() => {
    return (
      {
        401: 'Unauthorized',
        403: 'Forbidden',
        419: 'Page Expired',
        429: 'Too Many Requests',
        404: 'Page Not Found',
        500: 'Server Error',
        503: 'Service Unavailable'
      }[props.status] ?? props.status
    );
  });

  const description = computed(() => {
    return (
      {
        401: 'Sorry, you are unauthorized from accessing this page. Only Bills shall pass.',
        403: 'Sorry, you are forbidden from accessing this page. Only Bills shall pass.',
        419: 'The page has expired. Please try again.',
        429: 'Slow down there Bill! Wait a minute and try again.',
        404: 'Sorry, the page you are looking for could not be found. It may be on the other side of the barnyard.',
        500: 'Whoops, something went wrong on our servers. Hopefully the wedding goes better than this.',
        503: 'Sorry, the barn is closed for maintenance. Please check back soon.'
      }[props.status] ?? 'An error occurred'
    );
  });
</script>

<template>
  <Transition
    enter-active-class="transition ease-out duration-1000"
    enter-from-class="transform scale-95 opacity-0"
    enter-to-class="transform scale-100 opacity-100"
    leave-active-class="transition ease-in duration-1000"
    leave-from-class="transform scale-100 opacity-100"
    leave-to-class="transform scale-95 opacity-0"
    appear
    mode="out-in"
  >
    <div class="flex h-screen w-full flex-col items-center justify-center p-6">
      <ApplicationLogo class="mb-4 h-8 w-8" />
      <OurNames type="short" class="mb-6 text-6xl" />
      <h1 class="mb-4 text-2xl">{{ props.status }} {{ title }}</h1>
      <div class="mb-8 max-w-lg text-center">
        {{ description }}
      </div>
      <ThemeButton :href="route('home')" class="relative z-20">Home</ThemeButton>
    </div>
  </Transition>
</template>
