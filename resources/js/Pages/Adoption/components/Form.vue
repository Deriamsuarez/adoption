<script setup>
import { reactive, ref } from "vue";
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
    name: String,
    petId: Number,
    gender: String,
    canLogin: Boolean,
});

const requirements = [
    "Ser mayor de 18 años.",
    "Contar con un hogar adecuado y suficiente espacio para la mascota.",
    "Comprometerse a cuidar de la mascota durante toda su vida (10-20 años).",
    "Disponibilidad para dedicar tiempo diario a cuidados, ejercicio y atención.",
    "Tener la capacidad financiera para cubrir gastos de adopción, alimentación y atención veterinaria.",
    "Cumplir con las leyes locales relacionadas con la tenencia de mascotas.",
    "Confirmar que no hay alergias a animales en el hogar.",
    "Estar dispuesto a proporcionar entrenamiento y socialización a la mascota si es necesario.",
    "Tener un plan de cuidado para la mascota en caso de emergencias o viajes.",
    "Asegurar que todos los miembros del hogar están de acuerdo con la adopción de la mascota.",
];

// Define the options for the members radio buttons
const numbers = [1, 2, 3, 4, 5];

// Initialize form with empty fields and potential validation errors

const toast = useToast();
const form = useForm({
    members: "",
    all_agree: false,
    animals: false,
    why_adopt: "",
    allowed_to_have_pets: false,
    terms: false,
    pet_id: props.petId,
});

const submit = () => {
    if (props.canLogin) {
        form.post(route("form.store"));
    }
    axios
        .post(route("form.store"), form)
        .then((res) => {
            console.log(res.data);
            toast(
                {
                    component: Notify,
                    props: {
                        pet: res.data.pet, // Pasar las propiedades al componente
                    },
                },
                {
                    type: "success", // Opciones adicionales para el toast
                    icon: false,
                }
            );
        })
        .catch((error) => {
            // Manejar los errores

                toast(
                    {
                        component: Notify,
                        props: {
                            pet: error.response.data.pet,
                            error: true, // Pasar las propiedades al componente
                        },
                    },
                    {
                        type: "error", // Opciones adicionales para el toast
                        icon: false,
                    }
                );
        });
};
</script>

<template>
    <form
        @submit.prevent="submit"
        class="flex flex-col md:grid max-w-3xl mx-auto grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2 md:gap-6"
    >
        <!-- All Agree -->
        <div class="flex gap-1">
            <Checkbox
                :gender="gender"
                id="all_agree"
                v-model:checked="form.all_agree"
                class="mt-1"
                required
            />
            <InputLabel
                for="all_agree"
                value="¿Todos están de acuerdo con la adopción?"
            />
            <!-- <InputError class="mt-2" :message="form.errors.all_agree" /> -->
        </div>

        <!-- Animals -->
        <div class="flex gap-1">
            <Checkbox
                :gender="gender"
                id="animals"
                v-model:checked="form.animals"
                class="mt-1"
            />
            <InputLabel for="animals" value="¿Tiene animales en casa?" />
            <!-- <InputError class="mt-2" :message="form.errors.animals" /> -->
        </div>

        <!-- Newsletter -->
        <div class="flex gap-1">
            <Checkbox
                :gender="gender"
                id="newsletter"
                v-model:checked="form.newsletter"
                class="mt-1"
            />
            <InputLabel
                for="newsletter"
                value="¿Quieres recibir información acerca de otras mascotas?"
            />
            <!-- <InputError class="mt-2" :message="form.errors.newsletter" /> -->
        </div>

        <!-- Members -->
        <div class="flex flex-col">
            <InputLabel for="members" value="Miembros de la familia" />
            <div class="mt-1 flex gap-4">
                <div
                    v-for="number in numbers"
                    :key="number"
                    class="flex items-center"
                >
                    <input
                        type="radio"
                        :id="'members_' + number"
                        :value="number"
                        v-model="form.members"
                        class="h-4 w-4 border-gray-100"
                        :class="
                            gender == 'Male'
                                ? ' text-blue-500 focus:ring-blue-500 '
                                : 'text-pink-500 focus::ring-pink-500'
                        "
                        required
                    />
                    <label :for="'members_' + number" class="ml-1">{{
                        number
                    }}</label>
                </div>
            </div>
            <!-- <InputError class="mt-2" :message="form.errors.members" /> -->
        </div>

        <!-- Allowed to Have Pets -->
        <div class="flex gap-1">
            <Checkbox
                :gender="gender"
                id="allowed_to_have_pets"
                v-model:checked="form.allowed_to_have_pets"
                class="mt-1"
                required
            />
            <InputLabel
                for="allowed_to_have_pets"
                value="¿Pueden tener mascotas?"
            />
            <!-- <InputError class="mt-2" :message="form.errors.allowed_to_have_pets" /> -->
        </div>

        <!-- Why Adopt -->
        <div class="flex flex-col col-span-full">
            <InputLabel
                for="why_adopt"
                :value="`Carta del porqué quieres adoptar a ${name}`"
            />
            <textarea
                id="why_adopt"
                v-model="form.why_adopt"
                type="text"
                class="block p-2.5 mt-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 max-h-[320px]"
                placeholder="Write your thoughts here..."
                autocomplete="why_adopt"
            ></textarea>
            <!-- <InputError class="mt-2" :message="form.errors.why_adopt" /> -->
        </div>

        <div class="col-span-full">
            <h3 class="text-red-500">
                Consideraciones obligatorias a tener para adoptar una mascota.
            </h3>
            <div class="prose prose-sm pb-6">
                <ol role="list">
                    <li v-for="item in requirements" :key="item">{{ item }}</li>
                </ol>
            </div>

            <!-- Terms -->
            <div class="flex gap-1">
                <Checkbox
                    :gender="gender"
                    id="terms"
                    v-model:checked="form.terms"
                    class="mt-1"
                    required
                />
                <InputLabel
                    for="terms"
                    value="Acepto los términos y condiciones"
                />
                <!-- <InputError class="mt-2" :message="form.errors.terms" /> -->
            </div>
        </div>
        <!-- Submit Button -->
        <div class="flex items-center justify-end col-span-full gap-2">
            <span v-if="canLogin" class="text-xs italic"
                >Debes de iniciar sesión para poner hacer la solicitud</span
            >
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                {{ canLogin ? "Iniciar sesión" : "Enviar Solicitud" }}
            </PrimaryButton>
        </div>
    </form>
</template>
