<script setup>
import ReceptionLayout from "@/Layouts/ReceptionLayout.vue";
import { usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();

// ✅ Reactive props
const stats = computed(() => page.props.stats);
const waiting = computed(() => page.props.waiting || []);
const todayAppointments = computed(() => page.props.todayAppointments);

// ✅ Optional manual refresh (e.g. button or after check-in)
function refreshOverview() {
    router.reload({ only: ["stats", "waiting", "todayAppointments"] });
}
</script>

<template>
    <ReceptionLayout>
        <div class="p-8 text-[#2C3E50]">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-[#4E8C8C]">
                    Reception Overview
                </h1>
                <button
                    @click="refreshOverview"
                    class="px-4 py-2 bg-[#4E8C8C] text-white rounded-lg hover:bg-[#397575]"
                >
                    Refresh
                </button>
            </div>

            <!-- Stats Cards -->
            <div
                class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-10"
            >
                <div
                    v-for="(value, key) in stats"
                    :key="key"
                    class="bg-white rounded-xl shadow-sm p-6 text-center border border-gray-100 hover:shadow-md transition"
                >
                    <h3 class="text-sm uppercase text-gray-500 mb-2">
                        {{ key.replace(/([A-Z])/g, " $1") }}
                    </h3>
                    <p class="text-3xl font-bold text-[#4E8C8C]">{{ value }}</p>
                </div>
            </div>

            <!-- Waiting Patients -->
            <div
                class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-10"
            >
                <h2 class="text-xl font-semibold text-[#2C3E50] mb-4">
                    🕐 Waiting Patients
                </h2>

                <div
                    v-if="waiting.length"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
                >
                    <div
                        v-for="w in waiting"
                        :key="w.id"
                        class="p-4 border rounded-lg shadow-sm hover:shadow-md transition"
                    >
                        <p class="font-semibold text-[#4E8C8C]">
                            {{ w.patient.name }}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{ w.service.name }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{
                                new Date(
                                    w.appointment_time
                                ).toLocaleTimeString()
                            }}
                        </p>
                    </div>
                </div>

                <div v-else class="text-gray-500 text-center p-4">
                    No patients waiting right now.
                </div>
            </div>

            <!-- Today's Appointments -->
            <div
                class="bg-white p-6 rounded-xl shadow-sm border border-gray-100"
            >
                <h2 class="text-xl font-semibold text-[#2C3E50] mb-4">
                    📅 Today's Appointments
                </h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr
                                class="bg-[#E5F3F3] text-[#2C3E50] text-sm uppercase"
                            >
                                <th class="p-3 text-left">Patient</th>
                                <th class="p-3 text-left">Service</th>
                                <th class="p-3 text-left">Time</th>
                                <th class="p-3 text-left">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr
                                v-for="a in todayAppointments"
                                :key="a.id"
                                class="border-b hover:bg-[#F5FAFA] transition"
                            >
                                <td class="p-3 font-medium">
                                    {{ a.patient.name }}
                                </td>
                                <td class="p-3">{{ a.service.name }}</td>
                                <td class="p-3">
                                    {{
                                        new Date(
                                            a.appointment_time
                                        ).toLocaleTimeString()
                                    }}
                                </td>
                                <td class="p-3 capitalize">
                                    <span
                                        :class="{
                                            'text-[#4E8C8C]':
                                                a.status === 'checked_in',
                                            'text-gray-700':
                                                a.status === 'scheduled',
                                            'text-green-600':
                                                a.status === 'completed',
                                            'text-red-500':
                                                a.status === 'cancelled',
                                        }"
                                        >{{ a.status }}</span
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </ReceptionLayout>
</template>
