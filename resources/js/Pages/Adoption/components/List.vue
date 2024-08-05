<script setup>
defineProps({
    pet: Object,
});
</script>

<template>
    <ul class="pb-4 " role="list">
        <li class="flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]"> bolt </span>
            Nivel de Energía:
            {{
                pet.energy_level === "Low"
                    ? "Bajo"
                    : pet.energy_level === "Medium"
                    ? "Medio"
                    : pet.energy_level === "High"
                    ? "Alto"
                    : ""
            }}
        </li>
        <li class="flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]"> height </span>
            Tamaño actual:
            {{
                pet.current_size === "Small"
                    ? "Pequeño"
                    : pet.current_size == "Medium"
                    ? "Mediano"
                    : pet.current_size == "Large"
                    ? "Grande"
                    : ""
            }}
        </li>
        <li class="flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">
                model_training
            </span>
            Nivel de entrenamiento:
            {{
                pet.training_level === "Basic"
                    ? "Básico"
                    : pet.training_level === "Intermediate"
                    ? "Intermedio"
                    : pet.training_level === "Advanced"
                    ? "Avanzado"
                    : ""
            }}
        </li>
        <li class="flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">
                dermatology
            </span>
            Pelaje:
            {{
                pet.coat === "Short"
                    ? "Corto"
                    : pet.coat === "Medium"
                    ? "Medio"
                    : pet.coat === "Long"
                    ? "Largo"
                    : pet.coat === "Curly"
                    ? "Rizado"
                    : pet.coat === "Hairless"
                    ? "Sin pelo"
                    : ""
            }}
        </li>
        <li class="flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">
                device_thermostat
            </span>
            Temperamento:
            {{
                pet.temperament === "Passive"
                    ? "Pasivo"
                    : pet.temperament === "Calm"
                    ? "Calmado"
                    : pet.temperament === "Aggressive"
                    ? "Agresivo"
                    : pet.temperament === "Friendly"
                    ? "Amistoso"
                    : pet.temperament === "Playful"
                    ? "Juguetón"
                    : pet.temperament === "Shy"
                    ? "Tímido"
                    : ""
            }}
        </li>
        <li class="flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]"> pill </span>
            Desparacitado:
            <span
                class="material-symbols-outlined text-sm"
                :class="pet.dewormed ? 'text-green-500' : 'text-red-500'"
            >
                {{ pet.dewormed ? "check_circle" : "cancel" }}
            </span>
        </li>
        <li class="flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">
                vaccines
            </span>
            Vacunado:
            <span
                class="material-symbols-outlined text-sm"
                :class="pet.vaccinated ? 'text-green-500' : 'text-red-500'"
            >
                {{ pet.vaccinated ? "check_circle" : "cancel" }}
            </span>
        </li>
        <li class="flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">
                medication
            </span>
            Castrado:
            <span
                class="material-symbols-outlined text-sm"
                :class="pet.neutered ? 'text-green-500' : 'text-red-500'"
            >
                {{ pet.neutered ? "check_circle" : "cancel" }}
            </span>
        </li>
    </ul>
</template>
