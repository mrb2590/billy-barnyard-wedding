<script setup>
  import {inject, onMounted, ref} from 'vue';

  import FancyCard from '@/Components/FancyCard.vue';
  import PageHeading from '@/Components/PageHeading.vue';
  import PageSection from '@/Components/PageSection.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';

  const gsap = inject('gsap');

  const section = ref();
  const heading = ref();
  const partyCard = ref();
  const accomCard = ref();

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

    gsap.from(partyCard.value.card, {
      scrollTrigger: {
        trigger: partyCard.value.card,
        scrub: 1,
        end: 'top center'
      },
      xPercent: -100
    });

    gsap.from(accomCard.value.card, {
      scrollTrigger: {
        trigger: partyCard.value.card,
        scrub: 1,
        end: 'top center'
      },
      xPercent: 100
    });

    gsap.fromTo(
      partyCard.value.card,
      {
        scrollTrigger: {
          trigger: partyCard.value.card,
          scrub: 1,
          start: '90% center'
        },
        xPercent: 0
      },
      {
        scrollTrigger: {
          trigger: partyCard.value.card,
          scrub: 1,
          start: '90% center'
        },
        x: '-30vw',
        rotate: '-90deg',
        transformOrigin: 'bottom left'
      }
    );

    gsap.fromTo(
      accomCard.value.card,
      {
        scrollTrigger: {
          trigger: accomCard.value.card,
          scrub: 1,
          start: '90% center'
        },
        xPercent: 0
      },
      {
        scrollTrigger: {
          trigger: accomCard.value.card,
          scrub: 1,
          start: '90% center'
        },
        x: '30vw',
        rotate: '90deg',
        transformOrigin: 'bottom right'
      }
    );
  };

  onMounted(() => {
    initAnimations();
  });
</script>

<template>
  <PageSection
    id="whenAndWhere"
    ref="section"
    has-header
    class="flex flex-col items-center justify-center"
  >
    <div class="flex w-full grow flex-col items-center justify-center">
      <PageHeading ref="heading">
        <h2>When &amp; Where</h2>
      </PageHeading>

      <div
        class="container flex flex-col items-center justify-center space-y-6 md:flex-row md:items-stretch md:space-x-6 md:space-y-0 lg:space-x-14"
      >
        <FancyCard ref="partyCard" raised class="w-full max-w-sm">
          <div class="flex h-full flex-col items-center justify-between text-lg">
            <h3 class="mb-6 text-xl md:text-2xl">Reception</h3>

            <div class="text-center">
              <p class="mb-6">
                165 Harvard Avenue <br />
                Rockville Centre <br />
                New York
              </p>
              <p class="mb-6">
                September 16, 2023 <br />
                2:00PM
              </p>
              <p class="mb-6">
                Cocktail attire, <br />
                blue encouraged
              </p>
            </div>

            <ThemeButton
              variant="secondary"
              href="https://goo.gl/maps/VKh7dQUHpm4c1h1D7"
              target="_blank"
              external
            >
              Directions
            </ThemeButton>
          </div>
        </FancyCard>

        <FancyCard ref="accomCard" raised class="w-full max-w-sm">
          <div class="flex h-full flex-col items-center justify-between text-lg">
            <h3 class="mb-6 text-xl md:text-2xl">Accommodations</h3>

            <div class="text-center">
              <p class="mb-6">
                Hampton Inn & <br class="" />
                Suites Rockville Centre
              </p>
              <p class="mb-6">
                125 Merrick Road <br />
                Rockville Centre <br />
                New York
              </p>
            </div>

            <ThemeButton
              variant="secondary"
              href="https://www.hilton.com/en/book/reservation/deeplink/?ctyhocn=RVCNYHX&groupCode=CHHZBW&arrivaldate=2023-09-13&departuredate=2023-09-19&cid=OM,WW,HILTONLINK,EN,DirectLink&fromId=HILTONLINKDIRECT"
              target="_blank"
              external
            >
              Book
            </ThemeButton>
          </div>
        </FancyCard>
      </div>
    </div>
  </PageSection>
</template>
