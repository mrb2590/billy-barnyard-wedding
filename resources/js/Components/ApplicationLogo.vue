<script setup>
  import {getStaticAsset} from '@/Library/static-asset';

  const appName = import.meta.env.VITE_APP_NAME;
</script>

<template>
  <img :src="getStaticAsset('logo.svg')" :alt="appName" />
</template>
