
<script setup>
import { HeartIcon } from "@heroicons/vue/24/outline";
import dog_icon from "@/../img/dog_icon.webp";
import cat_icon from "@/../img/cat_icon.png";
import { truncate } from "@/Utils/helpers";
import { Link, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const props = defineProps({
    pet: Object,
});

const toast = useToast();


const form = useForm({})

const handleFavorite = () => {
    if (!props.pet.is_favorite) {
        form.post(route('create.favorite', {id: props.pet.id }), {
            onSuccess: (res) => {
                toast.success('Se ha marcado como favorito 😁')
            },
            onError: (err) => {
                toast.error('Ha ocurrido un error 😓')
            }
        })
    } else {
        form.post(route('delete.favorite', {id: props.pet.id }), {
            onSuccess: (res) => {
                toast.success('Se ha elimando de tu lista de favorito 😓')
            },
            onError: (err) => {
                toast.error('Ha ocurrido un error 😓')
            }
        })
    }
}
</script>

<template>
    <div class="font-secondary p-2 border rounded-lg shadow-sm">
        <img
            class="w-full h-44 rounded-md object-cover object-center"
            :src="`/storage/${pet.photo}`"
            alt=""
            srcset=""
        />
        <div class="p-2">
            <div class="flex justify-between items-center">
                <div>
                    <h4
                        class="text-lg font-bold"
                        :class="
                            pet.gender == 'Male'
                                ? 'text-blue-500'
                                : 'text-pink-500'
                        "
                    >
                        {{ pet.name }}
                    </h4>
                    <h6 class="text-xs -mt-1 italic flex items-center gap-1">
                        <img
                            v-if="pet.type == 'Dog'"
                            :src="dog_icon"
                            class="w-3 h-3"
                            alt=""
                            srcset=""
                        />
                        <img
                            v-if="pet.type == 'Cat'"
                            :src="cat_icon"
                            class="w-3 h-3"
                            alt=""
                            srcset=""
                        />

                        {{ pet.breed.name }}
                    </h6>
                </div>
                <div
                    class="flex items-center uppercase text-xs"
                    :class="
                        pet.gender == 'Male' ? 'text-blue-500' : 'text-pink-500'
                    "
                >
                    {{ pet.gender == "Male" ? "Macho" : "Hembra" }}
                    <span
                        v-if="pet.gender == 'Male'"
                        class="material-symbols-outlined text-blue-500 text-sm"
                    >
                        male
                    </span>
                    <span
                        v-else
                        class="material-symbols-outlined text-pink-500 text-sm"
                    >
                        female
                    </span>
                </div>
            </div>
            <p class="text-sm py-2 h-24 overflow-y-auto">
                {{ truncate(pet.description, 92) }}
            </p>
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
            <div class="flex gap-2 items-center">
                <Link
                    as="button"
                    :href="`/adopcion/${pet.slug}`"
                    class="text-sm uppercase rounded-full border-2 bg-white hover:text-white py-1 px-4 w-full"
                    :class="
                        pet.gender == 'Male'
                            ? 'hover:bg-blue-500 border-blue-500 text-blue-500'
                            : 'text-pink-500 hover:bg-pink-500 border-pink-500'
                    "
                >
                    Adoptar
                </Link>
                <button
                @click="handleFavorite"
                
                    class="group  p-2 rounded-full"
                    :class="pet.is_favorite ? 'bg-red-500 hover:bg-black/5  text-white hover:text-gray-400' : 'bg-black/5 hover:bg-red-500 text-gray-400 hover:text-white'"
                >
                    <HeartIcon
                        class="w-4 h-4 "

                    />
                </button>
            </div>
        </div>
    </div>
</template>
