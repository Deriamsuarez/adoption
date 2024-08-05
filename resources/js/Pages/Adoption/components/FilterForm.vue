<template>
  <div class="space-y-2 px-2 overflow-y-auto max-h-[70vh]">
    <div class="flex flex-col" v-for="(options, filter) in filters" :key="filter">
      <label :for="filter">{{ getLabel(filter) }}</label>
      <select class="rounded-md" :id="filter" v-model="selectedFilters[filter]" @change="updateQueryString">
        <option value="">Seleccione</option>
        <option v-for="option in options" :key="option.value || option.name" :value="option.value || option.name">
          {{ option.name || option }}
        </option>
      </select>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

// Props
const props = defineProps({
  filters: Object
});

// Estado de los filtros seleccionados
const selectedFilters = useForm({
  breed_slug: '',
  type: '',
  gender: '',
  energy_level: '',
  age: '',
  current_size: '',
  adult_size: '',
  training_level: '',
  coat: '',
  province_slug: '',
  temperament: ''
});

// Función para obtener la etiqueta del filtro basado en su id
function getLabel(filterId) {
  const labels = {
    breed_slug: 'Raza',
    type: 'Tipo de mascota',
    gender: 'Género',
    energy_level: 'Nivel de energía',
    age: 'Edad',
    current_size: 'Tamaño actual',
    adult_size: 'Tamaño adulto',
    training_level: 'Nivel de entrenamiento',
    coat: 'Pelaje',
    province_slug: 'Provincia',
    temperament: 'Temperamento'
  };
  return labels[filterId] || 'Seleccione';
}

// Función para actualizar la cadena de consulta
function updateQueryString() {
  const queryString = new URLSearchParams(selectedFilters.value).toString();
  window.history.replaceState({}, '', `?${queryString}`);
  
  // Envía la solicitud al backend
  // Inertia.get(`/pets?${queryString}`);
}

// Observa cambios en `selectedFilters` y actualiza la URL
watch(selectedFilters, () => {
  updateQueryString();
}, { deep: true });
</script>