<template>
    <GuestLayout :full-color="false">
        <main class="mx-auto pt-20 container sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:max-w-none">
                <!-- Product -->
                <div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8">
                    <!-- Image gallery -->
                    <Carrousel :canEdit="canEdit" :petId="pet.id" :files="pet.all_photos" />

                    <!-- Product info -->
                    <div class="mt-10 pb-4 px-4 sm:mt-16 sm:px-0 lg:mt-0">
                        <h1
                            class="text-3xl font-bold tracking-tight uppercase flex items-center gap-2"
                            :class="
                                pet.gender == 'Male'
                                    ? 'text-blue-500'
                                    : 'text-pink-500'
                            "
                        >
                            {{ pet.name }}
                            <img
                                v-if="pet.type == 'Dog'"
                                :src="dog_icon"
                                class="w-6 h-6"
                                alt=""
                                srcset=""
                            />
                            <img
                                v-if="pet.type == 'Cat'"
                                :src="cat_icon"
                                class="w-6 h-6"
                                alt=""
                                srcset=""
                            />
                        </h1>
                        <h6
                            class="-mt-1 italic flex items-center gap-1 text-sm"
                        >
                            <span>
                                {{
                                    pet.type == "Dog"
                                        ? "Perro"
                                        : pet.type == "Cat"
                                        ? "Gato"
                                        : "Otro"
                                }} </span
                            >{{ pet.breed.name }} -
                            {{ pet.gender == "Male" ? "Macho" : "Hembra" }}
                        </h6>

                        <div class="mt-3">
                            <h3 class="sr-only">Description</h3>

                            <div
                                class="space-y-6 text-base text-gray-700"
                                v-html="pet.description"
                            />
                        </div>

                        <div class="grid grid-cols-3 text-center divide-x mt-8">
                            <div
                                class="text-sm flex items-center justify-center gap-1"
                            >
                                <span class="material-symbols-outlined">
                                    height
                                </span>
                                <h6 class="flex flex-col divide-y">
                                    <span>{{
                                        pet.adult_size === "Small"
                                            ? "Pequeño"
                                            : pet.adult_size == "Medium"
                                            ? "Mediano"
                                            : pet.adult_size == "Large"
                                            ? "Grande"
                                            : ""
                                    }}</span>
                                    <span class="text-xs text-center"
                                        >Tamaño adulto</span
                                    >
                                </h6>
                            </div>
                            <div
                                class="text-sm flex items-center justify-center gap-1"
                            >
                                <span class="material-symbols-outlined">
                                    scale
                                </span>
                                <h6 class="flex flex-col divide-y">
                                    <span>{{ pet.weight }} lbs</span>
                                    <span class="text-xs text-center"
                                        >Peso</span
                                    >
                                </h6>
                            </div>
                            <div
                                class="text-sm flex items-center justify-center gap-1"
                            >
                                <span class="material-symbols-outlined">
                                    date_range
                                </span>
                                <h6 class="flex flex-col divide-y">
                                    <span>{{
                                        pet.age == "Baby"
                                            ? "Bebé"
                                            : pet.age == "Young"
                                            ? "Joven"
                                            : pet.age == "Senior"
                                            ? "Adulto"
                                            : ""
                                    }}</span>
                                    <span class="text-xs text-center"
                                        >Edad Actual</span
                                    >
                                </h6>
                            </div>
                        </div>
                        <section
                            aria-labelledby="details-heading"
                            class="mt-12"
                        >
                            <h2 id="details-heading" class="sr-only">
                                Additional details
                            </h2>

                            <div class="divide-y divide-gray-200 border-t ">
                                <Disclosure
                                    as="div"
                                    v-for="detail in product.details"
                                    :key="detail.name"
                                    v-slot="{ open }"
                                >
                                    <h3>
                                        <DisclosureButton
                                            class="group relative flex w-full items-center justify-between py-6 text-left"
                                        >
                                            <span
                                                :class="[
                                                    open
                                                        ? pet.gender == 'Male' ? 'text-blue-600' : 'text-pink-500'
                                                        : 'text-gray-900',
                                                    'text-sm font-medium',
                                                ]"
                                                >{{ detail.name }}</span
                                            >
                                            <span
                                                class="ml-6 flex items-center"
                                            >
                                                <PlusIcon
                                                    v-if="!open"
                                                    class="block h-6 w-6 text-gray-400 group-hover:text-gray-500"
                                                    aria-hidden="true"
                                                />
                                                <MinusIcon
                                                    v-else
                                                    class="block h-6 w-6 "
                                                    :class="pet.gender == 'Male' ? 'text-blue-500' : 'text-pink-500'"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel as="div" class="">
                                      <component :pet="pet" :is="detail.component" />
                                    </DisclosurePanel>
                                </Disclosure>
                            </div>
                        </section>
                    
                    </div>
                    
                </div>
                <div class="p-4 py-12  bg-white rounded-lg ">
                    <div class="text-center py-4 text-xs">
                        <h6 class="-mb-1">

                            Formulario de adopción de:
                        </h6>
                        <h3 class="font-semibold text-3xl "
                        :class="
                                pet.gender == 'Male'
                                ? 'text-blue-500'
                                : 'text-pink-500'
                                "
                    >{{ pet.name }}</h3>
                </div>
                    <Form :petId="pet.id" :gender="pet.gender" :name="pet.name" :canLogin="canLogin" />
                </div>
                <section
                    aria-labelledby="related-heading"
                    class=" px-4 py-16 sm:px-0"
                >
                    <h2
                        id="related-heading"
                        class="text-xl font-bold text-gray-900"
                    >
                        Otras posibles adopciones
                    </h2>

                    <div
                        class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8"
                    >
                        <div
                            v-for="pet in pet.related_pets"
                            :key="pet.id"
                        >
                            <div class="relative">
                                <div
                                    class="relative h-72 w-full overflow-hidden rounded-lg"
                                >
                                    <img
                                        :src="`/storage/${pet.photo}`"
                                        class="h-full w-full object-cover object-center"
                                    />
                                </div>
                                <div class="relative mt-4">
                                    <div class="grid grid-cols-3 divide-x mb-4">
                <div class="text-sm flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-sm">
                        height
                    </span>
                    <h6>
                        {{
                            pet.adult_size === "Small"
                                ? "Pequeño"
                                : pet.adult_size == "Medium"
                                ? "Mediano"
                                : pet.adult_size == "Large"
                                ? "Grande"
                                : ""
                        }}
                    </h6>
                </div>
                <div class="text-sm flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-sm">
                        scale
                    </span>
                    <h6>{{ pet.weight }} lbs</h6>
                </div>
                <div class="text-sm flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-sm">
                        date_range
                    </span>
                    <h6>
                        {{
                            pet.age == "Baby"
                                ? "Bebé"
                                : pet.age == "Young"
                                ? "Joven"
                                : pet.age == "Senior"
                                ? "Adulto"
                                : ""
                        }}
                    </h6>
                </div>
            </div>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ product.gender }}
                                    </p>
                                </div>
                                <div
                                    class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4"
                                >
                                    <div
                                        aria-hidden="true"
                                        class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"
                                    />
                                    <p
                                        class="relative text-lg font-semibold text-white flex gap-1"
                                    >
                                        {{ pet.name }}
                                        <div
                    class="flex items-center uppercase text-xs"
                  
                >
                    <span
                        v-if="pet.gender == 'Male'"
                        class="material-symbols-outlined  text-sm"
                    >
                        male
                    </span>
                    <span
                        v-else
                        class="material-symbols-outlined  text-sm"
                    >
                        female
                    </span>
                </div>
                                    </p>
                                </div>
                            </div>
                            <div class="mt-6">
                                <a
                                    :href="`/adopcion/${pet.slug}`"
                                    class="relative flex items-center uppercase cursor-pointer justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200"
                                    >Adoptar<span class="sr-only"
                                        >, {{ product.name }}</span
                                    ></a
                                >
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </GuestLayout>
</template>

