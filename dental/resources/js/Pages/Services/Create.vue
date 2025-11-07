<script setup>
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
const form = ref({
    name: "",
    description: "",
    price: "",
    photo: null,
});

function handleSubmit() {
    //to containerize all form data in object,especially for photo
    const data = new FormData();
    data.append("name", form.value.name);
    data.append("description", form.value.description);
    data.append("price", form.value.price);

    if (form.value.photo) data.append("photo", form.value.photo);

    router.post("/services", data, {
        onSuccess: () => {
            alert("Successfully created a service");
        },
        onError: (err) => {
            console.log(err);
        },
    });
}
</script>
<template>
    <admin-layout>
        <div
            class="min-h-screen bg-[#E5F3F3] flex items-center justify-center p-6"
        >
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-8">
                <h1 class="text-2xl font-bold text-[#2C3E50] mb-6">
                    Create New Service
                </h1>

                <form @submit.prevent="handleSubmit" class="space-y-5">
                    <div>
                        <label class="block text-[#2C3E50] mb-1 font-semibold">
                            Service Name
                        </label>
                        <input
                            v-model="form.name"
                            type="text"
                            class="w-full border border-[#A4D6E1] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#4E8C8C]"
                            placeholder="Enter service name"
                            required
                        />
                    </div>

                    <div>
                        <label class="block text-[#2C3E50] mb-1 font-semibold">
                            Description
                        </label>
                        <textarea
                            v-model="form.description"
                            class="w-full border border-[#A4D6E1] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#4E8C8C]"
                            placeholder="Describe the service"
                            required
                        ></textarea>
                    </div>

                    <div>
                        <label class="block text-[#2C3E50] mb-1 font-semibold">
                            Price
                        </label>
                        <input
                            v-model="form.price"
                            type="number"
                            min="0"
                            step="0.01"
                            class="w-full border border-[#A4D6E1] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#4E8C8C]"
                            placeholder="Enter service price"
                            required
                        />
                    </div>

                    <div>
                        <label class="block text-[#2C3E50] mb-1 font-semibold">
                            Photo
                        </label>
                        <input
                            type="file"
                            @change="(e) => (form.photo = e.target.files[0])"
                            class="w-full border border-[#A4D6E1] rounded-lg p-2 bg-[#E5F3F3]"
                        />
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#4E8C8C] text-white py-2 rounded-lg hover:bg-[#2C3E50] transition"
                    >
                        Create Service
                    </button>
                </form>
            </div>
        </div>
    </admin-layout>
</template>
