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
    <div ref="boardsContainer" class="absolute top-0 left-0 h-full w-full mt-16 z-0">
      <div class="flex justify-between space-y-6 flex-col items-center flex-nowrap overflow-hidden">
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
      class="w-full flex justify-center items-center text-center z-20 flex-col relative mt-[calc(100vh_-_9rem)] pt-36"
    >
      <PageHeading ref="heading">
        <h2>Our Story</h2>
      </PageHeading>

      <div v-for="(event, i) in events" :key="i" class="mb-16 w-full max-w-xl">
        <FancyCard raised :title="event.year">
          <div class="grow flex flex-col justify-center items-center text-lg">
            <h3 class="mb-6 text-xl md:text-2xl">{{ event.title }}</h3>
            <p v-if="event.description">
              {{ event.description }}
            </p>
          </div>
        </FancyCard>
      </div>
    </div>
  </PageSection>
</template>
