<script setup>
  import {ref} from 'vue';

  import AppHead from '@/Components/AppHead.vue';
  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import PageHeading from '@/Components/PageHeading.vue';
  import PageSection from '@/Components/PageSection.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import ThemeLink from '@/Components/ThemeLink.vue';
  import HomeLayout from '@/Layouts/HomeLayout.vue';

  defineOptions({layout: HomeLayout});

  const section = ref();
  const showGame = ref(false);
</script>

<template>
  <PageSection
    ref="section"
    has-header
    has-footer
    class="flex flex-col items-center justify-center"
  >
    <AppHead
      title="Play"
      description="While we wait for our wedding day to come, enjoy a game where Alex tries to backflip her way through our marriage!"
    />

    <BackgroundImage image="flowers" />

    <div class="flex-center relative flex w-full flex-col items-center">
      <PageHeading animate>
        <h1>Flippy Bill</h1>
      </PageHeading>

      <Transition
        enter-active-class="transition ease-out duration-500"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-in duration-500"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
        mode="out-in"
      >
        <FancyCard v-if="!showGame" animate raised logo class="mx-auto mb-8 max-w-md text-center">
          <p class="mb-6">
            While we wait for our wedding day to come, enjoy a game where Alex tries to backflip her
            way through our marriage!
          </p>
          <h2 class="mb-6 text-xl md:text-2xl">How to Play</h2>
          <p class="mb-6">
            This is a take on Flappy Bird. Once the game starts, Flippy Bill will start falling so
            you must tap, click, or use the space key to keep her in the air. As the pipes approach
            Flippy Bill, you must fly her through the openings. Good luck, you will need it. You can
            always play the game at the standalone site,
            <ThemeLink href="https://flippy-bill.buonomo.net" external>
              https://flippy-bill.buonomo.net</ThemeLink
            >.
          </p>
          <ThemeButton variant="secondary" @click="showGame = !showGame">Play</ThemeButton>
        </FancyCard>

        <div v-else class="mb-8 aspect-[16/9] h-full w-full max-w-6xl">
          <iframe
            class="relative h-full w-full raised"
            src="https://flippy-bill.buonomo.net"
            frameborder="0"
            scrolling="no"
          />
        </div>
      </Transition>
    </div>
  </PageSection>
</template>
