<template>
    <NavBar />
    <Hero />
    <PopularServices :services="services" />
    <ChooseUs />
    <Testimonial />
    <ContactUs />
    <Footer />
</template>
<script setup>
import NavBar from "@/Components/NavBar.vue";
import Hero from "@/Components/Hero.vue";
import PopularServices from "@/Components/PopularServices.vue";
import Testimonial from "@/Components/Testimonial.vue";
import ChooseUs from "@/Components/ChooseUs.vue";
import ContactUs from "@/Components/ContactUs.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import Footer from "@/Components/Footer.vue";
const services = computed(() => usePage().props.services ?? []);
</script>
