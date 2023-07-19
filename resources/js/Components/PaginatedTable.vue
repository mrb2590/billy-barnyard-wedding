<script setup>
  // {
  //   title: 'Col 1',
  //   field: 'field',
  //   classes: 'text-center',
  //   getValue: () => {},
  // }

  import axios from 'axios';
  import {computed, onMounted, ref, watch} from 'vue';

  import FancyCard from '@/Components/FancyCard.vue';
  import Pagination from '@/Components/Pagination.vue';

  import ThemeLink from './ThemeLink.vue';

  const props = defineProps({
    apiRoute: {
      type: String,
      required: true
    },
    columns: {
      type: Array,
      required: true
    }
  });

  const data = ref([]);
  const meta = ref({
    current_page: 1,
    total: 0,
    per_page: 25
  });
  const loadingData = ref(true);
  const page = ref(1);
  const perPage = ref(25);

  const from = computed(() => {
    return page.value * perPage.value - perPage.value + 1;
  });
  const to = computed(() => {
    const to = page.value * perPage.value;

    if (to > meta.value.total || to === 0) {
      return meta.value.total;
    }

    return to;
  });

  const fetchData = () => {
    loadingData.value = true;

    axios
      .get(props.apiRoute, {
        params: {
          per_page: perPage.value,
          page: page.value
        }
      })
      .then((response) => {
        data.value = response.data.data;
        meta.value = response.data.meta;
        loadingData.value = false;
        page.value = meta.value.current_page;
      });
  };

  watch(page, () => {
    fetchData();
  });

  onMounted(() => {
    fetchData();
  });
</script>

<template>
  <div>
    <div class="relative w-full overflow-auto text-sm">
      <section
        class="heading-text flex w-full border-collapse flex-col border-none text-left sm:table sm:table-auto"
        :class="{'!border-b-gray-300 !text-gray-300': loadingData}"
      >
        <header
          class="heading-text hidden border-b-2 border-b-primary-700 font-extrabold sm:table-row"
        >
          <div
            v-for="(column, i) in props.columns"
            :key="i"
            class="hidden p-2 align-bottom sm:table-cell"
            :class="`${column.classes} text-${column.align ?? 'left'}`"
          >
            {{ column.title }}
          </div>
        </header>
        <div
          v-for="(row, i) in data"
          :key="i"
          class="heading-text flex flex-col border-b border-b-primary-700 font-normal normal-case sm:table-row"
        >
          <div
            v-for="(column, j) in columns"
            :key="j"
            class="flex flex-row p-2 align-middle sm:table-cell"
          >
            <div class="font-extrabold uppercase sm:hidden">{{ column.title }}</div>
            <div class="m-2 grow border-b border-dotted border-b-primary-700 sm:hidden" />
            <div class="text-right" :class="`${column.classes} sm:text-${column.align ?? 'left'}`">
              <ThemeLink v-if="column.href" :href="column.href(row)">
                {{ column.getValue ? column.getValue(row[column.field]) : row[column.field] }}
              </ThemeLink>
              <span v-else>
                {{ column.getValue ? column.getValue(row[column.field]) : row[column.field] }}
              </span>
            </div>
          </div>
        </div>
      </section>

      <div
        v-if="loadingData"
        class="heading-text absolute left-0 top-0 z-10 flex h-full w-full items-center justify-center bg-black/10 text-2xl text-primary-700"
      >
        <FancyCard> Loading </FancyCard>
      </div>
    </div>

    <div
      class="heading-text my-4 flex flex-col items-center justify-center space-y-4 font-normal normal-case md:flex-row md:justify-between md:space-x-4 md:space-y-0"
    >
      <div>
        Showing
        <span v-if="meta.total > 0">
          <strong>{{ from.toLocaleString() }}</strong> to
          <strong>{{ to.toLocaleString() }}</strong> of
          <strong>{{ meta.total.toLocaleString() }}</strong>
        </span>
        <strong v-if="meta.total === 0"> 0 </strong>
        entries
      </div>

      <Pagination
        v-model:page="page"
        :per-page="meta.per_page"
        :total-rows="meta.total"
        :disabled="loadingData"
      />
    </div>
  </div>
</template>
