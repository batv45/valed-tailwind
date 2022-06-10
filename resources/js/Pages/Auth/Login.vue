<script setup>
import BreezeButton from '@/Components/vaButton.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/vaInput.vue';
import BreezeLabel from '@/Components/vaLabel.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Oturum Aç" />

        <span class="text-3xl block text-center w-full mb-5 font-thin font-raleway">Kullanıcı Girişi</span>
        <BreezeValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="mb-3">
                <BreezeInput label="E-Posta" :error="form.errors.email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username"/>
            </div>
            <div class="mb-3">
                <BreezeInput label="Şifre" type="password"  :error="form.errors.password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
            </div>
            <div class="block mt-4">
                <label class="flex items-center">
                    <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Beni Hatırla</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <span class="text-sm text-gray-600 hover:text-gray-700">
                    <Link :href="route('register')" class="underline">Yeni hesap oluştur.</Link>
                </span>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Şifremi Unuttum ?
                </Link>

                <BreezeButton  :loading="form.processing" class="ml-4" :class="{ 'opacity-25': form.processing }" >
                    Oturum Aç
                </BreezeButton>
            </div>
        </form>

    </BreezeGuestLayout>
</template>
