<script setup>
  import {ArcElement, Chart as ChartJS, Legend, Tooltip} from 'chart.js';
  import ChartDataLabels from 'chartjs-plugin-datalabels';
  import colors from 'tailwindcss/colors';
  import {ref} from 'vue';
  import {Pie} from 'vue-chartjs';

  ChartJS.register(Tooltip, Legend, ArcElement, ChartDataLabels);

  const props = defineProps({
    data: {
      type: Array,
      required: true
    }
  });

  const chartData = ref({
    labels: ['Accepted', 'Declined', 'No Response'],
    datasets: [
      {
        label: 'Guests',
        data: props.data,
        backgroundColor: [colors.green['700'], colors.red['700'], colors.slate['200']]
      }
    ]
  });

  const chartOpts = ref({
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      datalabels: {
        formatter: (value, ctx) => {
          let sum = 0;
          const dataArr = ctx.chart.data.datasets[0].data;

          dataArr.forEach((data) => {
            sum += data;
          });

          return ((value * 100) / sum).toFixed(2) + '%';
        },
        color: colors.slate['700'],
        backgroundColor: colors.white,
        borderColor: colors.slate['700'],
        borderWidth: 1,
        borderRadius: 4,
        anchor: 'end',
        align: 'start',
        clamp: true
      }
    }
  });
</script>

<template>
  <Pie :options="chartOpts" :data="chartData" class="w-full" />
</template>
