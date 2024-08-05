<script setup>
import { useKeenSlider } from "keen-slider/vue.es";
import "keen-slider/keen-slider.min.css";
import { PhotoIcon } from "@heroicons/vue/24/solid";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { XMarkIcon } from "@heroicons/vue/24/outline";

const props = defineProps({
    files: {
        type: Array,
    },
    petId: Number,
    canEdit: Boolean
});

const toast = useToast();


function ThumbnailPlugin(main) {
    return (slider) => {
        function removeActive() {
            slider.slides.forEach((slide) => {
                slide.classList.remove("active");
            });
        }
        function addActive(idx) {
            slider.slides[idx].classList.add("active");
        }

        function addClickEvents() {
            slider.slides.forEach((slide, idx) => {
                slide.addEventListener("click", () => {
                    main.value.moveToIdx(idx);
                });
            });
        }

        slider.on("created", () => {
            addActive(slider.track.details.rel);
            addClickEvents();
            main.value.on("animationStarted", () => {
                removeActive();
                const next = main.value.animator.targetIdx || 0;
                addActive(main.value.track.absToRel(next));
                slider.moveToIdx(Math.min(slider.track.details.maxIdx, next));
            });
        });
    };
}

const form = useForm({
    file: null,
    petId: props.petId
})

const deletePhoto = useForm({
    petId: props.petId,
    filePath: null // Añadir fileId aquí


})

const deletePhotoHandle = (filePath) => {
    deletePhoto.filePath = filePath; // Establecer fileId
    deletePhoto.delete(route('pet.files.remove'), {
        onSuccess: () => {
            toast.success('Se ha eliminado la foto de manera satisfactoria');
        },
        onError: () => {
            toast.error('Ha ocurrido un error');
        }
    });
}

const submit = () => {
    form.post(route('pet.files.add'), {
        onSuccess: () => {
            toast.success('La imagen se ha subido con exito')
        },
        onError: () => {
            toast.error('Ha ocurrido un error')
        }
    })
}

const [container, slider] = useKeenSlider();
const [thumbnail] = useKeenSlider(
    {
        initial: 0,
        slides: {
            perView: 4,
            spacing: 10,
        },
    },
    [ThumbnailPlugin(slider)]
);
</script>

<template>
    <div class="p-4 sm:p-0 mb-4">
        <div ref="container" class="keen-slider">
            <div
                v-for="(file, index) in files"
                :key="file"
                class="keen-slider__slide h-[450px] w-full rounded-md shadow-md mb-2"
            >
                <img
                    :src="'/storage/' + file"
                    alt="Imagen"
                    class="h-full  w-full object-cover object-center"
                />
            </div>
        </div>
        <div ref="thumbnail" class="keen-slider rounded-md overflow-hidden thumbnail">
            <div
                v-for="(file, index) in files"
                :key="file"
                class="keen-slider__slide relative"
            >
                <img
                    :src="'/storage/' + file"
                    alt="Imagen"
                    class="h-20 w-full object-cover"
                />
                <button @click="deletePhotoHandle(file)" v-if="canEdit && index > 0" class="absolute right-1 top-1 bg-red-500/60 p-1 rounded-full text-white"> <XMarkIcon  class="w-3 h-3"/> </button>
            </div>

            <div >
    <div  v-if="files.length <= 4 && canEdit" class="keen-slider__slide border-2 border-dashed flex items-center justify-center text-xs flex-col gap-1 text-gray-500 hover:text-blue-500 hover:border-blue-500 hover:bg-white">
      <label for="file-input"  class="flex flex-col items-center justify-center cursor-pointer">
        <PhotoIcon class="w-4 h-4"/>
        <span>Agregar foto</span>
      </label>
      <input id="file-input" type="file" accept=".jpeg,.jpg,.png,.webp" @input="form.file = $event.target.files[0]" @change="submit" required class="hidden"/>
    
    </div>

  </div>
         
        </div>
    </div>
</template>

<style>
.thumbnail .keen-slider__slide {
    cursor: pointer;
    border-radius: 4px;

}
.thumbnail .keen-slider__slide.active {
    border: 2px solid #14213d;
}
</style>
