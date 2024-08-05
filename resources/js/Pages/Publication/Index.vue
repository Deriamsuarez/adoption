<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Card from "./components/Card.vue";
import Form from "./components/Form.vue";
import { PlusCircleIcon } from "@heroicons/vue/24/outline";
import { ref } from "vue";

const props = defineProps({
    pets: Array,
    provinces: Array,
    breeds: Array,
});

const openModal = ref(false);

const handleCreate = () => {
    openModal.value= true
};

const handleClose = () => {
    openModal.value = false
}
</script>
<template>
    <AppLayout
        title="Publicaciones"
        :action="handleCreate"
        textButton="Publicar"
    >
        <div
            v-if="pets.length"
            class="grid md:grid-cols-2 lg:grid-cols-3 gap-4"
        >
            <Card v-for="(pet, index) in pets" :key="pet.id" :pet="pet" />
        </div>
        <div
            v-else
            class="border-2 border-dashed rounded-md h-[420px] flex items-center justify-center"
        >
            <div
                class="flex flex-col justify-between items-center text-gray-500"
            >
                <span class="material-symbols-outlined text-4xl">
                    sound_detection_dog_barking
                </span>
                <p class="text-xs max-w-[160px]">
                    Aún no se ha publicado una mascota para su adopción
                </p>
            </div>
        </div>

        <Form :handleClose="handleClose" :open="openModal" :provinces="provinces" :breeds="breeds" />
    </AppLayout>
</template>
