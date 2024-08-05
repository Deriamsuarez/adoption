<script setup>
import { useKeenSlider } from "keen-slider/vue.es"
import nena_sweet from "@/../img/nena_sweet.jpg"

const animation = { duration: 50000, easing: (t) => t }

const props = defineProps({
  photos: Array
})

console.log(props.photos);

    const [container] = useKeenSlider({
      slides: {
        perView:4
      },
      loop: true,
      renderMode: "performance",
      drag: false,
      created(s) {
        s.moveToIdx(5, true, animation)
      },
      updated(s) {
        s.moveToIdx(s.track.details.abs + 5, true, animation)
      },
      animationEnded(s) {
        s.moveToIdx(s.track.details.abs + 5, true, animation)
      },
    })

</script>

<template>
  <div class="pb-6">  

    <div class=" px-6 lg:px-8">
      <div class="mx-auto max-w-2xl text-center">
        <p class="text-base font-semibold leading-7 text-indigo-600 font-primary">Centro de Adopción</p>
        <h2 class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Adopta un Amigo</h2>
        <p class="mt-2 text-lg leading-8 text-gray-600">Agregar un nuevo miembro peludo a la familia no solo trae alegría y amor, sino que también salva vidas. Estas mascotas están esperando una segunda oportunidad para llenar tu hogar de cariño.</p>
      </div>
    </div>

    <div ref="container" class="keen-slider py-12">
      <div v-for="(photo, index) in photos" :key="photo.photo" class="keen-slider__slide number-slide1">
      <img :src="`/storage/${photo.photo}`" alt="" srcset="" class="h-96 w-full object-cover object-center">
    </div>

  </div>
  </div>
  </template>
  