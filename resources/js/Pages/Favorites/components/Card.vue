<script setup>
import { TrashIcon } from "@heroicons/vue/24/outline";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const props = defineProps({
    pet: Object,
});

const toast = useToast()

const form = useForm({});

const handleFavorite = () => {
    form.post(route("delete.favorite", { id: props.pet.id }), {
        onSuccess: (res) => {
            toast.success("Se ha elimando de tu lista de favorito 😓");
        },
        onError: (err) => {
            toast.error("Ha ocurrido un error 😓");
        },
    });
};
</script>

<template>
    <div class="relative flex gap-2 border rounded-lg p-2 hover:bg-gray-50">
        <img
            :src="`/storage/${pet.photo}`"
            class="w-32 h-32 object-cover rounded-md"
            alt=""
            srcset=""
        />
        <div class="flex flex-col justify-between">
            <div>
                <h4
                    class="text-lg font-bold"
                    :class="
                        pet.gender == 'Male' ? 'text-blue-500' : 'text-pink-500'
                    "
                >
                    {{ pet.name }}
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
                </h4>
                <h6 class="text-xs -mt-1 flex items-center gap-1">
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

            <div class="grid grid-cols-3 divide-x">
                <div class="text-xs flex items-center justify-center gap-1">
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
                <div class="text-xs flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-sm">
                        scale
                    </span>
                    <h6>{{ pet.weight }} lbs</h6>
                </div>
                <div class="text-xs flex items-center justify-center gap-1">
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
        </div>
        <button @click="handleFavorite" class="bg-red-50 p-2 rounded-full absolute right-2 text-red-500 hover:bg-red-500 hover:text-white">    
            <TrashIcon  class="h-4 w-4 "/>
        </button>
    </div>
</template>
