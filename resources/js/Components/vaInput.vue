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
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <div>
        <va-label v-if="label" :value="label" class="block font-medium text-sm text-gray-800" :class="{'required': required}" :for="id"> </va-label>
        <div class="mt-1">
            <div class="mb-1 relative rounded-md shadow-sm">
                <input :id="id" ref="input"
                       v-bind="$attrs"
                       class="border-gray-300 focus:border-gray-300 focus:ring focus:border-gray-500
                       placeholder-gray-500 placeholder-opacity-70
                       focus:ring-gray-300 focus:ring-opacity-50 rounded-md shadow-sm"
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
            <input-error :message="error" />
            <small v-if="hint" class="text-gray-600">
                <span v-html="hint"></span>
            </small>
        </div>
    </div>
</template>
