<script setup>
  import {Head} from '@inertiajs/vue3';

  import {getStaticAsset} from '@/Library/static-asset';

  const props = defineProps({
    title: {
      type: String,
      default: null
    },
    description: {
      type: String,
      default:
        'Alexandra Zephirin and Michael Buonomo are getting married! Read our story, see our timeline, and RSVP to our wedding!'
    },
    image: {
      type: String,
      default: getStaticAsset('alex-mike-engagement-og-default.jpg')
    }
  });

  const appName = import.meta.env.VITE_APP_NAME ?? 'Billy Barnyard Wedding';
  const pageTitle = props.title ? `${props.title} - ${appName}` : appName;
</script>

<template>
  <Head :title="props.title">
    <meta head-key="description" name="description" :content="props.description" />

    <!-- Twitter card -->
    <meta head-key="twitter:card" name="twitter:card" content="summary_large_image" />
    <meta head-key="twitter:title" name="twitter:title" :content="pageTitle" />
    <meta head-key="twitter:description" name="twitter:description" :content="props.description" />
    <meta head-key="twitter:image" name="twitter:image" :content="props.image" />

    <!-- Open graph -->
    <meta head-key="og:type" property="og:type" content="article" />
    <meta head-key="og:title" property="og:title" :content="pageTitle" />
    <meta head-key="og:description" property="og:description" :content="props.description" />
    <meta head-key="og:url" property="og:url" :content="`${route().t.url}${$page.url}`" />
    <meta head-key="og:image" property="og:image" :content="props.image" />

    <slot />
  </Head>
</template>
