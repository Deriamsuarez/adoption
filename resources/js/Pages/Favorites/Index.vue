<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Card from "./components/Card.vue";

const props = defineProps({
    favorites: Array,
});

console.log(props.favorites);
</script>

<template>
    <AppLayout title="Favoritos">
        <div v-if="favorites.length" class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
           <Card v-for="(favorite, index) in favorites" :key="favorite.id" :pet="favorite.pet" />
        </div>
        <div
            v-else
            class="border-2 border-dashed rounded-md h-[420px] flex items-center justify-center">
            <div class="flex flex-col justify-between items-center text-gray-500">
                <span class="material-symbols-outlined text-4xl">
                    sound_detection_dog_barking
                </span>
                <p class="text-xs text-center max-w-[180px]">
                    Aún no haz marcado ninguna mascota como favorita
                </p>
            </div>
        </div>
    </AppLayout>
</template>
