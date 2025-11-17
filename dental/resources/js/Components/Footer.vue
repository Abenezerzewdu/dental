<template>
    <footer class="w-full py-6 mt-12 border-t bg-gray-50 text-gray-600">
        <div
            class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4"
        >
            <!-- Left -->
            <p class="text-sm">© {{ year }} {{ name }}. All rights reserved.</p>

            <!-- Right -->
            <div class="flex items-center gap-4 text-sm">
                <a href="#" class="hover:text-primary transition">Terms</a>
                <a href="#" class="hover:text-primary transition">Privacy</a>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { computed } from "vue";

const year = new Date().getFullYear();
const name = "Abenezer Zewdu";
</script>
