<script setup>
  import {computed, ref, watch} from 'vue';

  import ThemeButton from './ThemeButton.vue';

  const props = defineProps({
    page: {
      type: Number,
      required: true
    },
    perPage: {
      type: Number,
      required: true
    },
    totalRows: {
      type: Number,
      required: true
    },
    disabled: {
      type: Boolean,
      default: false
    },
    variant: {
      type: String,
      default: 'secondary'
    }
  });

  const currentPage = ref(props.page);
  const emit = defineEmits(['update:page']);

  const lastPage = computed(() => {
    if (props.totalRows === 0) {
      return 1;
    }

    return Math.ceil(props.totalRows / props.perPage);
  });

  const goToPrevPage = () => {
    if (currentPage.value < 2) {
      currentPage.value = 1;
    }

    currentPage.value--;
  };
  const goToNextPage = () => {
    if (currentPage.value >= lastPage.value) {
      currentPage.value = lastPage.value;
    }

    currentPage.value++;
  };

  watch(
    () => props.page,
    (val) => (currentPage.value = val)
  );
  watch(currentPage, (val, oldVal) => {
    if (val === oldVal) {
      return;
    }

    emit('update:page', val);
  });
</script>

<template>
  <div class="flex flex-row flex-nowrap items-center justify-center space-x-1">
    <ThemeButton
      v-if="currentPage !== 1"
      class="!p-2 text-sm"
      :variant="props.variant"
      :disabled="props.disabled"
      @click="currentPage = 1"
    >
      First
    </ThemeButton>

    <ThemeButton
      class="!p-2 text-sm"
      :variant="props.variant"
      :disabled="props.disabled || currentPage === 1"
      @click="goToPrevPage"
    >
      Prev
    </ThemeButton>

    <div class="!p-2 text-base">
      {{ currentPage.toLocaleString() }}
    </div>

    <ThemeButton
      class="!p-2 text-sm"
      :variant="props.variant"
      :disabled="props.disabled || currentPage === lastPage"
      @click="goToNextPage()"
    >
      Next
    </ThemeButton>

    <ThemeButton
      v-if="currentPage !== lastPage"
      class="!p-2 text-sm"
      :variant="props.variant"
      :disabled="props.disabled"
      @click="currentPage = lastPage"
    >
      Last
    </ThemeButton>
  </div>
</template>
