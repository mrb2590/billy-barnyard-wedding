<script setup>
  import {inject, nextTick, onMounted, ref} from 'vue';

  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import OurNames from '@/Components/OurNames.vue';
  import HomeLayout from '@/Layouts/HomeLayout.vue';
  import PageSection from '@/Pages/Home/Partials/PageSection.vue';

  defineOptions({
    layout: HomeLayout
  });

  const gsap = inject('gsap');
  const background = ref();
  const ourNames = ref();
  const ourNamesMouseAnimationEnabled = ref(false);
  const animate = () => {
    gsap.from(background.value.wrapper, {scale: 1.2, duration: 3});
    gsap.from(ourNames.value.wrapper, {
      scale: 0,
      opacity: 0,
      duration: 3,
      ease: 'back.out'
    });
    setTimeout(() => {
      ourNamesMouseAnimationEnabled.value = true;
    }, 3000);
  };

  onMounted(() => {
    nextTick(animate);
  });
</script>

<template>
  <PageSection id="alexAndMike" class="flex items-start justify-center md:items-center">
    <BackgroundImage
      ref="background"
      image="alex-mike-engagement"
      bg-size="bg-[21%_30%]"
      start="top top"
      animate
    />

    <h1 class="text-shadow-default text-9xl md:text-6xl mt-36 md:mt-0">
      <OurNames ref="ourNames" type="both" :animate="ourNamesMouseAnimationEnabled" />
    </h1>
  </PageSection>
</template>
