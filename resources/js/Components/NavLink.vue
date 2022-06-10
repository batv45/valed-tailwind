<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'bg-gray-900 text-white' + ' group flex items-center px-2 py-2 text-sm font-medium rounded-md'
    : 'text-gray-300 hover:bg-gray-700 hover:text-white' + ' group flex items-center px-2 py-2 text-sm font-medium rounded-md'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
