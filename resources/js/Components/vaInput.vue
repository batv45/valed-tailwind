<script>
export default {
    inheritAttrs: false
}
</script>
<script setup>
import { onMounted, ref } from 'vue';
import { v4 as uuid } from 'uuid'
import InputError from "@/Components/vaInputError";
import VaLabel from "@/Components/vaLabel";
import {InformationCircleIcon} from "@heroicons/vue/solid"

const props = defineProps({
    modelValue: String,
    label: String,
    error: String,
    placeholder: String,
    autocomplete: String,
    hint: String,
    type: {
        type: String,
        default: 'text',
    },
    id: {
        type: String,
        default() {
            return `text-input-${uuid()}`
        },
    },
    required:{
        type: Boolean,
        default: false
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);


onMounted(() => {
    // if (input.value.hasAttribute('autofocus')) {
    //     input.value.focus();
    // }
});
</script>

<template>
    <div>
        <va-label v-if="label" :value="label" class="block font-medium text-sm text-gray-800 mb-1" :required="required" :for="id"> </va-label>
        <div class="relative rounded-md shadow-sm">
            <input :id="id"
                   v-bind="$attrs"
                   class="border-gray-300 focus:border-gray-300 focus:ring focus:border-gray-500
                   placeholder-gray-500 placeholder-opacity-70 w-full
                   focus:ring-gray-300 focus:ring-opacity-50 rounded-md"
                   :class="{'border-red-500 focus:ring-red-300 focus:border-red-500': error}"
                   :placeholder="placeholder"
                   :autocomplete="autocomplete"
                   :type="type"
                   :required="required"
                   :value="modelValue"
                   @input="$emit('update:modelValue', $event.target.value)"/>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <slot name="icon"></slot>
            </div>
        </div>
        <input-error class="mt-1" :message="error" />
        <small v-if="hint" class="mt-1 text-gray-600 flex">
            <information-circle-icon class="icon"/>
            <span v-html="hint" class="pt-0.5"></span>
        </small>
    </div>
</template>
