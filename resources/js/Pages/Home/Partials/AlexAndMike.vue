<script setup>
  import {inject, onMounted, ref} from 'vue';

  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import OurNames from '@/Components/OurNames.vue';
  import PageSection from '@/Components/PageSection.vue';
  import HomeLayout from '@/Layouts/HomeLayout.vue';

  defineOptions({
    layout: HomeLayout
  });

  const gsap = inject('gsap');
  const background = ref();
  const ourNames = ref();
  const ourNamesMouseAnimationEnabled = ref(false);

  const initAnimations = () => {
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

  onMounted(initAnimations);
</script>

<template>
  <PageSection id="alexAndMike" class="flex items-start justify-center md:items-center">
    <BackgroundImage
      ref="background"
      image="alex-mike-engagement"
      bg-position="bg-[21%_30%]"
      start="top top"
      animate
    />

    <h1 class="mt-36 text-9xl text-shadow-default md:mt-0 md:text-6xl">
      <OurNames
        ref="ourNames"
        type="both"
        :animate="ourNamesMouseAnimationEnabled"
        animation-container-id="alexAndMike"
      />
    </h1>

    <h2
      class="body-text absolute bottom-0 flex items-center justify-center p-6 text-center text-xl text-shadow-default"
    >
      Alexandra Zephirin <br class="sm:hidden" />
      &amp; <br class="sm:hidden" />
      Michael Buonomo <br class="sm:hidden" />
      are getting married!
    </h2>
  </PageSection>
</template>
