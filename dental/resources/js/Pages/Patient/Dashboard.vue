<template>
    <div class="min-h-screen bg-[#E5F3F3]">
        <!-- Top Navigation -->
        <AuthenticatedLayout>
            <!-- Welcome Banner -->
            <section class="max-w-7xl mx-auto mt-6 px-6">
                <div class="bg-[#4E8C8C] text-white p-6 rounded-2xl shadow-md">
                    <h2 class="text-2xl font-semibold">
                        Welcome back, {{ user.name }}
                    </h2>
                    <p class="text-sm mt-1 opacity-80">
                        Here is an overview of your dental health activity.
                    </p>
                </div>
            </section>

            <!-- Grid Sections -->
            <section
                class="max-w-7xl mx-auto px-6 mt-10 grid md:grid-cols-3 gap-6"
            >
                <!-- Upcoming Appointment -->
                <div class="bg-white p-6 rounded-2xl shadow-md">
                    <h3 class="text-xl font-semibold text-[#2C3E50] mb-4">
                        Upcoming Appointment
                    </h3>

                    <div
                        v-if="nextAppointment"
                        v-for="appointment in nextAppointment"
                        :key="appointment.id"
                        class="space-y-1"
                    >
                        <p class="text-[#4E8C8C] font-medium">
                            {{ appointment.service.name }}
                        </p>
                        <p class="text-sm text-[#2C3E50]/70">
                            Time:{{
                                new Date(
                                    appointment.appointment_time
                                ).toLocaleString()
                            }}
                        </p>

                        <!-- <button
                        class="mt-4 bg-[#4E8C8C] text-white px-4 py-2 rounded-lg hover:bg-[#2C3E50]"
                    >
                        View Details
                    </button> -->
                    </div>

                    <p v-else class="text-sm text-[#2C3E50]/60 italic">
                        No upcoming appointments.
                    </p>
                </div>

                <!-- Medical Records -->
                <div class="bg-white p-6 rounded-2xl shadow-md">
                    <h3 class="text-xl font-semibold text-[#2C3E50] mb-4">
                        Your Records
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex justify-between">
                            <span class="text-[#2C3E50]"
                                >Past Appointments</span
                            >
                            <Link
                                href="/patient/appointments"
                                class="text-[#4E8C8C] font-medium"
                                >View</Link
                            >
                        </li>
                        <li class="flex justify-between">
                            <span class="text-[#2C3E50]">Prescriptions</span>
                            <Link
                                href="/patient/prescriptions"
                                class="text-[#4E8C8C] font-medium"
                                >View</Link
                            >
                        </li>
                        <li class="flex justify-between">
                            <span class="text-[#2C3E50]">Invoices</span>
                            <Link
                                href="/patient/invoices"
                                class="text-[#4E8C8C] font-medium"
                                >View</Link
                            >
                        </li>
                    </ul>
                </div>

                <!-- Notifications -->
                <div class="bg-white p-6 rounded-2xl shadow-md">
                    <h3 class="text-xl font-semibold text-[#2C3E50] mb-4">
                        Notifications
                    </h3>

                    <div v-if="notifications.length" class="space-y-3">
                        <div
                            v-for="(notify, i) in notifications"
                            :key="i"
                            class="border-l-4 border-[#4E8C8C] bg-[#A4D6E1]/20 p-3 rounded"
                        >
                            <p class="text-sm text-[#2C3E50]">
                                {{ notify.text }}
                            </p>
                            <span class="text-[11px] text-[#2C3E50]/50">{{
                                notify.date
                            }}</span>
                        </div>
                    </div>

                    <p v-else class="text-sm text-[#2C3E50]/60 italic">
                        No new notifications.
                    </p>
                </div>
            </section>

            <!-- CTA -->
            <section class="max-w-7xl mx-auto mt-12 px-6 pb-12">
                <div
                    class="bg-[#4E8C8C] p-10 rounded-2xl text-center text-white shadow-md"
                >
                    <h3 class="text-2xl font-bold mb-3">
                        Need a new appointment?
                    </h3>
                    <p class="text-sm mb-5 opacity-90">
                        Book your next check-up or cleaning easily.
                    </p>
                    <Link
                        href="/appointment/create"
                        class="bg-white text-[#4E8C8C] px-6 py-3 rounded-full font-semibold hover:bg-[#E5F3F3]"
                    >
                        Book Now
                    </Link>
                </div>
            </section>
        </AuthenticatedLayout>
    </div>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const page = usePage();

const user = page.props.user || "patient";
const nextAppointment = page.props.nextAppointment || null;
const notifications = page.props.notifications || [];

console.log(nextAppointment);
</script>
