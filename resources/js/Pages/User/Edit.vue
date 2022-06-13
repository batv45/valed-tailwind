<template>
    <Authenticated>
        <PageHeader title="Kullanıcı Düzenle" :back-href="route('user.show',page_user)">
            <template #sub-title>
                <user-icon></user-icon> {{page_user.full_name}}
                <mail-icon class="ml-2" stroke-width="1.5"/> {{page_user.email}}
            </template>
            <template #actions>
                <va-button type="submit" form="user_form"><check-icon/> Kaydet</va-button>
            </template>
        </PageHeader>
        <div class="shadow bg-white p-4 sm:rounded-md">
            <form id="user_form" @submit.prevent="submitEdit" class="space-y-8 divide-y divide-gray-200 max-w-3xl mx-auto">
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
                                <va-input label="Şifre" type="password" hint="Boş bırakılırsa güncellenmez." v-model="form.password" :error="form.errors.password" placeholder="Hesap şifresi" />
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </Authenticated>
</template>

<script setup>
import Authenticated from "@/Layouts/Authenticated";
import PageHeader from "@/Components/PageHeader";
import VaButton from "@/Components/vaButton"
import {useForm} from "@inertiajs/inertia-vue3";
import VaInput from "@/Components/vaInput";
import {UserIcon,MailIcon,CheckIcon} from "vue-tabler-icons"

const props = defineProps({
    page_user: Object
})
const form = useForm({
    first_name: props.page_user.first_name,
    last_name: props.page_user.last_name,
    email: props.page_user.email,
    password: null
})

const submitEdit = () => {
    form.transform((data) => ({
        ...data,
        password: data.password ? data.password : undefined
    })).put(route('user.update',props.page_user))
}

</script>
