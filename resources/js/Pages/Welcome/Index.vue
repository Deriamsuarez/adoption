<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ChevronRightIcon } from "@heroicons/vue/20/solid";
import Hero from "./templates/Hero.vue";
import Information from "./templates/Information.vue";
import Gallery from "./templates/Gallery.vue";
import Statistics from "./templates/Statistics.vue";
import HelpSupport from "./templates/HelpSupport.vue";
import Carousel from "./templates/Carousel.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },

    photos: Array


});

</script>

<template>
<GuestLayout>
    <Hero />
    <Information />
    <Gallery />
    <Statistics />
  
    <Carousel :photos="photos" />
    <HelpSupport />
</GuestLayout>
</template>
