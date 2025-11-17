<template>
    <nav
        class="sticky top-0 z-50 bg-[#4E8C8C]/60 backdrop-blur-xl text-white shadow-sm"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <Link href="/">
                    <div
                        class="flex-shrink-0 text-2xl font-semibold tracking-wide"
                    >
                        Dental
                    </div>
                </Link>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 text-sm font-medium">
                    <a href="#" class="hover:text-[#A4D6E1] transition">Home</a>
                    <a href="#services" class="hover:text-[#A4D6E1] transition"
                        >Services</a
                    >
                    <a href="#contact" class="hover:text-[#A4D6E1] transition"
                        >Contact</a
                    >

                    <Link
                        v-if="!user"
                        href="/login"
                        class="bg-gradient-to-r from-grey-500 to-blue-500 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gradient-to-l"
                    >
                        Login
                    </Link>

                    <Link
                        v-if="user"
                        href="/dashboard"
                        class="px-4 py-2 rounded-xl font-semibold bg-white/20 backdrop-blur hover:bg-white/30 transition"
                    >
                        Dashboard
                    </Link>

                    <Link
                        href="/appointment/create"
                        class="px-4 py-2 rounded-xl font-semibold bg-white text-[#2C3E50] hover:bg-[#E5F3F3] transition"
                    >
                        Book Appointment
                    </Link>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button
                        @click="menuOpen = !menuOpen"
                        class="focus:outline-none"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                :d="
                                    menuOpen
                                        ? 'M6 18L18 6M6 6l12 12'
                                        : 'M4 6h16M4 12h16M4 18h16'
                                "
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div
            v-if="menuOpen"
            class="md:hidden bg-[#4E8C8C]/80 backdrop-blur-xl border-t border-white/20 px-4 py-3 space-y-2"
        >
            <a href="#" class="block text-white hover:text-[#A4D6E1]">Home</a>
            <a href="#services" class="block text-white hover:text-[#A4D6E1]"
                >Services</a
            >
            <a href="#contact" class="block text-white hover:text-[#A4D6E1]"
                >Contact</a
            >

            <a
                href="/appointment/create"
                class="block bg-white text-[#2C3E50] text-center py-2 rounded-xl font-semibold hover:bg-[#E5F3F3]"
            >
                Book Appointment
            </a>
        </div>
    </nav>
</template>

<script setup>
import { ref, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import SecondaryButton from "./SecondaryButton.vue";

const menuOpen = ref(false);
const user = computed(() => usePage().props.auth.user);
</script>
