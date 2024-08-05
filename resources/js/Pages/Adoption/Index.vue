<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Filter from "./templates/Filter.vue";
import Card from "./components/Card.vue";

const props = defineProps({
    pets: {
        type: Array,
    },
    filters: Object,
});

</script>

<template>
    <div class="h-screen overflow-hidden">
        <Filter :filters="filters">
            <div
            class="overflow-y-auto max-h-[65vh] md:max-h-[70vh] grid sm:grid-cols-2 md:grid-cols-3 gap-4"
            >
            <Card v-for="(pet, index) in pets" :key="pet.id" :pet="pet" />
        </div>
    </Filter>
</div>
</template>
