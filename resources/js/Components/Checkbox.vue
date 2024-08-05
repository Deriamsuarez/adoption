<script setup>
import { computed } from "vue";

const emit = defineEmits(["update:checked"]);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {
        type: String,
        default: null,
    },
    gender: {
        type: String,
        default: "Male",
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit("update:checked", val);
    },
});
</script>

<template>
    <input
        v-model="proxyChecked"
        type="checkbox"
        :value="value"
        :class="gender == 'Male' ? 'text-blue-500 focus:ring-blue-500' : 'text-pink-500 focus:ring-pink-500'"
        class="rounded border-gray-300 shadow-sm"
    />
</template>
