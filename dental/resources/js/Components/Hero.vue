<template>
    <section class="w-full bg-gradient-to-br from-[#E5F3F3] to-[#A4D6E1]/40">
        <div
            class="max-w-7xl mx-auto px-6 md:px-10 py-16 md:py-24 grid md:grid-cols-2 gap-10 items-center"
        >
            <!-- LEFT TEXT SECTION -->
            <div class="space-y-6 opacity-0 translate-y-6 animation-fade-up">
                <h1
                    class="text-4xl md:text-5xl font-bold text-[#1f2f3a] leading-tight"
                >
                    Modern Dental Care for a <br class="hidden md:block" />
                    Healthier, Brighter Smile
                </h1>

                <p class="text-lg text-[#1f2f3a]/80">
                    Safe, gentle, and technology-driven treatments for every age
                    — providing comfort, precision, and confidence from start to
                    finish.
                </p>

                <!-- BENEFITS -->
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-[#1f2f3a]">
                        <span class="w-2 h-2 bg-[#4E8C8C] rounded-full"></span>
                        Advanced Digital Dentistry
                    </div>
                    <div class="flex items-center gap-2 text-[#1f2f3a]">
                        <span class="w-2 h-2 bg-[#4E8C8C] rounded-full"></span>
                        Caring & Experienced Dentists
                    </div>
                    <div class="flex items-center gap-2 text-[#1f2f3a]">
                        <span class="w-2 h-2 bg-[#4E8C8C] rounded-full"></span>
                        Comfortable, Patient-Focused Clinic
                    </div>
                </div>

                <!-- CTA BUTTONS -->
                <div class="flex flex-wrap gap-4 pt-2">
                    <Link
                        href="/appointment/create"
                        class="bg-[#4E8C8C] text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:bg-[#3f7575] transition"
                    >
                        Book Appointment
                    </Link>

                    <Link
                        href="#services"
                        class="border border-[#4E8C8C] text-[#4E8C8C] px-6 py-3 rounded-xl font-medium hover:bg-[#e2f4f4] transition"
                    >
                        View Services
                    </Link>
                </div>
            </div>

            <!-- RIGHT IMAGE WITH FLOATING ANIMATION -->
            <div
                class="flex justify-center md:justify-end opacity-0 translate-x-6 animation-slide-right"
            >
                <div
                    class="w-[85%] md:w-[90%] rounded-2xl overflow-hidden shadow-2xl border border-white animate-float-slow"
                >
                    <img
                        src="/images/dentist.png"
                        alt="Dental Care"
                        class="w-full h-full object-cover"
                    />
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<style scoped>
/* Fade-up animation */
.animation-fade-up {
    animation: fadeUp 1s ease forwards;
    animation-delay: 0.2s;
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

/* Slide-right animation */
.animation-slide-right {
    animation: slideRight 1s ease forwards;
    animation-delay: 0.4s;
}

@keyframes slideRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Floating animation for image */
@keyframes floatSlow {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-12px);
    }
    100% {
        transform: translateY(0px);
    }
}

.animate-float-slow {
    animation: floatSlow 6s ease-in-out infinite;
}
</style>
