<template>
    <section class="py-24 bg-[#E5F3F3]/60">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
            <!-- HEADER -->
            <div class="text-center mb-16 opacity-0 animation-fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-[#2C3E50]">
                    What Our Patients Say
                </h2>
                <p class="text-[#2C3E50]/70 mt-3 text-lg max-w-2xl mx-auto">
                    Real experiences from real patients — your comfort and smile
                    are always our priority.
                </p>
                <div
                    class="mt-4 mx-auto h-1 w-20 rounded-full bg-gradient-to-r from-[#4E8C8C] to-[#A4D6E1]"
                ></div>
            </div>

            <!-- TESTIMONIAL GRID -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- CARD -->
                <div
                    class="bg-white p-7 rounded-2xl shadow-md hover:shadow-xl transition-all border border-[#A4D6E1]/30 opacity-0 animation-slide-up"
                >
                    <p class="text-[#2C3E50]/80 text-sm leading-relaxed">
                        “Very professional and gentle experience. The dentist
                        explained every step and made me feel completely
                        comfortable.”
                    </p>

                    <div class="mt-6 flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full overflow-hidden">
                            <img
                                src="/images/user1.jpg"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div>
                            <h4 class="text-[#2C3E50] font-semibold text-sm">
                                Selam T.
                            </h4>
                            <p class="text-[#2C3E50]/60 text-xs">
                                Teeth Cleaning
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white p-7 rounded-2xl shadow-md hover:shadow-xl transition-all border border-[#A4D6E1]/30 opacity-0 animation-slide-up"
                >
                    <p class="text-[#2C3E50]/80 text-sm leading-relaxed">
                        “I had a great experience! The clinic is clean, modern,
                        and welcoming. Highly recommended for anyone with dental
                        anxiety.”
                    </p>

                    <div class="mt-6 flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full overflow-hidden">
                            <img
                                src="/images/user2.jpg"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div>
                            <h4 class="text-[#2C3E50] font-semibold text-sm">
                                Miki A.
                            </h4>
                            <p class="text-[#2C3E50]/60 text-xs">Root Canal</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white p-7 rounded-2xl shadow-md hover:shadow-xl transition-all border border-[#A4D6E1]/30 opacity-0 animation-slide-up"
                >
                    <p class="text-[#2C3E50]/80 text-sm leading-relaxed">
                        “Excellent service and friendly staff. The doctor gave
                        me a perfect whitening result. I love my smile now!”
                    </p>

                    <div class="mt-6 flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full overflow-hidden">
                            <img
                                src="/images/user3.jpg"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div>
                            <h4 class="text-[#2C3E50] font-semibold text-sm">
                                Hanna D.
                            </h4>
                            <p class="text-[#2C3E50]/60 text-xs">Whitening</p>
                        </div>
                    </div>
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
    animation: slideUp 0.8s ease forwards;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(25px);
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
