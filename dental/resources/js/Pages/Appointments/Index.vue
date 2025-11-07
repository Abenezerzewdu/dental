<script setup>
import { Link, usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";
import dayjs from "dayjs";
import AdminLayout from "@/Layouts/AdminLayout.vue";
// Get appointments with patient & service
const appointments = computed(() => usePage().props.appointments || []);

// ✅ Human-readable date formatter
function humanizeDate(dateString) {
    const today = dayjs().startOf("day");
    const target = dayjs(dateString).startOf("day");
    const diff = target.diff(today, "day");

    if (diff === 0) return "Today";
    if (diff === 1) return "Tomorrow";
    if (diff === 2) return "The day after tomorrow";
    if (diff === -1) return "Yesterday";
    if (diff === -2) return "The day before yesterday";

    return target.format("dddd, MMM D");
}

// ✅ Confirm + Delete appointment
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this appointment?")) {
        router.delete(`/appointments/${id}`, {
            onSuccess: () => console.log("Appointment deleted successfully"),
            onError: (err) => console.error("Delete failed:", err),
        });
    }
}
</script>

<template>
    <AdminLayout>
        <div class="p-8 max-w-5xl mx-auto text-[#2C3E50]">
            <h1 class="text-3xl font-bold mb-6 text-[#4E8C8C]">
                Appointments Dashboard
            </h1>

            <!-- Book New Appointment Button -->
            <div class="flex justify-end mb-6">
                <Link
                    href="/appointment/create"
                    class="px-4 py-2 bg-[#4E8C8C] text-white rounded-lg shadow-md hover:bg-[#A4D6E1] hover:text-[#2C3E50] transition"
                >
                    + Book New Appointment
                </Link>
            </div>

            <!-- Appointments Table -->
            <div
                class="overflow-x-auto rounded-lg border border-[#A4D6E1] shadow-sm bg-[#FFFFFF]"
            >
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-[#E5F3F3] text-[#2C3E50] uppercase text-sm"
                        >
                            <th class="p-3 border-b border-[#A4D6E1]">
                                Patient
                            </th>
                            <th class="p-3 border-b border-[#A4D6E1]">Date</th>
                            <th class="p-3 border-b border-[#A4D6E1]">
                                Service
                            </th>
                            <th class="p-3 border-b border-[#A4D6E1]">
                                Status
                            </th>
                            <th
                                class="p-3 border-b border-[#A4D6E1] text-center"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="appointment in appointments"
                            :key="appointment.id"
                            class="border-b border-[#E5F3F3] hover:bg-[#E5F3F3] transition"
                        >
                            <td
                                @click="
                                    router.visit(
                                        route(
                                            'appointment.show',
                                            appointment.id
                                        )
                                    )
                                "
                                class="p-3 font-medium"
                            >
                                {{ appointment.patient?.name || "Unknown" }}
                            </td>
                            <td class="p-3">
                                {{ humanizeDate(appointment.appointment_time) }}
                            </td>
                            <td class="p-3">{{ appointment.service?.name }}</td>
                            <td
                                class="p-3 capitalize font-medium"
                                :class="{
                                    'text-[#4E8C8C]':
                                        appointment.status === 'confirmed',
                                    'text-[#2C3E50]':
                                        appointment.status === 'pending',
                                    'text-red-600':
                                        appointment.status === 'cancelled',
                                }"
                            >
                                {{ appointment.status }}
                            </td>
                            <td class="p-3 text-center">
                                <Link
                                    :href="`/appointments/${appointment.id}/edit`"
                                    class="text-[#4E8C8C] hover:text-[#2C3E50] mr-3 font-medium"
                                >
                                    Edit
                                </Link>
                                <button
                                    @click="confirmDelete(appointment.id)"
                                    class="text-red-600 hover:text-red-800 font-medium"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Empty state -->
                        <tr v-if="appointments.length === 0">
                            <td
                                colspan="5"
                                class="text-center text-gray-500 p-6"
                            >
                                No appointments yet.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
body {
    background-color: #ffffff;
}
table {
    font-size: 0.95rem;
}
button,
a {
    cursor: pointer;
    transition: 0.2s ease-in-out;
}
</style>
