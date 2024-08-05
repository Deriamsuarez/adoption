<script setup>
defineProps({
    pet: Object
})
</script>

<template>
<div class="pb-4" v-if="pet.medical_history" v-html="pet.medical_history">

</div>
<div class="pb-4 text-gray-500" v-else>Sin registro médico</div>

</template>