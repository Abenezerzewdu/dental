<script setup>
import { ref } from "vue";
import { Link, usePage, router } from "@inertiajs/vue3";

const open = ref(false); // Sidebar toggle (for mobile)
const profileOpen = ref(false); // Profile dropdown toggle
const page = usePage();
const user = page.props.value?.auth?.user || {
    name: "Admin",
    email: "admin@demo.com",
};

const theme = {
    primary: "#4E8C8C",
    bg: "#E5F3F3",
    dark: "#2C3E50",
    accent: "#A4D6E1",
};

function logout() {
    router.post("/logout");
}
</script>

<template>
    <div class="h-screen flex flex-col" :style="{ backgroundColor: theme.bg }">
        <!-- 🧭 Top Navbar -->
        <header class="w-full bg-white shadow-sm sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Left: Menu toggle + Brand -->
                    <div class="flex items-center gap-3">
                        <button
                            @click="open = !open"
                            class="p-2 rounded-md md:hidden hover:bg-[#EDEDED]"
                            aria-label="Toggle sidebar"
                        >
                            <svg
                                class="w-6 h-6 text-[#2C3E50]"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M4 6h16M4 12h16M4 18h16"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </button>

                        <Link href="/" class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg flex items-center justify-center"
                                :style="{ backgroundColor: theme.primary }"
                            >
                                <span class="text-white font-bold">SD</span>
                            </div>
                            <div class="hidden sm:block">
                                <h1
                                    class="text-xl font-semibold"
                                    :style="{ color: theme.dark }"
                                >
                                    Smart Dental Admin
                                </h1>
                                <p
                                    class="text-sm"
                                    :style="{ color: theme.accent }"
                                >
                                    Clinic management
                                </p>
                            </div>
                        </Link>
                    </div>

                    <!-- Right: Search, Bell, Profile -->
                    <div class="flex items-center gap-4">
                        <!-- Search -->
                        <div
                            class="hidden md:flex items-center border rounded-lg px-3 py-1 bg-[#F9FAFB]"
                        >
                            <svg
                                class="w-4 h-4 text-gray-500 mr-2"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"
                                />
                            </svg>
                            <input
                                type="text"
                                placeholder="Search..."
                                class="bg-transparent outline-none text-sm text-gray-600"
                            />
                        </div>

                        <!-- Notifications -->
                        <button
                            class="relative text-gray-600 hover:text-[#4E8C8C]"
                        >
                            <i class="fas fa-bell"></i>
                            <span
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-3 h-3 rounded-full"
                            ></span>
                        </button>

                        <!-- Profile -->
                        <div class="relative">
                            <button
                                @click="profileOpen = !profileOpen"
                                class="flex items-center gap-3 p-1 rounded hover:bg-[#F6F6F6]"
                            >
                                <div
                                    class="w-9 h-9 rounded-full bg-[#E5F3F3] flex items-center justify-center border"
                                    :style="{ borderColor: theme.accent }"
                                >
                                    <span class="text-[#2C3E50] font-semibold">
                                        {{ user.name.charAt(0) }}
                                    </span>
                                </div>
                                <div class="hidden sm:flex flex-col text-left">
                                    <span
                                        class="text-sm font-medium"
                                        :style="{ color: theme.dark }"
                                        >{{ user.name }}</span
                                    >
                                    <span
                                        class="text-xs"
                                        :style="{ color: theme.accent }"
                                        >{{ user.email }}</span
                                    >
                                </div>
                            </button>

                            <!-- Dropdown -->
                            <transition name="fade">
                                <div
                                    v-if="profileOpen"
                                    class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow z-50"
                                >
                                    <button
                                        @click="router.visit('/profile')"
                                        class="w-full text-left px-3 py-2 text-sm hover:bg-[#F6F6F6]"
                                    >
                                        Profile
                                    </button>
                                    <button
                                        @click="logout"
                                        class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-[#FFF5F5]"
                                    >
                                        Logout
                                    </button>
                                </div>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- 💠 Layout Body -->
        <div class="flex flex-1 relative overflow-hidden">
            <!-- Sidebar -->
            <aside
                :class="[
                    'fixed top-16 left-0 h-[calc(100vh-4rem)] w-64 text-white bg-gradient-to-b from-[#4E8C8C] to-[#3A6F6F] shadow-lg z-50 transform transition-transform duration-300 ease-in-out md:translate-x-0 md:block',
                    open ? 'translate-x-0' : '-translate-x-full',
                ]"
            >
                <div class="p-4 overflow-y-auto h-full">
                    <nav class="space-y-2">
                        <Link
                            href="/admin"
                            class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-[#A4D6E133]"
                            @click="open = false"
                        >
                            <i class="fas fa-home w-5"></i>
                            <span>Overview</span>
                        </Link>

                        <Link
                            href="/users"
                            class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-[#A4D6E133]"
                            @click="open = false"
                        >
                            <i class="fas fa-users w-5"></i>
                            <span>Users</span>
                        </Link>

                        <Link
                            href="/services"
                            class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-[#A4D6E133]"
                            @click="open = false"
                        >
                            <i class="fas fa-tooth w-5"></i>
                            <span>Services</span>
                        </Link>

                        <Link
                            href="/appointments"
                            class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-[#A4D6E133]"
                            @click="open = false"
                        >
                            <i class="fas fa-calendar-check w-5"></i>
                            <span>Appointments</span>
                        </Link>

                        <Link
                            href="/appointments"
                            class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-[#A4D6E133]"
                            @click="open = false"
                        >
                            <i class="fas fa-calendar-check w-5"></i>
                            <span>Roles</span>
                        </Link>

                        <!-- <Link
                            href="/admin/settings"
                            class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-[#A4D6E133]"
                            @click="open = false"
                        >
                            <i class="fas fa-cog w-5"></i>
                            <span>Settings</span>
                        </Link> -->
                    </nav>
                </div>
            </aside>

            <!-- Overlay (mobile only) -->
            <transition name="fade">
                <div
                    v-if="open"
                    @click="open = false"
                    class="fixed inset-0 bg-black bg-opacity-40 z-40 md:hidden"
                ></div>
            </transition>

            <!-- Main Content -->
            <main
                class="flex-1 p-6 sm:p-8 overflow-y-auto transition-all duration-300 md:ml-64"
            >
                <header class="mb-6">
                    <slot name="header"></slot>
                </header>
                <div>
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.25s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
