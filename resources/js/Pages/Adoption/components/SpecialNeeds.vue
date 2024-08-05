<script setup>
defineProps({
    pet: Object
})
</script>

<template>
<div class="pb-4" v-if="pet.special_needs_notes" v-html="pet.special_needs_notes">

</div>
<div class="pb-4 text-gray-500"  v-else>No tiene necesidades especiales</div>

</template>