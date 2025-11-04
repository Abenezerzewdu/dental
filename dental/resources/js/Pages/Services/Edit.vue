<script setup>
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    service: Object, // Passed from controller
});

const form = useForm({
    name: props.service.name || "",
    description: props.service.description || "",
    price: props.service.price || "",
    photo: null,
    _method: "put",
});

// Handles photo upload preview
const preview = ref(
    props.service.photo ? `/storage/${props.service.photo}` : null
);
function handlePhotoUpload(e) {
    const file = e.target.files[0];
    if (file) {
        form.photo = file;
        preview.value = URL.createObjectURL(file);
    }
}

function submit() {
    form.post(`/services/${props.service.id}`, {
        forceFormData: true, // tells Inertia to send as FormData
        onSuccess: () => console.log("Service updated successfully"),
        onError: (errors) => console.error("Error:", errors),
        preserveScroll: true,
    });
}
</script>

<template>
    <div class="p-6 max-w-3xl mx-auto bg-[#E5F3F3] rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-[#2C3E50] mb-6">Edit Service</h1>

        <form @submit.prevent="submit" class="space-y-5">
            <!-- Name -->
            <div>
                <label class="block text-[#2C3E50] font-semibold mb-2"
                    >Service Name</label
                >
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full border border-[#A4D6E1] rounded-lg p-2 bg-white"
                />
                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                    {{ form.errors.name }}
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-[#2C3E50] font-semibold mb-2"
                    >Description</label
                >
                <textarea
                    v-model="form.description"
                    rows="3"
                    class="w-full border border-[#A4D6E1] rounded-lg p-2 bg-white"
                ></textarea>
                <div
                    v-if="form.errors.description"
                    class="text-red-500 text-sm mt-1"
                >
                    {{ form.errors.description }}
                </div>
            </div>

            <!-- Price -->
            <div>
                <label class="block text-[#2C3E50] font-semibold mb-2"
                    >Price</label
                >
                <input
                    v-model="form.price"
                    type="number"
                    class="w-full border border-[#A4D6E1] rounded-lg p-2 bg-white"
                />
                <div v-if="form.errors.price" class="text-red-500 text-sm mt-1">
                    {{ form.errors.price }}
                </div>
            </div>

            <!-- Photo Upload -->
            <div>
                <label class="block text-[#2C3E50] font-semibold mb-2"
                    >Service Photo</label
                >
                <input
                    type="file"
                    @change="handlePhotoUpload"
                    class="w-full border border-[#A4D6E1] rounded-lg p-2 bg-white"
                />
                <div v-if="preview" class="mt-3">
                    <img
                        :src="preview"
                        alt="Preview"
                        class="w-32 h-32 object-cover rounded-lg border border-[#A4D6E1]"
                    />
                </div>
                <div v-if="form.errors.photo" class="text-red-500 text-sm mt-1">
                    {{ form.errors.photo }}
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between items-center">
                <Link href="/services" class="text-[#2C3E50] hover:underline">
                    ← Back to Services
                </Link>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-4 py-2 bg-[#4E8C8C] text-white rounded-lg hover:bg-[#3E7777] disabled:opacity-50"
                >
                    {{ form.processing ? "Saving..." : "Update Service" }}
                </button>
            </div>
        </form>
    </div>
</template>
