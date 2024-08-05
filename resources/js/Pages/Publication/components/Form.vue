<script setup>
import { ref, computed } from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { CheckIcon } from "@heroicons/vue/24/outline";
import { router, useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useToast } from "vue-toastification";
import Notify from "@/Components/Notify.vue";
import axios from "axios";
import { DisclosurePanel } from "@headlessui/vue";

const props = defineProps({
    pets: Array,
    provinces: Array,
    breeds: Array,
    open: Boolean,
    handleClose: Function
});

const form = useForm({
    name: "",
    slug: "",
    description: "",
    breed_id: "",
    type: "",
    photo: "",
    gender: "Male",
    weight: "",
    energy_level: "Medium",
    age: "Young",
    current_size: "Medium",
    adult_size: "Medium",
    training_level: "Basic",
    coat: "Short",
    province_id: "",
    temperament: "Calm",
    vaccinated: false,
    dewormed: false,
    neutered: false,
    special_needs: false,
    special_needs_notes: "",
    medical_history: "",
    published_by: "",
});

const toast = useToast();

const filteredBreeds = computed(() => {
    if (!form.type) return [];
    return props.breeds.filter((breed) => breed.type === form.type);
});

const isBreedSelectDisabled = computed(() => {
    return !form.type;
});

const handleFileUpload = (event) => {
    const file = event.target.files[0];
    form.photo = file;
};

const submit = () => {
    // const formData = new FormData();
    // for (const key in form) {
    //     formData.append(key, form[key]);
    // }

    // if (form.photo) {
    //     formData.append('photo', form.photo);
    // }

    form.post(route("pet.store"), {
      onSuccess: (res) => {
        toast.success('La mascota ha sido publicada')
        form.reset()
        handleClose()
      },
      onError: (err) => {
        toast.error('Ha ocurrido un error')
      }
    })
   
};
</script>

