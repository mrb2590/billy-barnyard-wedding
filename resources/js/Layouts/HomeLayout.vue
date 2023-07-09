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
  <div class="relative min-h-screen w-full h-full flex flex-col">
    <nav class="fixed top-0 left-0 w-full h-24 mb-6 z-40 flex flex-row items-center justify-center">
      <div ref="headerGradient" class="absolute w-full h-36 top-0 left-0">
        <div class="absolute w-full h-36 top-0 left-0 bg-gradient-to-b from-primary-950/80 z-30" />
        <div
          class="absolute w-full h-36 top-0 left-0 bg-gradient-to-b from-primary-950 blur-mask z-30"
        />
      </div>

      <ul class="container flex flex-row justify-center space-x-6 items-center relative z-40 p-6">
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

    <footer class="w-full h-16 z-40 absolute bottom-0 left-0 flex justify-center items-end">
      <div ref="footerGradient" class="absolute w-full h-16 top-0 left-0">
        <div
          class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-primary-950/80 z-30"
        />
        <div
          class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-primary-950 blur-mask-reverse z-30"
        />
      </div>

      <div ref="footerText" class="text-shadow-default text-center relative z-40 px-6 pt-6 pb-3">
        Created by the
        <ThemeLink href="https://mike.buonomo.net" target="_blank" external>Groom</ThemeLink>
        <ApplicationLogo class="w-3 h-3 inline-block mx-2 align-baseline" />
        <ThemeLink v-if="$page.props.auth.user" :href="route('dashboard')">Dashboard</ThemeLink>
        <ThemeLink v-else :href="route('login')">Login</ThemeLink>
      </div>
    </footer>
  </div>
</template>