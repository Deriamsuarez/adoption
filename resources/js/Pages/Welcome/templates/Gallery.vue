<script setup>
import nena_sweet from '@/../img/nena_sweet.jpg';
import nena_love from '@/../img/nena_love.jpg';
import nena_angry from '@/../img/nena_angry.jpg';
import nena_hero from '@/../img/nena_hero.jpg';
import nena_profile from '@/../img/nena_profile.jpg';
</script>

<template>
      <div class="mt-16">
        <div class="mx-auto container px-6 lg:px-8">
          <div class="mx-auto max-w-2xl sm:text-center">
          <h2 class="text-base font-semibold leading-7 text-indigo-600 font-primary ">un nuevo comienzo</h2>
<p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Adopta, No Compres</p>
<p class="mt-6 text-lg leading-8 text-gray-600">Brinda una segunda oportunidad a mascotas en situación vulnerable. Con tu apoyo, podemos encontrar hogares amorosos para estos animales necesitados.</p>

          </div>
        </div>
        <div class="pt-8">
          <div class="mx-auto container grid grid-cols-3 gap-4 px-6 lg:px-8">
    <!-- Imagen vertical grande -->
    <div class="flex flex-col">
      <img :src="nena_love" alt="App screenshot" class="h-full max-h-[460px] object-cover object-center rounded-xl ring-1 ring-gray-900/10"/>
    </div>

    <!-- Dos imágenes pequeñas en el medio -->
    <div class="flex flex-col gap-4">
      <img :src="nena_hero" alt="App screenshot" class="h-1/2 max-h-[222px] object-cover object-center rounded-xl ring-1 ring-gray-900/10"/>
      <img :src="nena_profile" alt="App screenshot" class="h-1/2 max-h-[222px] object-cover object-center rounded-xl ring-1 ring-gray-900/10"/>
    </div>

    <!-- Imagen vertical grande -->
    <div class="flex flex-col">
      <img :src="nena_angry" alt="App screenshot" class="h-full max-h-[460px] object-cover object-center rounded-xl ring-1 ring-gray-900/10"/>
    </div>
  </div>
        </div>
       
      </div>
</template>