<script setup>
import { ref } from "vue";
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    RadioGroup,
    RadioGroupOption,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    Bars3Icon,
    CheckCircleIcon,
    HeartIcon,
    MagnifyingGlassIcon,
    MinusIcon,
    PlusIcon,
    ShoppingBagIcon,
    UserIcon,
    XCircleIcon,
    XMarkIcon,
} from "@heroicons/vue/24/outline";
import { StarIcon } from "@heroicons/vue/20/solid";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import dog_icon from "@/../img/dog_icon.webp";
import cat_icon from "@/../img/cat_icon.png";
import List from "../components/List.vue";
import MedicalHistory from "../components/MedicalHistory.vue";
import SpecialNeeds from "../components/SpecialNeeds.vue";
import Carrousel from "../templates/Carrousel.vue";
import Form from "../components/Form.vue"

const props = defineProps({
    pet: Object,
    canLogin: Boolean,
    canEdit: Boolean
});




const product = {
    name: "Zip Tote Basket",
    price: "$140",
    rating: 4,
    images: [
        {
            id: 1,
            name: "Angled view",
            src: "https://tailwindui.com/img/ecommerce-images/product-page-03-product-01.jpg",
            alt: "Angled front view with bag zipped and handles upright.",
        },
        // More images...
    ],
    colors: [
        {
            name: "Washed Black",
            bgColor: "bg-gray-700",
            selectedColor: "ring-gray-700",
        },
        { name: "White", bgColor: "bg-white", selectedColor: "ring-gray-400" },
        {
            name: "Washed Gray",
            bgColor: "bg-gray-500",
            selectedColor: "ring-gray-500",
        },
    ],
    description: `
    <p>The Zip Tote Basket is the perfect midpoint between shopping tote and comfy backpack. With convertible straps, you can hand carry, should sling, or backpack this convenient and spacious bag. The zip top and durable canvas construction keeps your goods protected for all-day use.</p>
  `,
    details: [
        {
            name: "Información",
            component: List
        },
        {
            name: "Historial Médico",
            component: MedicalHistory
        },
        {
            name: "Necesidades Especiales",
            component: SpecialNeeds
        },
        // More sections...
    ],
};


const open = ref(false);
</script>
