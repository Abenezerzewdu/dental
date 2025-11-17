<template>
    <div class="min-h-screen bg-[#E5F3F3] flex flex-col">
        <!-- Top Navbar -->
        <header class="sticky top-0 w-full bg-white shadow-sm z-50">
            <div
                class="max-w-7xl mx-auto flex items-center justify-between p-4"
            >
                <h1 class="text-xl font-semibold text-[#2C3E50]">
                    Patient Portal
                </h1>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 max-w-7xl mx-auto w-full p-6">
            <slot />
        </main>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<style scoped></style>
