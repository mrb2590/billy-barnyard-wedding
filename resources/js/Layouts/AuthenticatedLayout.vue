<script setup>
  import {ref} from 'vue';

  import BackgroundImage from '@/Components/BackgroundImage.vue';
  import Dropdown from '@/Components/Dropdown.vue';
  import DropdownLink from '@/Components/DropdownLink.vue';
  import OurNames from '@/Components/OurNames.vue';
  import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';

  const showingNavigationDropdown = ref(false);
</script>

<template>
  <div class="relative h-full min-h-screen w-full pt-16">
    <BackgroundImage image="flowers" start="top top" />

    <nav
      class="fixed left-0 top-0 z-20 h-16 w-full"
      :class="{'bg-primary-950': showingNavigationDropdown}"
    >
      <div class="absolute left-0 top-0 z-0 h-full w-full bg-gradient-to-b from-primary-950/80" />
      <div class="absolute left-0 top-0 z-0 h-full w-full bg-gradient-to-b from-primary-950" />
      <div class="absolute left-0 top-0 z-0 h-full w-full blur-mask" />

      <!-- Primary Navigation Menu -->
      <div class="container relative mx-auto px-6">
        <div class="flex h-16 justify-between">
          <div class="flex">
            <!-- Logo -->
            <div class="flex shrink-0 items-center">
              <ThemeButton :href="route('home')" variant="nav">
                <OurNames type="short" />
              </ThemeButton>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex sm:items-center">
              <ThemeButton
                :href="route('dashboard')"
                :active="route().current('dashboard')"
                variant="nav"
              >
                Dashboard
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
                      {{ $page.props.auth.user.name }}

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
              variant="primary"
              @click="showingNavigationDropdown = !showingNavigationDropdown"
            >
              <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path
                  :class="{
                    hidden: showingNavigationDropdown,
                    'inline-flex': !showingNavigationDropdown
                  }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                  :class="{
                    hidden: !showingNavigationDropdown,
                    'inline-flex': showingNavigationDropdown
                  }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </ThemeButton>
          </div>
        </div>
      </div>

      <!-- Responsive Navigation Menu -->
      <Transition
        enter-active-class="transition ease-out duration-500"
        enter-from-class="opacity-0 scale-95"
        enter-to-class="opacity-100 scale-100"
        leave-active-class="transition ease-in duration-500"
        leave-from-class="opacity-100 scale-100"
        leave-to-class="opacity-0 scale-95"
        appear
      >
        <div
          v-show="showingNavigationDropdown"
          class="left-0 top-16 z-40 h-[calc(100vh_-_4rem)] w-full bg-white sm:hidden"
        >
          <div class="space-y-1 pb-3 pt-2">
            <ResponsiveNavLink
              :href="route('dashboard')"
              :active="route().current('dashboard')"
              @click="showingNavigationDropdown = !showingNavigationDropdown"
            >
              Dashboard
            </ResponsiveNavLink>
          </div>

          <!-- Responsive Settings Options -->
          <div class="border-t border-primary-700 pb-1 pt-4 text-primary-700">
            <div class="px-4">
              <div class="text-xl">
                {{ $page.props.auth.user.name }}
              </div>
              <div class="text-lg">{{ $page.props.auth.user.email }}</div>
            </div>

            <div class="mt-3 space-y-1">
              <ResponsiveNavLink
                :href="route('profile.edit')"
                @click="showingNavigationDropdown = !showingNavigationDropdown"
              >
                Profile
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('logout')"
                method="post"
                as="button"
                @click="showingNavigationDropdown = !showingNavigationDropdown"
              >
                Log Out
              </ResponsiveNavLink>
            </div>
          </div>
        </div>
      </Transition>
    </nav>

    <!-- Page Content -->
    <main class="relative">
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
  </div>
</template>
