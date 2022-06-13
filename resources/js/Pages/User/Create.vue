<template>
    <authenticated>
        <PageHeader title="Yeni Kullanıcı Ekle" :back-href="route('user.index')">
            <template #actions>
                <va-button :loading="form.processing" type="submit" form="user_form"><check-icon/> Kaydet</va-button>
            </template>
        </PageHeader>
        <div class="shadow bg-white p-4 sm:rounded-md">
            <form id="user_form" @submit.prevent="submitCreate" class="space-y-8 divide-y divide-gray-200 max-w-3xl mx-auto">
                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                    <div class="space-y-6 sm:space-y-5">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Hesap Bilgileri</h3>
                        </div>
                        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <va-input label="Ad" required v-model="form.first_name" :error="form.errors.first_name" placeholder="Adı" />
                            </div>

                            <div class="sm:col-span-3">
                                <va-input label="Soyad" required v-model="form.last_name" :error="form.errors.last_name" placeholder="Soyadı" />
                            </div>

                            <div class="sm:col-span-4">
                                <va-input type="email" required label="E-Posta" v-model="form.email" :error="form.errors.email" placeholder="E-Posta adresi" />
                            </div>
                            <div class="sm:col-span-4">
                                <va-input label="Şifre" type="password" v-model="form.password" :error="form.errors.password" placeholder="Hesap şifresi" />
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </authenticated>
</template>

<script setup>
import Authenticated from "@/Layouts/Authenticated";
import VaButton from "@/Components/vaButton";
import PageHeader from "@/Components/PageHeader";
import {CheckIcon} from "vue-tabler-icons"
import {useForm} from "@inertiajs/inertia-vue3";
import vaInput from "@/Components/vaInput";
import vaLabel from "@/Components/vaLabel";

const form = useForm({
    first_name: null,
    last_name: null,
    email: null,
    password: null
})

const submitCreate = () => {
    form.post(route('user.store'))
}
</script>
