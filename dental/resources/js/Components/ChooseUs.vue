<template>
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <!-- HEADER -->
            <div class="text-center mb-16 opacity-0 animation-fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-[#2C3E50]">
                    Why Choose Our Clinic?
                </h2>
                <p class="text-[#2C3E50]/70 mt-3 text-lg max-w-2xl mx-auto">
                    Your smile deserves advanced care, comfort, and a clinic
                    that truly listens.
                </p>

                <div
                    class="mt-4 mx-auto h-1 w-20 rounded-full bg-gradient-to-r from-[#4E8C8C] to-[#A4D6E1]"
                ></div>
            </div>

            <!-- FEATURES GRID -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Feature Item -->
                <div
                    class="p-6 bg-[#E5F3F3]/50 rounded-2xl shadow-md hover:shadow-xl transition-all opacity-0 animation-slide-up"
                >
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-xl bg-[#4E8C8C]/10 text-[#4E8C8C] text-3xl font-bold"
                    >
                        🦷
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-[#2C3E50]">
                        Modern Technology
                    </h3>
                    <p class="text-[#2C3E50]/70 mt-2 text-sm leading-relaxed">
                        We use the latest tools for precise, gentle, and fast
                        dental procedures.
                    </p>
                </div>

                <div
                    class="p-6 bg-[#E5F3F3]/50 rounded-2xl shadow-md hover:shadow-xl transition-all opacity-0 animation-slide-up"
                >
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-xl bg-[#4E8C8C]/10 text-[#4E8C8C] text-3xl font-bold"
                    >
                        😊
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-[#2C3E50]">
                        Friendly Staff
                    </h3>
                    <p class="text-[#2C3E50]/70 mt-2 text-sm leading-relaxed">
                        Experienced dentists and caring professionals focused on
                        patient comfort.
                    </p>
                </div>

                <div
                    class="p-6 bg-[#E5F3F3]/50 rounded-2xl shadow-md hover:shadow-xl transition-all opacity-0 animation-slide-up"
                >
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-xl bg-[#4E8C8C]/10 text-[#4E8C8C] text-3xl font-bold"
                    >
                        ⏱️
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-[#2C3E50]">
                        Quick Appointments
                    </h3>
                    <p class="text-[#2C3E50]/70 mt-2 text-sm leading-relaxed">
                        Easy scheduling with minimal waiting time and smooth
                        service.
                    </p>
                </div>

                <div
                    class="p-6 bg-[#E5F3F3]/50 rounded-2xl shadow-md hover:shadow-xl transition-all opacity-0 animation-slide-up"
                >
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-xl bg-[#4E8C8C]/10 text-[#4E8C8C] text-3xl font-bold"
                    >
                        👨‍⚕️
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-[#2C3E50]">
                        Expert Dentists
                    </h3>
                    <p class="text-[#2C3E50]/70 mt-2 text-sm leading-relaxed">
                        A team of skilled professionals with years of
                        experience.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup></script>

<style scoped>
.animation-fade-up {
    animation: fadeUp 1s ease forwards;
}
.animation-slide-up {
    animation: slideUp 0.85s ease forwards;
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
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
