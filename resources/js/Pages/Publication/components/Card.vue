<script setup>
import dog_icon from "@/../img/dog_icon.webp";
import cat_icon from "@/../img/cat_icon.png";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const toast = useToast()

const props = defineProps({
    pet: Object,
});

const form = useForm({
    pet_id: props.pet.id
})

console.log(props.pet.active);

const handleActive = () => {

    if (props.pet.active) {
        form.patch(route('pet.deactivate'), {
            onSuccess: (res) => {
                toast.success(`${props.pet.name} ya no está publico para adopción`)
            }
        })
    } else {
        form.patch(route('pet.activate'), {
            onSuccess: (res) => {
                toast.success(`${props.pet.name} está disponible para adopción`)
            }
        })
        
    }
}
</script>

<template>
    <div class=" flex flex-col border rounded-md p-2">
        <div class="flex gap-2  ">
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
                        {{ pet.breed.name }}</h6>
                </div>

                <label class="inline-flex items-center mb-5 cursor-pointer">
  <input type="checkbox" :checked="pet.active"  @change="handleActive" class="sr-only peer">
  <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600"></div>
  <span class="ms-3 text-sm font-medium text-gray-900">{{ pet.active ? 'Activado' : 'Desactivado' }}</span>
</label>
    
                    <div class="grid grid-cols-3 divide-x ">
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

            
        </div>

        <div class="pt-2">
            
  <div class="relative">
    <div class="absolute inset-0 flex items-center" aria-hidden="true">
      <div class="w-full border-t border-gray-300" />
    </div>
    <div class="relative flex justify-start">
      <span class="bg-white pr-2 text-sm text-gray-500 mb-1">Solicitudes de adopción</span>
    </div>
  </div>

         <div class="prose prose-sm border rounded-md space-y-2" >
            <div class="flex flex-col space-y-2 divide-y  bg-gray-50  p-2 pb-0 relative overflow-hidden cursor-pointer hover:bg-gray-100" v-for="(form, idx) in pet.forms" :key="form.id">
                <div class="flex flex-col">
                 <span class="text-xs">Información del solicitante</span>

                 <span>
                     Nombre: {{ form.user.name }}
                    </span>
                    <span>
                        Correo: {{ form.user.email }}
                    </span>
                    <span>
                        Telefono: {{ form.user.phone }}
                    </span>
                    <span>
                        Celular: {{ form.user.mobile }}
                    </span>
                    <span>
                        Provincia: {{ form.user.province.name }}
                    </span>
                </div>
                <div class="bg-gray-100 p-2 -mx-2 ">
                    {{ form.why_adopt }}
                </div>
                <h6 class="absolute right-2 top-2 text-[100px] font-bold text-gray-200">{{ idx + 1 }}</h6>
            </div>
         </div>
        </div>
    </div>
</template>
