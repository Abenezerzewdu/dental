<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
const props = defineProps({
    appointment: Object,
    services: Array,
});

const form = useForm({
    service_id: props.appointment.service_id,
    appointment_time: props.appointment.appointment_time,
    notes: props.appointment.notes,
});

function submit() {
    form.put(`/appointments/${props.appointment.id}`);
}

const roles = computed(() => page.props.auth.user?.roles || []);
const isAdmin = computed(() => roles.value.includes("admin"));
const isReception = computed(() => roles.value.includes("reception"));
</script>

<template>
    <AdminLayout>
        <div class="p-6 max-w-xl mx-auto">
            <h1 class="text-2xl font-bold mb-4">Edit Appointment</h1>

            <form @submit.prevent="submit" class="space-y-4">
                <!-- same fields as Create.vue -->
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
                <!-- ... -->
                <div>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                    >
                        Save Changes
                    </button>
                    <Link
                        href="/appointment"
                        class="text-gray-500 hover:underline ml-4"
                    >
                        Back
                    </Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
