<script setup>
  import {router} from '@inertiajs/vue3';
  import {inject, markRaw, nextTick, onMounted, ref} from 'vue';

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
    <nav class="fixed left-0 top-0 z-40 mb-6 flex h-24 w-full flex-row items-center justify-center">
      <div ref="headerGradient" class="absolute left-0 top-0 h-36 w-full">
        <div class="absolute left-0 top-0 z-30 h-36 w-full bg-gradient-to-b from-primary-950/80" />
        <div
          class="absolute left-0 top-0 z-30 h-36 w-full bg-gradient-to-b from-primary-950 blur-mask"
        />
      </div>

      <ul class="container relative z-40 flex flex-row items-center justify-center space-x-6 p-6">
        <li v-for="(navLink, i) in navLinks" :key="i" ref="links">
          <ThemeButton
            variant="nav"
            :href="navLink.href"
            class="text-3xl"
            @click.prevent="!navLink.href ? scrollToSection(`#${navLink.id}`) : () => {}"
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

    <footer class="absolute bottom-0 left-0 z-40 flex h-16 w-full items-end justify-center">
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
        <ThemeLink v-if="$page.props.auth.user" :href="route('dashboard')">Dashboard</ThemeLink>
        <ThemeLink v-else :href="route('login')">Login</ThemeLink>
      </div>
    </footer>
  </div>
</template>
