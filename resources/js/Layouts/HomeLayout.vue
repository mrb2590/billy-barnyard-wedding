<script setup>
  import {router} from '@inertiajs/vue3';
  import {inject, markRaw, nextTick, onMounted, ref, watch} from 'vue';

  import ApplicationLogo from '@/Components/ApplicationLogo.vue';
  import OurNames from '@/Components/OurNames.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import ThemeLink from '@/Components/ThemeLink.vue';

  const gsap = inject('gsap');
  const navLinks = ref([]);
  const headerGradient = ref([]);
  const footerGradient = ref([]);
  const links = ref();
  const footerText = ref();
  const showingNavigationDropdown = ref(false);

  const initAnimations = () => {
    gsap.from(links.value, {opacity: 0, duration: 1, stagger: 0.35, delay: 1});
    gsap.from(headerGradient.value, {opacity: 0, duration: 3, delay: 1});
    gsap.from(footerGradient.value, {opacity: 0, duration: 3, delay: 1});
    gsap.from(footerText.value, {opacity: 0, duration: 1, delay: 1});
  };

  const animateScroll = (id) => {
    gsap.to(window, {
      duration: 2,
      scrollTo: {y: id, autoKill: true},
      ease: 'sine.inOut'
    });
  };

  const scrollToSection = (id) => {
    if (!route().current('home')) {
      router.visit(route('home'), {
        onSuccess: () => setTimeout(() => animateScroll(id), 1000)
      });
    } else {
      animateScroll(id);
    }
  };

  const onNavLinkClick = (sectionId = null) => {
    showingNavigationDropdown.value = false;

    if (sectionId) {
      scrollToSection(`#${sectionId}`);
    }
  };

  watch(showingNavigationDropdown, () => {
    if (showingNavigationDropdown.value) {
      document.body.classList.add('overflow-hidden');
    } else {
      document.body.classList.remove('overflow-hidden');
    }
  });

  onMounted(() => {
    navLinks.value = [
      {
        id: 'alexAndMike',
        component: markRaw(OurNames),
        componentProps: {
          type: 'short'
        }
      },
      {
        id: 'whenAndWhere',
        title: 'When & Where'
      },
      {
        id: 'ourStory',
        title: 'Our Story'
      },
      {
        id: 'registry',
        title: 'Registry'
      },
      {
        title: 'RSVP',
        href: route('party-search.create')
      },
      {
        title: 'Play',
        href: route('play')
      }
    ];

    nextTick(() => {
      initAnimations();
    });
  });
</script>

<template>
  <div class="relative flex h-full min-h-screen w-full flex-col">
    <nav
      class="fixed left-0 top-0 z-40 mb-6 flex h-16 w-full flex-row items-center justify-center sm:h-24"
    >
      <div ref="headerGradient" class="absolute left-0 top-0 h-36 w-full">
        <div
          class="absolute left-0 top-0 z-30 h-24 w-full bg-gradient-to-b from-primary-950/80 sm:h-36"
        />
        <div
          class="absolute left-0 top-0 z-30 h-24 w-full bg-gradient-to-b from-primary-950 blur-mask sm:h-36"
        />
      </div>

      <ul
        class="container relative z-40 hidden flex-row items-center justify-center space-x-3 p-6 sm:flex md:space-x-6"
      >
        <li v-for="(navLink, i) in navLinks" :key="i" ref="links">
          <ThemeButton
            variant="nav"
            :href="navLink.href"
            class="text-base md:text-lg lg:text-xl"
            @click.prevent="onNavLinkClick(navLink.id)"
          >
            <component
              :is="navLink.component"
              v-if="navLink.component"
              v-bind="navLink.componentProps"
            />
            <span v-else>{{ navLink.title }}</span>
          </ThemeButton>
        </li>
      </ul>

      <div
        class="relative z-40 flex w-full items-center justify-between p-2 text-2xl sm:hidden"
        :class="{'absolute left-0 top-0 z-50': showingNavigationDropdown}"
      >
        <ThemeButton variant="nav" @click.prevent="scrollToSection(`#alexAndMike`)">
          <ApplicationLogo class="mr-4 h-5" />
        </ThemeButton>
        <ThemeButton
          variant="nav"
          type="button"
          @click.prevent="showingNavigationDropdown = !showingNavigationDropdown"
        >
          <Transition
            enter-active-class="transition ease-out duration-300"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition ease-in duration-300"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
            mode="out-in"
          >
            <svg
              v-if="!showingNavigationDropdown"
              class="h-8 w-8"
              stroke="currentColor"
              fill="none"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>
            <svg v-else class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </Transition>
        </ThemeButton>
      </div>

      <!-- Responsive Navigation Menu -->
      <Transition
        enter-active-class="transition ease-out duration-500"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-in duration-500"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
        appear
      >
        <div
          v-show="showingNavigationDropdown"
          class="absolute left-0 top-0 z-40 h-full min-h-screen w-full overflow-auto bg-primary-950 pb-16 pt-16 sm:hidden"
        >
          <div class="flex flex-col space-y-4 pb-3 pt-2">
            <ThemeButton
              v-for="(navLink, i) in navLinks"
              :key="i"
              variant="nav"
              :href="navLink.href"
              class="p-6 text-xl"
              @click.prevent="onNavLinkClick(navLink.id)"
            >
              <component
                :is="navLink.component"
                v-if="navLink.component"
                v-bind="navLink.componentProps"
              />
              <span v-else>{{ navLink.title }}</span>
            </ThemeButton>
          </div>
        </div>
      </Transition>
    </nav>

    <main class="grow">
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
        <slot />
      </Transition>
    </main>

    <footer
      class="absolute bottom-0 left-0 z-40 flex h-16 w-full items-end justify-center"
      :class="{'!fixed': showingNavigationDropdown}"
    >
      <div ref="footerGradient" class="absolute left-0 top-0 h-16 w-full">
        <div
          class="absolute left-0 top-0 z-30 h-full w-full bg-gradient-to-t from-primary-950/80"
        />
        <div
          class="absolute left-0 top-0 z-30 h-full w-full bg-gradient-to-t from-primary-950 blur-mask-reverse"
        />
      </div>

      <div ref="footerText" class="relative z-40 px-6 pb-3 pt-6 text-center text-shadow-default">
        Created by the
        <ThemeLink href="https://mike.buonomo.net" target="_blank" external>Groom</ThemeLink>
        <ApplicationLogo class="mx-2 inline-block h-3 w-3 align-baseline" />
        <ThemeLink
          v-if="$page.props.auth.user"
          :href="route('admin.dashboard')"
          @click="showingNavigationDropdown = false"
          >Dashboard</ThemeLink
        >
        <ThemeLink v-else :href="route('login')" @click="showingNavigationDropdown = false"
          >Login</ThemeLink
        >
      </div>
    </footer>
  </div>
</template>
