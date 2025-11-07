<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import ChartWrapper from "@/Components/ChartWrapper.vue";

const {
    service,
    appointmentsPerMonth,
    users,
    appointments,
    services,
    userGrowthLabels,
    userGrowthData,
} = usePage().props;
const serviceLabels = service.map((s) => s.name);
const serviceCounts = service.map((s) => s.appointments_count);

const stats = [
    { label: "Total Appointments", value: appointments },
    { label: "Total Services", value: services },
    { label: "Total Users", value: users },
];
const pieData = {
    labels: serviceLabels,
    datasets: [
        {
            label: "Appointments per Service",
            data: serviceCounts,
            backgroundColor: [
                "#4E8C8C",
                "#A4D6E1",
                "#2C3E50",
                "#F4A261",
                "#E76F51",
            ],
        },
    ],
};

const pieOptions = {
    responsive: true,
    plugins: {
        legend: {
            display: true,
            position: "right",
        },
        title: {
            display: true,
            text: "Appointments by Service",
        },
    },
};

const userGrowthChartData = {
    labels: userGrowthLabels,
    datasets: [
        {
            label: "New Users per Month",
            backgroundColor: "#A4D6E1",
            borderColor: "#4E8C8C",
            borderWidth: 2,
            fill: true,
            data: userGrowthData,
        },
    ],
};

const userGrowthChartOptions = {
    responsive: true,
    plugins: {
        title: {
            display: true,
            text: "User Growth Over Time",
        },
    },
};

const months = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
];

const barData = {
    labels: months,
    datasets: [
        {
            label: "Appointments",
            backgroundColor: "#4E8C8C",
            data: months.map(
                (_, index) => appointmentsPerMonth[index + 1] || 0
            ),
        },
    ],
};

const barOptions = {
    responsive: true,
    plugins: {
        legend: {
            display: true,
            position: "top",
        },
        title: {
            display: true,
            text: "Appointments per Month",
        },
    },
};
</script>
<template>
    <AdminLayout>
        <template #header>
            <h2 class="text-2xl font-semibold text-[#2C3E50] mb-4">
                Dashboard Overview
            </h2>
        </template>

        <!-- Main grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Stat cards -->
            <div
                v-for="(stat, index) in stats"
                :key="index"
                class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition"
            >
                <div class="text-sm text-gray-500">{{ stat.label }}</div>
                <div class="text-3xl font-bold text-[#4E8C8C] mt-2">
                    {{ stat.value }}
                </div>
            </div>

            <!-- Full-width chart -->
            <div
                class="col-span-1 lg:col-span-3 bg-white p-6 rounded-xl shadow-sm border border-gray-100 mt-4"
            >
                <h3 class="text-lg font-semibold mb-4 text-[#2C3E50]">
                    Appointment Trends
                </h3>
                <div class="w-full h-72 md:h-96">
                    <ChartWrapper
                        :type="'bar'"
                        :data="barData"
                        :options="barOptions"
                    />
                </div>
            </div>

            <!-- Bottom section: two charts side-by-side -->
            <div
                class="col-span-1 lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-100"
            >
                <h3 class="text-lg font-semibold mb-4 text-[#2C3E50]">
                    User Growth
                </h3>
                <div class="h-72">
                    <ChartWrapper
                        :type="'line'"
                        :data="userGrowthChartData"
                        :options="userGrowthChartOptions"
                    />
                </div>
            </div>

            <div
                class="col-span-1 bg-white p-6 rounded-xl shadow-sm border border-gray-100"
            >
                <h3 class="text-lg font-semibold mb-4 text-[#2C3E50]">
                    Appointments by Service
                </h3>
                <div class="h-72">
                    <ChartWrapper
                        :type="'doughnut'"
                        :data="pieData"
                        :options="pieOptions"
                    />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