<template>
    <TransitionRoot as="template" :show="open">
        <Dialog class="relative z-10" @close="handleClose">
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                />
            </TransitionChild>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div
                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                >
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100"
                        leave="ease-in duration-200"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                        <DialogPanel
                            class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 w-full sm:max-w-3xl sm:p-6"
                        >
                            <div>
                                <form
                                    @submit.prevent="submit"
                                    class="flex flex-col md:grid max-w-3xl mx-auto grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-4"
                                >
                                    <div class="col-span-full">
                                        <InputLabel for="name" value="Nombre" />
                                        <TextInput
                                            id="name"
                                            v-model="form.name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            required
                                            autofocus
                                        />
                                        <InputError
                                            :message="form.errors.name"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="col-span-full">
                                        <InputLabel
                                            for="description"
                                            value="Descripción"
                                        />
                                        <textarea
                                            id="description"
                                            v-model="form.description"
                                            placeholder="Hable acerca del animal y describa el porqué pone la mascota en adopción..."
                                            class="block p-2.5 mt-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 max-h-[320px]"
                                            rows="3"
                                        ></textarea>
                                        <InputError
                                            :message="form.errors.description"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="">
                                        <InputLabel for="type" value="Tipo" />
                                        <select
                                            id="type"
                                            v-model="form.type"
                                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full mt-1"
                                            required
                                        >
                                            <option value="Dog">Perro</option>
                                            <option value="Cat">Gato</option>
                                            <option value="Other">Otro</option>
                                        </select>
                                        <InputError
                                            :message="form.errors.type"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="">
                                        <InputLabel
                                            for="breed_id"
                                            value="Raza"
                                        />
                                        <select
                                            id="breed_id"
                                            v-model="form.breed_id"
                                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full mt-1"
                                            :disabled="isBreedSelectDisabled"
                                        >
                                            <option
                                                v-for="(
                                                    breed, index
                                                ) in filteredBreeds"
                                                :key="breed.id"
                                                :value="breed.id"
                                            >
                                                {{ breed.name }}
                                            </option>
                                        </select>
                                        <InputError
                                            :message="form.errors.breed_id"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="">
                                        <InputLabel
                                            for="gender"
                                            value="Género"
                                        />
                                        <select
                                            id="gender"
                                            v-model="form.gender"
                                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full mt-1"
                                            required
                                        >
                                            <option value="Male">Macho</option>
                                            <option value="Female">
                                                Hembra
                                            </option>
                                        </select>
                                        <InputError
                                            :message="form.errors.gender"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="">
                                        <InputLabel
                                            for="weight"
                                            value="Peso en libras"
                                        />
                                        <TextInput
                                            id="weight"
                                            v-model="form.weight"
                                            type="number"
                                            class="mt-1 block w-full"
                                        />
                                        <InputError
                                            :message="form.errors.weight"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="">
                                        <InputLabel
                                            for="energy_level"
                                            value="Nivel de Energía"
                                        />
                                        <select
                                            id="energy_level"
                                            v-model="form.energy_level"
                                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full mt-1"
                                        >
                                            <option value="Low">Bajo</option>
                                            <option value="Medium">
                                                Medio
                                            </option>
                                            <option value="High">Alto</option>
                                        </select>
                                        <InputError
                                            :message="form.errors.energy_level"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="">
                                        <InputLabel for="age" value="Edad" />
                                        <select
                                            id="age"
                                            v-model="form.age"
                                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full mt-1"
                                        >
                                            <option value="Baby">Bebé</option>
                                            <option value="Young">Joven</option>
                                            <option value="Adult">
                                                Adulto
                                            </option>
                                            <option value="Senior">
                                                Mayor
                                            </option>
                                        </select>
                                        <InputError
                                            :message="form.errors.age"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="">
                                        <InputLabel
                                            for="current_size"
                                            value="Tamaño Actual"
                                        />
                                        <select
                                            id="current_size"
                                            v-model="form.current_size"
                                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full mt-1"
                                        >
                                            <option value="Small">
                                                Pequeño
                                            </option>
                                            <option value="Medium">
                                                Mediano
                                            </option>
                                            <option value="Large">
                                                Grande
                                            </option>
                                            <option value="Extra Large">
                                                Muy Grande
                                            </option>
                                        </select>
                                        <InputError
                                            :message="form.errors.current_size"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="">
                                        <InputLabel
                                            for="adult_size"
                                            value="Tamaño en la Adultez"
                                        />
                                        <select
                                            id="adult_size"
                                            v-model="form.adult_size"
                                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full mt-1"
                                        >
                                            <option value="Small">
                                                Pequeño
                                            </option>
                                            <option value="Medium">
                                                Mediano
                                            </option>
                                            <option value="Large">
                                                Grande
                                            </option>
                                            <option value="Extra Large">
                                                Muy Grande
                                            </option>
                                        </select>
                                        <InputError
                                            :message="form.errors.adult_size"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="">
                                        <InputLabel
                                            for="training_level"
                                            value="Nivel de Entrenamiento"
                                        />
                                        <select
                                            id="training_level"
                                            v-model="form.training_level"
                                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full mt-1"
                                        >
                                            <option value="None">
                                                Ninguno
                                            </option>
                                            <option value="Basic">
                                                Básico
                                            </option>
                                            <option value="Intermediate">
                                                Intermedio
                                            </option>
                                            <option value="Advanced">
                                                Avanzado
                                            </option>
                                        </select>
                                        <InputError
                                            :message="
                                                form.errors.training_level
                                            "
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="">
                                        <InputLabel for="coat" value="Pelaje" />
                                        <select
                                            id="coat"
                                            v-model="form.coat"
                                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full mt-1"
                                        >
                                            <option value="None">
                                                Ninguno
                                            </option>
                                            <option value="Short">Corto</option>
                                            <option value="Medium">
                                                Medio
                                            </option>
                                            <option value="Long">Largo</option>
                                            <option value="Curly">
                                                Rizado
                                            </option>
                                            <option value="Hairless">
                                                Sin Pelo
                                            </option>
                                        </select>
                                        <InputError
                                            :message="form.errors.coat"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="">
                                        <InputLabel
                                            for="province_id"
                                            value="Provincia"
                                        />
                                        <select
                                            id="province_id"
                                            v-model="form.province_id"
                                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full mt-1"
                                            required
                                        >
                                            <option
                                                v-for="province in provinces"
                                                :key="province.id"
                                                :value="province.id"
                                            >
                                                {{ province.name }}
                                            </option>
                                        </select>
                                        <InputError
                                            :message="form.errors.province_id"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="">
                                        <InputLabel
                                            for="temperament"
                                            value="Temperamento"
                                        />
                                        <select
                                            id="temperament"
                                            v-model="form.temperament"
                                            class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full mt-1"
                                        >
                                            <option disabled value="">
                                                Seleccione una opción
                                            </option>
                                            <option value="Passive">
                                                Pasivo
                                            </option>
                                            <option value="Calm">
                                                Calmado
                                            </option>
                                            <option value="Aggressive">
                                                agresivo
                                            </option>
                                            <option value="Friendly">
                                                Amistoso
                                            </option>
                                            <option value="Playful">
                                                Jueguetón
                                            </option>
                                            <option value="Shy">Tímido</option>
                                        </select>
                                        <InputError
                                            :message="form.errors.temperament"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="col-span-full">
                                        <InputLabel for="photo" value="Foto" />
                                        <input
                                            class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            id="small_size"
                                            type="file"
                                            @input="form.photo = $event.target.files[0]"                                        />
                                        <InputError
                                            :message="form.errors.photo"
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="col-span-full">
                                        <InputLabel
                                            for="medical_history"
                                            value="Historial Médico"
                                        />
                                        <textarea
                                            id="medical_history"
                                            v-model="form.medical_history"
                                            placeholder="Describa la condición de salud actual de la mascota y cualquier historial médico relevante..."
                                            class="block p-2.5 mt-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                            rows="3"
                                        ></textarea>
                                        <InputError
                                            :message="
                                                form.errors.medical_history
                                            "
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="flex items-center">
    <Checkbox id="vaccinated" v-model="form.vaccinated" />
    <InputLabel for="vaccinated" value="Vacunado" class="ml-2" />
</div>

<div class="flex items-center">
    <Checkbox id="dewormed" v-model="form.dewormed" />
    <InputLabel for="dewormed" value="Desparasitado" class="ml-2" />
</div>

<div class="flex items-center">
    <Checkbox id="neutered" v-model="form.neutered" />
    <InputLabel for="neutered" value="Esterilizado" class="ml-2" />
</div>

<div class="flex items-center">
    <Checkbox id="special_needs" v-model="form.special_needs" />
    <InputLabel for="special_needs" value="Necesidades Especiales" class="ml-2" />
</div>

                                    <div class="col-span-full">
                                        <InputLabel
                                            for="special_needs_notes"
                                            value="Notas de Necesidades Especiales"
                                        />
                                        <textarea
                                            id="special_needs_notes"
                                            v-model="form.special_needs_notes"
                                            placeholder="Proporcione detalles adicionales sobre las necesidades especiales de la mascota..."
                                            class="block p-2.5 mt-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                            rows="3"
                                        ></textarea>
                                        <InputError
                                            :message="
                                                form.errors.special_needs_notes
                                            "
                                            class="mt-2"
                                        />
                                    </div>

                                    <div class="col-span-full">
                                        <PrimaryButton
                                            :disabled="form.processing"
                                            >Guardar</PrimaryButton
                                        >
                                    </div>
                                </form>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<style scoped>
/* Add any scoped styles here */
</style>
