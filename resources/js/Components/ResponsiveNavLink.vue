<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'bg-gray-100 text-gray-900' + ' block px-4 py-2 text-sm'
    : 'text-gray-700' + ' block px-4 py-2 text-sm'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
