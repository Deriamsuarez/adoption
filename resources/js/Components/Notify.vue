<script setup>

const props = defineProps({
    pet: Object,

    text: String,
    error: {
        type: Boolean,
        default: false
    }
})

</script>


<template>

<div class="flex gap-2 max-w-[300px] container">
    <img class="w-20 h-20 object-cover object-center shadow-md rounded" :src="`/storage/${pet?.photo}`" :alt="pet?.name">
    <div >
        <h3 class="font-bold"> {{!error ? '¡Formulario enviado!' : `Oops, ya solicitaste su adopción.`}}</h3>
        <p class="text-xs"> {{!error ? `Hemos notificado a los responsables de ${ pet?.name }. Pronto se pondrán en contacto contigo.` : `Notificaremos a los responsables de ${pet?.name} para que te contacten pronto.`}}</p>
    </div>
  
</div>


</template>