<template>
    <AdminLayout>
    <div class="min-h-screen bg-[#E5F3F3] flex items-center justify-center p-6">
        <div class="bg-white shadow-xl rounded-2xl w-full max-w-lg p-8">
            <h1 class="text-3xl font-bold text-[#2C3E50] mb-6 text-center">
                Profile
            </h1>

            <form @submit.prevent="submit" class="space-y-5">
                <!-- Name -->
                <div>
                    <label class="block text-[#2C3E50] font-medium mb-1"
                        >Name</label
                    >
                    <input
                        v-model="form.name"
                        type="text"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#4E8C8C]"
                        placeholder="Enter user's full name"
                        required
                    />
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-[#2C3E50] font-medium mb-1"
                        >Email</label
                    >
                    <input
                        v-model="form.email"
                        type="email"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#4E8C8C]"
                        placeholder="Enter user's email"
                        required
                    />
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-[#2C3E50] font-medium mb-1"
                        >Password</label
                    >
                    <input
                        v-model="form.password"
                        type="password"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#4E8C8C]"
                        placeholder="Set a password"
                        required
                    />
                </div>

                <!-- Phone (optional) -->
                <div>
                    <label class="block text-[#2C3E50] font-medium mb-1"
                        >Phone</label
                    >
                    <input
                        v-model="form.phone"
                        type="tel"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#4E8C8C]"
                        placeholder="Optional phone number"
                    />
                </div>

                <!-- Photo (optional) -->
                <div>
                    <label class="block text-[#2C3E50] font-medium mb-1"
                        >Photo</label
                    >
                    <input
                        @change="form.photo = $event.target.files[0]"
                        type="file"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#4E8C8C]"
                    />
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full bg-[#4E8C8C] hover:bg-[#2C3E50] text-white font-semibold py-2 rounded-lg transition duration-200"
                >
                    Update User
                </button>
            </form>
        </div>
    </div>
    </AdminLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
const page = usePage();
const user = page.props.user;
const form = useForm({
    name: user.name || "",
    email: user.email || "",
    phone: user.phone || "",
    photo: user.photo || null,
    _method: "put",
});

const submit = () => {
    form.post(route("users.update", user.id), {
        onSuccess: () => {
            alert("succefully edited user");
            router.visit("/users");
        },
        onError: (err) => {
            console.log(err);
        },
        forceFormData: true,
        preserveState: false,
    });
};
</script>
