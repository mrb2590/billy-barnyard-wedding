<script setup>
  import {ref} from 'vue';

  import Dropdown from '@/Components/Dropdown.vue';
  import DropdownLink from '@/Components/DropdownLink.vue';
  import OurNames from '@/Components/OurNames.vue';
  import ParallaxBackgroundImage from '@/Components/ParallaxBackgroundImage.vue';
  import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
  import ThemeButton from '@/Components/ThemeButton.vue';

  const showingNavigationDropdown = ref(false);
</script>

<template>
  <div class="min-h-screen relative w-full pt-16">
    <ParallaxBackgroundImage image="flowers" />

    <nav
      class="fixed z-20 top-0 left-0 w-full h-16"
      :class="{'bg-primary-950': showingNavigationDropdown}"
    >
      <div class="absolute w-full h-full top-0 left-0 bg-gradient-to-b from-primary-950 z-0" />
      <div class="absolute w-full h-full top-0 left-0 bg-gradient-to-b from-primary-950 z-0" />
      <div class="absolute w-full h-full top-0 left-0 blur-mask z-0" />

      <!-- Primary Navigation Menu -->
      <div class="container mx-auto px-6 relative">
        <div class="flex justify-between h-16">
          <div class="flex">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
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

          <div class="hidden sm:flex sm:items-center sm:ml-6">
            <!-- Settings Dropdown -->
            <div class="ml-3 relative">
              <Dropdown align="right" width="48">
                <template #trigger>
                  <span class="inline-flex rounded-md">
                    <ThemeButton variant="nav">
                      {{ $page.props.auth.user.name }}

                      <svg
                        class="ml-2 -mr-0.5 h-4 w-4"
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
        enter-active-class="transition ease-out duration-300"
        enter-from-class="opacity-0 scale-95"
        enter-to-class="opacity-100 scale-100"
        leave-active-class="transition ease-in duration-300"
        leave-from-class="opacity-100 scale-100"
        leave-to-class="opacity-0 scale-95"
        appear
      >
        <div
          v-show="showingNavigationDropdown"
          class="sm:hidden bg-white top-16 left-0 w-full h-[calc(100vh_-_4rem)] z-40"
        >
          <div class="pt-2 pb-3 space-y-1">
            <ResponsiveNavLink
              :href="route('dashboard')"
              :active="route().current('dashboard')"
              @click="showingNavigationDropdown = !showingNavigationDropdown"
            >
              Dashboard
            </ResponsiveNavLink>
          </div>

          <!-- Responsive Settings Options -->
          <div class="pt-4 pb-1 border-t border-primary-700 text-primary-700">
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
        enter-active-class="transition ease-out duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-in duration-300"
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
