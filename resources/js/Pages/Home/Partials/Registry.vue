<script setup>
  import {intervalToDuration} from 'date-fns';
  import {inject, onMounted, ref} from 'vue';

  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import FancyCard from '@/Components/FancyCard.vue';
  import ImageObject from '@/Components/ImageObject.vue';
  import PageHeading from '@/Components/PageHeading.vue';
  import PageSection from '@/Components/PageSection.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';

  const gsap = inject('gsap');
  const section = ref();
  const heading = ref();
  const registryCard = ref();
  const countdownText = ref();
  const countdownNumber = ref();
  const weddingDate = new Date(2023, 8, 16, 14, 0, 0);

  const getCurrentCountdownDuration = () =>
    intervalToDuration({
      start: weddingDate,
      end: new Date()
    });

  const countdownDuration = ref(getCurrentCountdownDuration());

  const initAnimations = () => {
    gsap.from(heading.value.heading, {
      scrollTrigger: {
        trigger: section.value.section,
        scrub: 1,
        end: 'top top'
      },
      opacity: 0,
      yPercent: -300
    });

    gsap.from(registryCard.value.card, {
      scrollTrigger: {
        trigger: section.value.section
      },
      scale: 0.5,
      opacity: 0
    });

    gsap.from(countdownText.value, {
      scrollTrigger: {
        trigger: section.value.section
      },
      ease: 'back.out',
      scale: 0,
      y: 100,
      delay: 1,
      duration: 2
    });

    gsap.from(countdownNumber.value, {
      scrollTrigger: {
        trigger: section.value.section
      },
      ease: 'bounce.out',
      y: -400,
      duration: 1,
      delay: 0.5,
      stagger: 0.15,
      opacity: 0
    });
  };

  onMounted(() => {
    initAnimations();

    setInterval(() => {
      countdownDuration.value = getCurrentCountdownDuration();
    }, 1000);
  });
</script>

<template>
  <PageSection
    id="registry"
    ref="section"
    has-header
    has-footer
    class="flex flex-col justify-center items-center"
  >
    <BackgroundImage image="she-said-yes" end="bottom bottom" bg-size="bg-[10%_30%]" animate />

    <div class="flex flex-col justify-center items-center">
      <PageHeading ref="heading">
        <h2>Registry</h2>
      </PageHeading>

      <FancyCard ref="registryCard" raised class="w-full max-w-md mb-6">
        <div class="h-full flex flex-col justify-between items-center">
          <div class="text-center">
            <p class="mb-6">
              We are lucky to have what we need and more, however if you'd like to give us a gift,
              please consider contributing to our kitchen remodel fund. We are very thankful for
              anything.
            </p>
            <p class="mb-6">
              For convenience, you may scan the QR Code or click the button below to see our Venmo
              account.
            </p>
          </div>

          <ImageObject image="venmo_qrcode" class="mb-6" />

          <ThemeButton
            variant="secondary"
            href="https://venmo.com/u/Mike-Buonomo-1"
            target="_blank"
            external
          >
            Venmo
          </ThemeButton>
        </div>
      </FancyCard>

      <div class="flex flex-wrap justify-center items-center mb-6">
        <div
          v-for="(value, field) in countdownDuration"
          v-show="countdownDuration[field] || field === 'seconds'"
          :key="field"
          ref="countdownNumber"
          class="flex justify-center items-center flex-col p-3"
        >
          <div class="heading-text text-2xl">{{ value }}</div>
          <div class="text-lg">{{ field }}</div>
        </div>
      </div>

      <div ref="countdownText" class="text-2xl">
        <div v-if="new Date().getTime() > weddingDate">since we got married!</div>
        <div v-if="new Date().getTime() <= weddingDate">until we get married!</div>
      </div>
    </div>
  </PageSection>
</template>
