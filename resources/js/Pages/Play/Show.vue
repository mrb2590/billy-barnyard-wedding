<script setup>
  import {Head} from '@inertiajs/vue3';
  import {inject, onMounted, ref} from 'vue';

  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import PageHeading from '@/Components/PageHeading.vue';
  import PageSection from '@/Components/PageSection.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import ThemeLink from '@/Components/ThemeLink.vue';
  import HomeLayout from '@/Layouts/HomeLayout.vue';

  defineOptions({layout: HomeLayout});

  const gsap = inject('gsap');
  const section = ref();
  const heading = ref();
  const showGame = ref(false);

  onMounted(() => {
    gsap.from(heading.value.heading, {
      opacity: 0,
      yPercent: -300
    });
  });
</script>

<template>
  <PageSection ref="section" class="flex flex-col justify-center items-center">
    <Head title="Play">
      <meta
        head-key="description"
        name="description"
        content="While we wait for our wedding day to come, enjoy a game where Alex tries to backflip her way through our marriage!"
      />
    </Head>

    <BackgroundImage image="flowers" />

    <div class="relative w-full flex flex-col flex-center items-center">
      <PageHeading ref="heading">
        <h1>Flippy Bill</h1>
      </PageHeading>

      <Transition
        enter-active-class="transition ease-out duration-500"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-in duration-500"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
        appear
        mode="out-in"
      >
        <FancyCard v-if="!showGame" class="mb-8 max-w-lg mx-auto text-center">
          <p class="mb-6 text-xl">
            While we wait for our wedding day to come, enjoy a game where Alex tries to backflip her
            way through our marriage!
          </p>
          <h2 class="mb-6 text-xl md:text-2xl">How to Play</h2>
          <p class="mb-6">
            This is a take on Flappy Bird. Once the game starts, Bill will start falling so you must
            tap, click, or use the space key to keep Bill in the air. As the pipes approach Bill,
            you must fly Bill through the openings. Good luck, you will need it. You can always play
            the game at the standalone site,
            <ThemeLink href="https://flippy-bill.buonomo.net" external>
              https://flippy-bill.buonomo.net</ThemeLink
            >.
          </p>
          <ThemeButton variant="secondary" @click="showGame = !showGame">Play</ThemeButton>
        </FancyCard>

        <div v-else class="mb-8 w-full h-full aspect-[16/9] max-w-6xl">
          <iframe
            class="w-full h-full relative raised"
            src="https://flippy-bill.buonomo.net"
            frameborder="0"
            scrolling="no"
          />
        </div>
      </Transition>
    </div>
  </PageSection>
</template>
