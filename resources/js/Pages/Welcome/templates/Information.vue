<script setup>
import { ref } from 'vue';
import nena from '@/../img/nena_love.jpg';
import { ChevronRightIcon } from '@heroicons/vue/24/outline';

const currentSection = ref('queHacemos');

const sections = {
  queHacemos: {
    title: '¿Qué Hacemos?',
    description: 'Conectamos a mascotas en situación vulnerable con voluntarios dispuestos a darles una segunda oportunidad.',
    buttonText: '¿Qué Hacemos?',
  },
  comoHacemos: {
    title: '¿Cómo lo Hacemos?',
    description: 'Trabajamos en conjunto con refugios y organizaciones para brindar a las mascotas un hogar seguro.',
    buttonText: '¿Cómo lo Hacemos?',
  },
};

const setSection = (section) => {
  currentSection.value = section;
};
</script>

<template>
  <div class="relative isolate overflow-hidden bg-gray-900 lg:max-h-screen">
    <svg
      class="absolute inset-0 -z-10 h-full w-full stroke-white/10 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]"
      aria-hidden="true"
    >
      <defs>
        <pattern
          id="983e3e4c-de6d-4c3f-8d64-b9761d1534cc"
          width="200"
          height="200"
          x="50%"
          y="-1"
          patternUnits="userSpaceOnUse"
        >
          <path d="M.5 200V.5H200" fill="none" />
        </pattern>
      </defs>
      <svg x="50%" y="-1" class="overflow-visible fill-gray-800/20">
        <path
          d="M-200 0h201v201h-201Z M600 0h201v201h-201Z M-400 600h201v201h-201Z M200 800h201v201h-201Z"
          stroke-width="0"
        />
      </svg>
      <rect
        width="100%"
        height="100%"
        stroke-width="0"
        fill="url(#983e3e4c-de6d-4c3f-8d64-b9761d1534cc)"
      />
    </svg>
    <div
      class="absolute left-[calc(50%-4rem)] top-10 -z-10 transform-gpu blur-3xl sm:left-[calc(50%-18rem)] lg:left-48 lg:top-[calc(50%-30rem)] xl:left-[calc(50%-24rem)]"
      aria-hidden="true"
    >
      <div
        class="aspect-[1108/632] w-[69.25rem] bg-gradient-to-r from-[#80caff] to-[#4f46e5] opacity-20"
        style="
          clip-path: polygon(
            73.6% 51.7%,
            91.7% 11.8%,
            100% 46.4%,
            97.4% 82.2%,
            92.5% 84.9%,
            75.7% 64%,
            55.3% 47.5%,
            46.5% 49.4%,
            45% 62.9%,
            50.3% 87.2%,
            21.3% 64.1%,
            0.1% 100%,
            5.4% 51.1%,
            21.4% 63.9%,
            58.9% 0.2%,
            73.6% 51.7%
          );
        "
      />
    </div>
    <div class="mx-auto max-w-7xl px-6 lg:flex lg:px-8 py-16">
      <div class="mx-auto max-w-2xl flex-shrink-0 lg:mx-0 lg:max-w-xl lg:pt-8">
        <img
          class="h-11"
          src="https://tailwindui.com/img/logos/mark.svg?color=indigo&amp;shade=500"
          alt="Your Company"
        />
        <div class="mt-24 sm:mt-32 lg:mt-16">
          <div class="inline-flex space-x-6">
            <button
              @click="setSection('queHacemos')"
              :class="currentSection === 'queHacemos' ? 'bg-indigo-500/10 text-indigo-400 ring-1 ring-inset ring-indigo-500/20' : 'text-gray-300'"
              class="rounded-full px-3 py-1 text-sm font-semibold leading-6"
            >
              ¿Qué Hacemos?
            </button>
            <button
              @click="setSection('comoHacemos')"
              :class="currentSection === 'comoHacemos' ? 'bg-indigo-500/10 text-indigo-400 ring-1 ring-inset ring-indigo-500/20' : 'text-gray-300'"
              class="rounded-full px-3 py-1 text-sm font-semibold leading-6"
            >
              ¿Cómo lo hacemos ?
              <ChevronRightIcon class="h-5 w-5 text-gray-500" aria-hidden="true" />
            </button>
          </div>
        </div>
        <h1 class="mt-10 text-4xl font-bold tracking-tight text-white sm:text-5xl">
          {{ sections[currentSection].title }}
        </h1>
        <p class="mt-6 text-lg leading-8 text-gray-300">
          {{ sections[currentSection].description }}
        </p>
        <div class="mt-10 flex items-center gap-x-6">
          <a
            href="#"
            class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400"
          >
            Adoptar
          </a>
          <a href="#" class="text-sm font-semibold leading-6 text-white">
           Hacer donación <span aria-hidden="true">→</span>
          </a>
        </div>
      </div>
      <div class="mx-auto mt-16 flex max-w-2xl sm:mt-24 lg:ml-10 lg:mr-0 lg:mt-0 lg:max-w-none lg:flex-none xl:ml-32">
        <div class="max-w-3xl flex-none sm:max-w-5xl lg:max-w-none">
          <img
            :src="nena"
            alt="App screenshot"
            class="w-[24rem] md:w-[36rem] rounded-md bg-white/5 shadow-2xl ring-1 ring-white/10 mix-blend-overlay"
          />
        </div>
      </div>
    </div>
  </div>
</template>
