<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
const page = usePage();
const user = computed(() => page.props.user);
</script>

<template>
    <admin-layout>
        <div
            class="min-h-screen bg-[#E5F3F3] flex items-center justify-center p-6"
        >
            <div
                class="bg-white shadow-xl rounded-2xl w-full max-w-3xl p-8 relative"
            >
                <button
                    @click="router.visit('/users')"
                    class="absolute top-4 left-4 text-[#4E8C8C] hover:text-[#2C3E50] font-medium"
                >
                    ← Back
                </button>

                <div class="flex flex-col items-center text-center">
                    <!-- Profile Photo -->
                    <div class="mb-4">
                        <img
                            v-if="user.photo"
                            :src="`/storage/${user.photo}`"
                            alt="User photo"
                            class="w-32 h-32 object-cover rounded-full shadow-md border-4 border-[#4E8C8C]"
                        />
                        <div
                            v-else
                            class="w-32 h-32 flex items-center justify-center bg-[#E5F3F3] rounded-full text-[#4E8C8C] text-3xl font-bold"
                        >
                            {{ user.name.charAt(0).toUpperCase() }}
                        </div>
                    </div>

                    <!-- User Info -->
                    <h1 class="text-2xl font-bold text-[#2C3E50] mb-2">
                        {{ user.name }}
                    </h1>
                    <p class="text-[#4E8C8C] mb-4">{{ user.email }}</p>

                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full mt-6 text-left"
                    >
                        <div>
                            <p class="text-gray-500 font-semibold mb-1">
                                Phone
                            </p>
                            <p class="text-[#2C3E50]">
                                {{ user.phone || "Not provided" }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500 font-semibold mb-1">Role</p>
                            <p class="capitalize text-[#2C3E50]">
                                {{ user.role || "User" }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500 font-semibold mb-1">
                                Joined On
                            </p>
                            <p class="text-[#2C3E50]">
                                {{
                                    new Date(
                                        user.created_at
                                    ).toLocaleDateString()
                                }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500 font-semibold mb-1">
                                Last Updated
                            </p>
                            <p class="text-[#2C3E50]">
                                {{
                                    new Date(
                                        user.updated_at
                                    ).toLocaleDateString()
                                }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex justify-center space-x-4">
                    <button
                        @click="router.visit(`/users/${user.id}/edit`)"
                        class="bg-[#4E8C8C] text-white px-6 py-2 rounded-lg hover:bg-[#2C3E50] transition"
                    >
                        Edit
                    </button>

                    <!-- <button
                    @click="deleteUser(user.id)"
                    class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition"
                >
                    Delete
                </button> -->
                </div>
            </div>
        </div>
    </admin-layout>
</template>
