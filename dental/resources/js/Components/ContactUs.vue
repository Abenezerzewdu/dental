<template>
    <section id="contact" class="py-24 bg-white">
        <div
            class="max-w-7xl mx-auto px-6 md:px-10 grid md:grid-cols-2 gap-12 items-center"
        >
            <!-- LEFT: Contact Info -->
            <div class="space-y-6">
                <h2 class="text-3xl md:text-4xl font-bold text-[#2C3E50]">
                    Get in Touch
                </h2>
                <p class="text-[#2C3E50]/70 text-lg">
                    Have questions or need an appointment? Reach out and our
                    friendly team will assist you.
                </p>

                <div class="space-y-4 mt-6 text-[#2C3E50]">
                    <div class="flex items-center gap-3">
                        <span class="text-[#4E8C8C] text-xl">📍</span>
                        <span>123 Smile Street, Addis Ababa, Ethiopia</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-[#4E8C8C] text-xl">📞</span>
                        <span>+251 941031450</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-[#4E8C8C] text-xl">✉️</span>
                        <span>info@dentalclinic.com</span>
                    </div>
                </div>

                <button
                    class="mt-6 bg-[#4E8C8C] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[#3f7575] transition"
                >
                    Contact Us
                </button>
            </div>

            <!-- RIGHT: Optional Map / Image -->
            <div
                class="w-full h-64 md:h-full rounded-2xl overflow-hidden shadow-lg"
            >
                <iframe
                    class="w-full h-full"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.123456789!2d38.75!3d9.03!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x123456789abcdef!2sYour%20Clinic!5e0!3m2!1sen!2set!4v1234567890"
                    loading="lazy"
                ></iframe>
            </div>
        </div>
    </section>
</template>
