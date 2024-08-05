<template>
    <header class=" backdrop-blur-md fixed w-full z-50"
    :class="fullColor ? 'bg-black/50' : 'bg-gray-50/90'"
    >
      <nav class="mx-auto flex container items-center justify-between p-4 " :class="!fullColor && 'border-b' " aria-label="Global">
        <Link href="/" class="">
          <span class="sr-only">Your Company</span>
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
        </Link>
        <div class="flex lg:hidden">
          <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white" @click="mobileMenuOpen = true">
            <span class="sr-only">Open main menu</span>
            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
          </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12" :class="fullColor ? 'text-white' : 'text-blue-900'">
          <Link :href="route(item.href)" v-for="item in navigation" :key="item.name" class="text-sm font-semibold leading-6 ">{{ item.name }}</Link>
          <Link :href="route('login')" class="text-sm font-semibold leading-6">Log in <span aria-hidden="true">&rarr;</span></Link>
        </div>
      </nav>
      <Dialog class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
        <div class="fixed inset-0 z-10" />
        <DialogPanel class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
          <div class="flex items-center justify-between">
            <a href="#" class="-m-1.5 p-1.5">
              <span class="sr-only">Your Company</span>
              <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
            </a>
            <button type="button" class="-m-2.5 rounded-md p-2.5 text-white" @click="mobileMenuOpen = false">
              <span class="sr-only">Close menu</span>
              <XMarkIcon class="h-6 w-6" aria-hidden="true" />
            </button>
          </div>
          <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-500/10">
              <div class="space-y-2 py-6">
                <a v-for="item in navigation" :key="item.name" :href="item.href" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 cursor-pointer">{{ item.name }}</a>
              </div>
              <div class="py-6">
                <a href="/login" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</a>
              </div>
            </div>
          </div>
        </DialogPanel>
      </Dialog>
    </header>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { Dialog, DialogPanel } from '@headlessui/vue'
  import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import { Link } from '@inertiajs/vue3';

  defineProps({
    fullColor: {
      type: Boolean,
      default: true
    }
  })
  
  const navigation = [
    { name: 'Adoptar', href: 'adoption' },
    { name: 'Donar', href: 'donation' },
    // { name: 'Voluntariado', href: 'adoption' },
    { name: 'Publicar', href: 'pet.publications' },
  ]
  
  const mobileMenuOpen = ref(false)
  </script>