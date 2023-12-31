<script setup>
  import {inject, onMounted, ref} from 'vue';

  import FancyCard from '@/Components/FancyCard.vue';
  import PageHeading from '@/Components/PageHeading.vue';
  import PageSection from '@/Components/PageSection.vue';
  import {getOurStoryEvents} from '@/Data/our-story-events';

  import BoardPhoto from './BoardPhoto.vue';
  import WoodBoard from './WoodBoard.vue';

  const gsap = inject('gsap');
  const section = ref();
  const heading = ref();
  const boardsContainer = ref();
  const storyContainer = ref();
  const events = getOurStoryEvents();

  const initAnimations = () => {
    gsap.to(boardsContainer.value, {
      scrollTrigger: {
        trigger: section.value.section,
        start: 'top top',
        end: 'bottom center',
        pin: boardsContainer.value
      }
    });

    gsap.from(heading.value.heading, {
      scrollTrigger: {
        trigger: storyContainer.value,
        scrub: 1,
        start: 'top bottom',
        end: 'top top'
      },
      scale: 0,
      opacity: 0
    });
  };

  onMounted(() => {
    initAnimations();
  });
</script>

<template>
  <PageSection ref="section">
    <div ref="boardsContainer" class="absolute left-0 top-0 z-0 mt-16 h-full w-full">
      <div class="flex flex-col flex-nowrap items-center justify-between space-y-6 overflow-hidden">
        <WoodBoard
          v-for="i in 4"
          :key="i"
          :image="`wood-board-${i - 1}`"
          :animate-dir="i % 2 ? 'left' : 'right'"
          :scroll-trigger="() => section.section"
          :scrub="3"
        >
          <BoardPhoto
            v-for="j in 10"
            :key="j"
            :image="`tiles-${j - 1 + 10 * (i - 1)}`"
            :rotation="(j + i) % 2 ? 2 : -2"
            :translation="j % 2 ? 10 : -10"
          />
        </WoodBoard>
      </div>
    </div>

    <div
      id="ourStory"
      ref="storyContainer"
      class="relative z-20 mt-[calc(100vh_-_9rem)] flex w-full flex-col items-center justify-center pt-20 text-center sm:pt-36"
    >
      <PageHeading ref="heading">
        <h2>Our Story</h2>
      </PageHeading>

      <div v-for="(event, i) in events" :key="i" class="mb-16 w-full max-w-xl">
        <FancyCard raised :title="event.year">
          <div class="flex grow flex-col items-center justify-center text-lg">
            <h3 class="mb-6 text-xl md:text-2xl">
              <span class="heading-text mb-4 block text-xl md:text-xl">{{ event.year }}</span>
              {{ event.title }}
            </h3>
            <p v-if="event.description">
              {{ event.description }}
            </p>
          </div>
        </FancyCard>
      </div>
    </div>
  </PageSection>
</template>
