<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { usePage, useForm } from "@inertiajs/vue3";
import { reactive } from "vue";

const { users, roles } = usePage().props;

// One mini form per user
const roleForms = reactive({});

users.forEach((user) => {
    roleForms[user.id] = useForm({
        user_id: user.id,
        role: "",
    });
});

// Assign role for a specific user
const assign = (user_id) => {
    roleForms[user_id].post(route("admin.roles.assign"), {
        onSuccess: () => {
            alert("successfuly saved");
        },
        onerror: (err) => {
            console.log("error" + err);
        },
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout>
        <div class="max-w-5xl mx-auto mt-10">
            <h1 class="text-2xl font-bold mb-6">Assign Roles</h1>

            <div class="bg-white shadow rounded p-6">
                <table class="min-w-full border text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-3">Name</th>
                            <th class="py-2 px-3">Email</th>
                            <th class="py-2 px-3">Current Role</th>
                            <th class="py-2 px-3">Assign New Role</th>
                            <th class="py-2 px-3">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="u in users" :key="u.id" class="border-t">
                            <td class="py-2 px-3">{{ u.name }}</td>

                            <td class="py-2 px-3">{{ u.email }}</td>

                            <td class="py-2 px-3">
                                <span
                                    class="px-2 py-1 rounded bg-blue-100 text-blue-700"
                                >
                                    {{
                                        u.roles.length
                                            ? u.roles[0].name
                                            : "No role"
                                    }}
                                </span>
                            </td>

                            <td class="py-2 px-3">
                                <select
                                    v-model="roleForms[u.id].role"
                                    class="border rounded px-2 py-1"
                                >
                                    <option disabled value="">
                                        Select role
                                    </option>
                                    <option
                                        v-for="r in roles"
                                        :value="r.name"
                                        :key="r.id"
                                    >
                                        {{ r.name }}
                                    </option>
                                </select>
                            </td>

                            <td class="py-2 px-3">
                                <button
                                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700"
                                    @click="assign(u.id)"
                                >
                                    Save
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
