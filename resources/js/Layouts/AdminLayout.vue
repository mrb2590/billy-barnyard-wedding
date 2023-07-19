<script setup>
  import {onMounted, ref} from 'vue';

  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import Dropdown from '@/Components/Dropdown.vue';
  import DropdownLink from '@/Components/DropdownLink.vue';
  import OurNames from '@/Components/OurNames.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';

  const showingNavigationDropdown = ref(false);

  const navLinks = ref([]);

  onMounted(() => {
    navLinks.value = [
      {
        title: 'Dashboard',
        href: route('admin.dashboard')
      },
      {
        title: 'Horizon',
        href: route('horizon.index')
      },
      {
        title: 'Guests',
        href: route('admin.guests.index')
      }
    ];
  });
</script>

<template>
  <div class="relative h-full min-h-screen w-full pt-16">
    <BackgroundImage image="flowers" start="top top" />

    <nav
      class="fixed left-0 top-0 z-40 h-16 w-full"
      :class="{'bg-primary-950': showingNavigationDropdown}"
    >
      <div class="absolute left-0 top-0 z-0 h-full w-full bg-gradient-to-b from-primary-950/80" />
      <div class="absolute left-0 top-0 z-0 h-full w-full bg-gradient-to-b from-primary-950" />
      <div class="absolute left-0 top-0 z-0 h-full w-full blur-mask" />

      <!-- Primary Navigation Menu -->
      <div class="container relative z-40 mx-auto px-6">
        <div class="flex h-16 justify-between">
          <div class="flex">
            <!-- Logo -->
            <div class="flex shrink-0 items-center">
              <ThemeButton :href="route('home')" variant="nav">
                <OurNames type="short" />
              </ThemeButton>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-2 sm:-my-px sm:flex sm:items-center">
              <ThemeButton
                v-for="(navLink, i) in navLinks"
                :key="i"
                variant="nav"
                :href="navLink.href"
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

          <div class="hidden sm:ml-6 sm:flex sm:items-center">
            <!-- Settings Dropdown -->
            <div class="relative ml-3">
              <Dropdown align="right" width="48">
                <template #trigger>
                  <span class="inline-flex rounded-md">
                    <ThemeButton variant="nav">
                      {{
                        $page.props.auth.user.name
                          .split(' ')
                          .map((name) => name.charAt(0))
                          .concat()
                          .join('')
                      }}

                      <svg
                        class="-mr-0.5 ml-2 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </ThemeButton>
                  </span>
                </template>

                <template #content>
                  <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                  <DropdownLink :href="route('logout')" method="post" as="button">
                    Log Out
                  </DropdownLink>
                </template>
              </Dropdown>
            </div>
          </div>

          <!-- Hamburger -->
          <div class="flex items-center sm:hidden">
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
        </div>
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
          class="absolute left-0 top-0 z-30 h-full min-h-screen w-full overflow-auto bg-primary-950 pb-16 pt-16 sm:hidden"
        >
          <div class="px-4 text-center">
            <div class="text-xl">
              {{ $page.props.auth.user.name }}
            </div>
            <div class="text-lg">{{ $page.props.auth.user.email }}</div>
          </div>
          <div class="flex flex-col space-y-4 pb-3 pt-2">
            <ThemeButton :href="route('home')" variant="nav">
              <OurNames type="short" />
            </ThemeButton>

            <ThemeButton
              v-for="(navLink, i) in navLinks"
              :key="i"
              variant="nav"
              :href="navLink.href"
              class="p-6 text-xl"
              @click="showingNavigationDropdown = false"
            >
              <component
                :is="navLink.component"
                v-if="navLink.component"
                v-bind="navLink.componentProps"
              />
              <span v-else>{{ navLink.title }}</span>
            </ThemeButton>

            <ThemeButton
              variant="nav"
              :href="route('profile.edit')"
              class="p-6 text-xl"
              @click="showingNavigationDropdown = false"
            >
              Profile
            </ThemeButton>

            <ThemeButton
              variant="nav"
              :href="route('logout')"
              class="p-6 text-xl"
              as="button"
              method="post"
              @click="showingNavigationDropdown = false"
            >
              Log Out
            </ThemeButton>
          </div>
        </div>
      </Transition>
    </nav>

    <!-- Page Content -->
    <main class="relative pb-16">
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

      <div
        ref="footerText"
        class="heading-text relative z-40 px-6 pb-3 pt-6 text-center normal-case text-shadow-default"
      >
        {{ $page.props.app_version }}
      </div>
    </footer>
  </div>
</template>
