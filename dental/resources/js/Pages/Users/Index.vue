<script setup>
import { usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const page = usePage();
const users = computed(() => page.props.users);

const deleteUser = (id) => {
    if (confirm("Are you sure you want to delete this user?")) {
        router.delete(`users/${id}`, {
            onSuccess: () => alert("User deleted successfully!"),
        });
    }
};
</script>

<template>
    <AdminLayout>
        <div class="min-h-screen bg-[#E5F3F3] px-4 sm:px-6 lg:px-8 py-8">
            <div
                class="max-w-6xl mx-auto bg-white shadow-xl rounded-2xl p-6 sm:p-8"
            >
                <!-- Header -->
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6"
                >
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#2C3E50]">
                        User Management
                    </h1>

                    <button
                        @click="$inertia.get(route('users.create'))"
                        class="w-full sm:w-auto px-4 py-2 rounded-lg bg-[#4E8C8C] text-white text-sm sm:text-base hover:bg-[#2C3E50] transition font-semibold"
                    >
                        + Add User
                    </button>
                </div>

                <!-- Responsive Table -->
                <div class="overflow-x-auto rounded-lg border border-[#A4D6E1]">
                    <table class="w-full text-sm sm:text-base">
                        <thead>
                            <tr class="bg-[#4E8C8C] text-white text-left">
                                <th class="py-3 px-4">#</th>
                                <th class="py-3 px-4">Name</th>
                                <th class="py-3 px-4">Email</th>
                                <th class="py-3 px-4">Role</th>
                                <th class="py-3 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(user, index) in users"
                                :key="user.id"
                                class="border-b border-[#E5F3F3] hover:bg-[#F5FAFA] transition"
                            >
                                <td class="py-3 px-4 text-gray-700">
                                    {{ index + 1 }}
                                </td>
                                <td
                                    class="py-3 px-4 font-medium text-[#2C3E50] cursor-pointer hover:underline"
                                    @click="
                                        router.visit(
                                            route('users.show', user.id)
                                        )
                                    "
                                >
                                    {{ user.name }}
                                </td>
                                <td class="py-3 px-4 text-gray-700">
                                    {{ user.email }}
                                </td>
                                <td class="py-3 px-4 capitalize text-gray-800">
                                    {{ user.role || "User" }}
                                </td>
                                <td class="py-3 px-4">
                                    <div
                                        class="flex flex-wrap gap-2 sm:gap-3 items-center"
                                    >
                                        <button
                                            @click="
                                                router.visit(
                                                    `/users/${user.id}/edit`
                                                )
                                            "
                                            class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg bg-[#4E8C8C] text-white text-xs sm:text-sm hover:bg-[#2C3E50] transition"
                                        >
                                            ✏️ Edit
                                        </button>
                                        <button
                                            @click="deleteUser(user.id)"
                                            class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg bg-red-500 text-white text-xs sm:text-sm hover:bg-red-700 transition"
                                        >
                                            🗑 Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div
                    v-if="users.length === 0"
                    class="text-center text-[#2C3E50] mt-6 font-medium"
                >
                    No users found.
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
