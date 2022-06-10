<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Test Page" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Test Sayfası
            </h2>
        </template>

        <div class=" ">
            <h1 class="text-2xl font-semibold text-gray-900">Ana Sayfa</h1>
        </div>
        <div class="">
            <!-- Replace with your content -->
            <div class="py-4">
                <div class="border-4 border-dashed border-gray-200 rounded-lg h-96" />
            </div>
            <!-- /End replace -->
        </div>
    </BreezeAuthenticatedLayout>
</template>
