<script setup>
  import {inject, markRaw, nextTick, onMounted, ref} from 'vue';

  import ApplicationLogo from '@/Components/ApplicationLogo.vue';
  import OurNames from '@/Components/OurNames.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';
  import ThemeLink from '@/Components/ThemeLink.vue';

  const gsap = inject('gsap');
  const navLinks = ref([]);
  const navBackground = ref();
  const links = ref();
  const footerText = ref();

  const animate = () => {
    gsap.set(links.value, {opacity: 0});
    gsap.set(navBackground.value, {opacity: 0});
    gsap.to(links.value, {opacity: 1, duration: 1, stagger: 0.35, delay: 1});
    gsap.to(navBackground.value, {opacity: 1, duration: 3});
    gsap.from(footerText.value, {y: '4rem', opacity: 0, duration: 3});
  };

  onMounted(() => {
    navLinks.value = [
      {
        href: route('home'),
        component: markRaw(OurNames),
        componentProps: {
          type: 'short'
        }
      }
    ];

    nextTick(() => {
      animate();
    });
  });
</script>

<template>
  <div class="relative min-h-screen w-full h-full flex flex-col">
    <nav class="fixed top-0 left-0 w-full h-24 mb-6 z-20 flex flex-row items-center justify-center">
      <div
        ref="navBackground"
        class="absolute w-full h-36 top-0 left-0 bg-gradient-to-b from-primary-950/80 z-10"
      />
      <div
        ref="navBackground"
        class="absolute w-full h-36 top-0 left-0 bg-gradient-to-b from-primary-950 blur-mask z-10"
      />

      <ul class="container flex flex-row justify-center space-x-6 items-center relative z-20 p-6">
        <li v-for="(navLink, i) in navLinks" :key="i" ref="links">
          <ThemeButton variant="nav" :href="navLink.href" class="text-3xl">
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
      <main class="grow">
        <slot />
      </main>
    </Transition>

    <footer class="w-full h-16 z-20 absolute bottom-0 left-0 flex justify-center items-center">
      <div
        ref="navBackground"
        class="absolute w-full h-16 top-0 left-0 bg-gradient-to-t from-primary-950/80 z-10"
      />
      <div
        ref="navBackground"
        class="absolute w-full h-16 top-0 left-0 bg-gradient-to-t from-primary-950 blur-mask-reverse z-10"
      />

      <div ref="footerText" class="text-shadow-default text-center relative z-20 p-6">
        Created by the
        <ThemeLink href="https://mike.buonomo.net" target="_blank" external>Groom</ThemeLink>
        <ApplicationLogo class="w-3 h-3 inline-block mx-2 align-baseline" />
        <ThemeLink v-if="$page.props.auth.user" :href="route('dashboard')">Dashboard</ThemeLink>
        <ThemeLink v-else :href="route('login')">Login</ThemeLink>
      </div>
    </footer>
  </div>
</template>
