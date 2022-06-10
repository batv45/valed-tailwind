<script setup>
import BreezeButton from '@/Components/vaButton.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/vaInput.vue';
import BreezeLabel from '@/Components/vaLabel.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import VaInput from "@/Components/vaInput";

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Register" />

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <va-input label="Ad" v-model="form.first_name" :error="form.errors.first_name" class="mt-1 block w-full"
                          required autofocus autocomplete="first_name"></va-input>
            </div>
            <div class="mt-4">
                <va-input label="Soyad" v-model="form.last_name" :error="form.errors.last_name" class="mt-1 block w-full"
                          required autocomplete="last_name"></va-input>
            </div>
            <div class="mt-4">
                <va-input label="E-Posta" type="email" v-model="form.email" :error="form.errors.email" class="mt-1 block w-full"
                          required autocomplete="email"></va-input>
            </div>

            <div class="mt-4">
                <va-input label="Şifre" type="password" v-model="form.password" :error="form.errors.password"
                          class="mt-1 block w-full"
                          required ></va-input>
            </div>

            <div class="mt-4">
                <va-input label="Şifre Tekrar" type="password" v-model="form.password_confirmation"
                          :error="form.errors.password_confirmation"
                          class="mt-1 block w-full"
                          required ></va-input>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Mevcut hesabın var mı?
                </Link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                    Kayıt Ol
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
