<script setup>
import { Bar, Line, Pie } from "vue-chartjs";
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
    ArcElement,
    PointElement,
    LineElement,
} from "chart.js";

// Register necessary chart types globally
ChartJS.register(
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
    ArcElement,
    PointElement,
    LineElement
);

// Props: type, data, and options from parent
const props = defineProps({
    type: String,
    data: Object,
    options: Object,
});
</script>

<template>
    <component
        :is="type === 'bar' ? Bar : type === 'line' ? Line : Pie"
        :data="data"
        :options="options"
    />
</template>
