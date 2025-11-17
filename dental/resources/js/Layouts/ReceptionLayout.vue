<template>
    <div class="h-screen bg-[#F8FAFB] flex flex-col overflow-hidden">
        <!-- Top Navbar -->
        <header
            class="fixed top-0 left-0 right-0 h-16 bg-[#4E8C8C] text-white flex justify-between items-center px-6 shadow-md z-50"
        >
            <!-- Left: Menu + Title -->
            <div class="flex items-center space-x-4">
                <!-- Mobile menu -->
                <button
                    @click="isSidebarOpen = !isSidebarOpen"
                    class="md:hidden focus:outline-none"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>
                <h1 class="text-lg md:text-xl font-semibold tracking-wide">
                    Reception Panel
                </h1>
            </div>

            <!-- Right: Profile -->
            <div class="relative">
                <button
                    @click="toggleProfile"
                    class="flex items-center space-x-2 focus:outline-none"
                >
                    <img
                        src="https://ui-avatars.com/api/?name=Reception"
                        alt="Profile"
                        class="w-8 h-8 rounded-full border-2 border-white"
                    />
                    <span class="hidden sm:inline text-sm font-medium"
                        >Receptionist</span
                    >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                </button>

                <!-- Dropdown -->
                <transition
                    enter-active-class="transition ease-out duration-100"
                    enter-from-class="opacity-0 scale-95"
                    enter-to-class="opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-75"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-95"
                >
                    <div
                        v-if="showProfile"
                        class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg z-50"
                    >
                        <Link class="block px-4 py-2 hover:bg-gray-100"
                            >Profile</Link
                        >
                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                            >Logout</Link
                        >
                    </div>
                </transition>
            </div>
        </header>

        <!-- Layout Container -->
        <div class="flex flex-1 pt-16 overflow-hidden">
            <!-- Sidebar -->
            <aside
                :class="[
                    'bg-[#3B7A7A] text-white w-64 space-y-2 p-5 fixed md:static inset-y-0 left-0 z-40 shadow-lg transform transition-transform duration-300 ease-in-out',
                    isSidebarOpen
                        ? 'translate-x-0'
                        : '-translate-x-full md:translate-x-0',
                ]"
            >
                <nav class="mt-4 space-y-1">
                    <Link
                        href="/reception"
                        class="block px-4 py-2 rounded-lg hover:bg-[#2C3E50] transition duration-200"
                        :class="{
                            'bg-[#2C3E50]': route().current(
                                'reception.dashboard'
                            ),
                        }"
                    >
                        Overview
                    </Link>
                    <Link
                        href="/appointments"
                        class="block px-4 py-2 rounded-lg hover:bg-[#2C3E50] transition duration-200"
                        :class="{
                            'bg-[#2C3E50]': route().current(
                                'reception.appointments'
                            ),
                        }"
                    >
                        Appointments
                    </Link>
                    <Link
                        href="/patients"
                        class="block px-4 py-2 rounded-lg hover:bg-[#2C3E50] transition duration-200"
                        :class="{
                            'bg-[#2C3E50]':
                                route().current('reception.patients'),
                        }"
                    >
                        Patients
                    </Link>
                    <Link
                        href="/checkins"
                        class="block px-4 py-2 rounded-lg hover:bg-[#2C3E50] transition duration-200"
                        :class="{
                            'bg-[#2C3E50]':
                                route().current('reception.checkins'),
                        }"
                    >
                        Check-ins
                    </Link>
                </nav>
            </aside>

            <!-- Overlay (mobile) -->
            <div
                v-if="isSidebarOpen"
                @click="isSidebarOpen = false"
                class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"
            ></div>

            <!-- Main Content -->
            <main class="flex-1 ml-0 md:ml-64 overflow-y-auto bg-[#F8FAFB] p-6">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const isSidebarOpen = ref(false);
const showProfile = ref(false);
const toggleProfile = () => (showProfile.value = !showProfile.value);
</script>
