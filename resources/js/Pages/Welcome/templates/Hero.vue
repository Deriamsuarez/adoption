<script setup>
import { ref } from "vue";
import logo from "@/../img/logo.png";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import nena from '@/../img/nena_hero.jpg'

const isHovered = ref(true);

const isTryingAdopt = ref(false);

const handleMouseOver = () => {
    isHovered.value = true;
    console.log("El botón está siendo hovered");
};

const handleMouseLeave = () => {
    isHovered.value = false;
    console.log("El botón ya no está siendo hovered");
};

const handleClick = () => {
    isTryingAdopt.value = true;
};
</script>

<template>
        <div class="flex items-center isolate overflow-hidden bg-gray-900 h-screen pb-16 pt-14 sm:pb-20 ">
        <img :src="nena" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover object-top mix-blend-multiply" />
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
          <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
        </div>
        <div class="mx-auto container flex justify-center px-6 lg:px-8">
          <div class="mx-auto max-w-2xl py-16">
            <div class="hidden sm:mb-8 sm:flex sm:justify-center">
              <div class="font-primary relative rounded-full px-3 py-1 text-sm leading-6 text-gray-400 ring-1 ring-white/10 hover:ring-white/20">
                Conoces todas las formas de ayudar. <a href="#help" class="font-semibold text-white"><span class="absolute inset-0" aria-hidden="true" />Saber más <span aria-hidden="true">&rarr;</span></a>
              </div>
            </div>
            <div class="text-center max-w-lg">
              <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl leading-12">¡Adopta un amigo!</h1>
              <p class="mt-6 text-lg  text-gray-300">Adoptar una mascota es la manera más sincera de mostrar amor por ellos, ¡Hagamos la diferencia!</p>
              <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="#" class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400">Adoptar</a>
                <a href="#" class="text-sm font-semibold leading-6 text-white">Hacer donación <span aria-hidden="true">→</span></a>
              </div>
            </div>
          </div>

          <!-- Logo cloud -->
          <div class="mx-auto bottom-8 absolute  grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-10 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:mx-0 lg:max-w-none lg:grid-cols-5">
            <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/transistor-logo-white.svg" alt="Transistor" width="158" height="48" />
            <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/reform-logo-white.svg" alt="Reform" width="158" height="48" />
            <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/tuple-logo-white.svg" alt="Tuple" width="158" height="48" />
            <img class="col-span-2 max-h-12 w-full object-contain sm:col-start-2 lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/savvycal-logo-white.svg" alt="SavvyCal" width="158" height="48" />
            <img class="col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/statamic-logo-white.svg" alt="Statamic" width="158" height="48" />
          </div>
        </div>
      
      </div>
</template>
