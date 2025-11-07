<script setup>
import { ref, reactive } from "vue";
import { router } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
const { props } = usePage();
const services = props.services || [];

// Step tracking
const step = ref(1);

// Form data
const form = reactive({
    name: "",
    email: "",
    phone: "",
    appointment_time: "",
    service_id: "",
    notes: "",
});

// Error handling
const errors = reactive({});

const nextStep = () => {
    if (!form.name || !form.email || !form.phone) {
        errors.step1 = "Please fill in all required fields before proceeding.";
        return;
    }
    errors.step1 = "";
    step.value++;
};

const prevStep = () => step.value--;

const submitForm = () => {
    router.post("/appointments/guest", form, {
        onSuccess: () => {
            alert("🎉 Your appointment has been successfully booked!");
            router.visit("/appointments");
            step.value = 1;
            Object.keys(form).forEach((k) => (form[k] = ""));
        },
        onError: () => {
            errors.backend = "Oops! Something went wrong. Please try again.";
        },
    });
};
</script>

<template>
    <admin-layout>
        <div
            class="max-w-lg mx-auto p-6 bg-[#E5F3F3] shadow-xl rounded-2xl mt-12 border border-[#A4D6E1]"
        >
            <h2 class="text-3xl font-bold text-center text-[#2C3E50] mb-6">
                Book Your Appointment
            </h2>

            <!-- Step indicator -->
            <div class="flex justify-center mb-8">
                <div class="flex items-center gap-3">
                    <span
                        :class="[
                            'w-8 h-8 flex items-center justify-center rounded-full text-white font-semibold transition',
                            step === 1 ? 'bg-[#4E8C8C]' : 'bg-[#A4D6E1]',
                        ]"
                        >1</span
                    >
                    <div
                        class="w-12 h-[2px] transition"
                        :class="step > 1 ? 'bg-[#4E8C8C]' : 'bg-[#A4D6E1]'"
                    ></div>
                    <span
                        :class="[
                            'w-8 h-8 flex items-center justify-center rounded-full text-white font-semibold transition',
                            step === 2 ? 'bg-[#4E8C8C]' : 'bg-[#A4D6E1]',
                        ]"
                        >2</span
                    >
                </div>
            </div>

            <!-- Step 1 -->
            <div v-if="step === 1" class="space-y-4">
                <input
                    v-model="form.name"
                    type="text"
                    placeholder="Full Name"
                    class="input-field"
                />
                <input
                    v-model="form.email"
                    type="email"
                    placeholder="Email Address"
                    class="input-field"
                />
                <input
                    v-model="form.phone"
                    type="text"
                    placeholder="Phone Number"
                    class="input-field"
                />

                <p v-if="errors.step1" class="text-red-500 text-sm text-center">
                    {{ errors.step1 }}
                </p>

                <div class="flex justify-end">
                    <button @click="nextStep" class="btn-primary">Next</button>
                </div>
            </div>

            <!-- Step 2 -->
            <div v-if="step === 2" class="space-y-4">
                <label class="block font-medium text-[#2C3E50]"
                    >Appointment Date</label
                >
                <input
                    v-model="form.appointment_time"
                    type="date"
                    class="input-field"
                />

                <label class="block font-medium text-[#2C3E50]"
                    >Select Service</label
                >
                <select
                    v-model="form.service_id"
                    class="input-field"
                    name="service_id"
                >
                    <option value="">Select a Service</option>
                    <option
                        v-for="service in services"
                        :key="service.id"
                        :value="service.id"
                    >
                        {{ service.name }}
                    </option>

                    <option value="Other">Other</option>
                </select>

                <div v-if="form.service === 'Other'" class="space-y-2">
                    <label class="block font-medium text-[#2C3E50]">
                        Describe Your Request
                    </label>
                    <input
                        v-model="form.notes"
                        placeholder="Describe your special case..."
                        class="input-field"
                    />
                </div>

                <p
                    v-if="errors.backend"
                    class="text-red-500 text-sm text-center"
                >
                    {{ errors.backend }}
                </p>

                <div class="flex justify-between mt-6">
                    <button @click="prevStep" class="btn-secondary">
                        Back
                    </button>
                    <button @click="submitForm" class="btn-primary">
                        Confirm Booking
                    </button>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<style scoped>
.input-field {
    @apply w-full border border-[#A4D6E1] rounded-lg p-2 focus:ring-2 focus:ring-[#4E8C8C] focus:outline-none bg-white text-[#2C3E50];
}

.btn-primary {
    @apply bg-[#4E8C8C] text-white px-5 py-2 rounded-lg font-medium hover:bg-[#2C3E50] transition;
}

.btn-secondary {
    @apply bg-[#A4D6E1] text-[#2C3E50] px-5 py-2 rounded-lg font-medium hover:bg-[#4E8C8C] hover:text-white transition;
}
</style>
