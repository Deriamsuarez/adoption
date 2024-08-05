<template>
  <div class="flex flex-col">
    <label :for="filterId">{{ label }}</label>
    <select class="rounded-md" :id="filterId" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
      <option value="">All</option>
      <option v-for="option in options" :key="optionValue(option)" :value="optionValue(option)">
        {{ optionLabel(option) }}
      </option>
    </select>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  label: String,
  filterId: String,
  options: Array,
  modelValue: String
});

const emits = defineEmits(['update:modelValue']);

const optionValue = (option) => (typeof option === 'object' ? option.slug : option);
const optionLabel = (option) => (typeof option === 'object' ? option.name : option);
</script>
