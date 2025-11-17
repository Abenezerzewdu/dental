<template>
    <section id="services" class="py-24 bg-[#E5F3F3]/50">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <!-- HEADER -->
            <div class="text-center mb-16 opacity-0 animation-fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-[#2C3E50]">
                    Our Popular Services
                </h2>
                <p class="text-[#2C3E50]/70 mt-3 text-lg max-w-2xl mx-auto">
                    High-quality dental treatments delivered with comfort, care,
                    and modern technology.
                </p>

                <!-- Underline Accent -->
                <div
                    class="mt-4 mx-auto h-1 w-20 rounded-full bg-gradient-to-r from-[#4E8C8C] to-[#A4D6E1]"
                ></div>
            </div>

            <!-- SERVICES GRID -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
                <div
                    v-for="service in services"
                    :key="service.id"
                    class="group p-6 bg-white rounded-2xl shadow-md hover:shadow-xl border border-[#A4D6E1]/30 transition-all duration-300 opacity-0 animation-slide-up"
                >
                    <!-- IMAGE -->
                    <div class="w-full h-48 rounded-xl overflow-hidden mb-5">
                        <img
                            :src="`/storage/${service.photo}`"
                            :alt="service.name"
                            class="w-full h-full object-cover group-hover:scale-[1.05] transition duration-300"
                        />
                    </div>

                    <!-- TITLE -->
                    <h3
                        class="text-xl font-semibold text-[#2C3E50] group-hover:text-[#4E8C8C] transition"
                    >
                        {{ service.name }}
                    </h3>

                    <!-- DESCRIPTION -->
                    <p class="text-[#2C3E50]/70 mt-2 text-sm leading-relaxed">
                        {{ service.description }}
                    </p>

                    <!-- LEARN MORE -->
                    <!-- <button
                        class="mt-5 inline-flex items-center gap-1 text-[#4E8C8C] font-medium group-hover:underline transition"
                    >
                        Learn More
                        <span class="group-hover:translate-x-1 transition"
                            >→</span
                        >
                    </button> -->
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
defineProps({
    services: {
        type: Array,
        required: true,
    },
});
</script>

<style scoped>
/* Fade-up animation */
.animation-fade-up {
    animation: fadeUp 1s ease forwards;
    animation-delay: 0.2s;
}

/* Slide-up animation for cards */
.animation-slide-up {
    animation: slideUp 0.9s ease forwards;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
