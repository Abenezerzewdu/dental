<script setup>
import { Link, usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
const services = computed(() => usePage().props.services || []);

function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this service?")) {
        router.delete(`/services/${id}`);
    }
}
</script>

<template>
    <AdminLayout>
        <div class="p-6 max-w-5xl mx-auto text-[#2C3E50]">
            <h1 class="text-3xl font-bold mb-6 text-[#4E8C8C]">
                Service Management
            </h1>

            <div class="flex justify-end mb-6">
                <Link
                    href="/services/create"
                    class="px-4 py-2 bg-[#4E8C8C] text-white rounded-lg hover:bg-[#A4D6E1] hover:text-[#2C3E50] transition"
                >
                    + Add Service
                </Link>
            </div>

            <div
                class="overflow-x-auto rounded-lg border border-[#A4D6E1] shadow-sm bg-[#FFFFFF]"
            >
                <table class="w-full text-left border-collapse">
                    <thead
                        class="bg-[#E5F3F3] text-[#2C3E50] uppercase text-sm"
                    >
                        <tr>
                            <th class="p-3 border-b border-[#A4D6E1]">Photo</th>
                            <th class="p-3 border-b border-[#A4D6E1]">Name</th>
                            <th class="p-3 border-b border-[#A4D6E1]">
                                Description
                            </th>
                            <th class="p-3 border-b border-[#A4D6E1]">Price</th>
                            <th
                                class="p-3 border-b border-[#A4D6E1] text-center"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="service in services"
                            :key="service.id"
                            class="border-b border-[#E5F3F3] hover:bg-[#E5F3F3] transition"
                        >
                            <!-- Photo -->
                            <td class="p-3">
                                <img
                                    v-if="service.photo"
                                    :src="`/storage/${service.photo}`"
                                    class="w-16 h-16 object-cover rounded-lg border border-[#A4D6E1]"
                                />
                                <span v-else class="text-gray-400"
                                    >No photo</span
                                >
                            </td>

                            <td class="p-3 font-medium">{{ service.name }}</td>
                            <td class="p-3">
                                {{ service.description || "-" }}
                            </td>
                            <td class="p-3">
                                {{ service.price ? "$" + service.price : "-" }}
                            </td>

                            <td class="p-3 text-center">
                                <Link
                                    :href="`/services/${service.id}/edit`"
                                    class="text-[#4E8C8C] hover:text-[#2C3E50] mr-3 font-medium"
                                >
                                    Edit
                                </Link>
                                <button
                                    @click="confirmDelete(service.id)"
                                    class="text-red-600 hover:text-red-800 font-medium"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <tr v-if="services.length === 0">
                            <td
                                colspan="5"
                                class="text-center p-6 text-gray-500"
                            >
                                No services yet.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
