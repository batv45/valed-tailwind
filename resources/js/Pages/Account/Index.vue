<template>
    <Head title="Hesabım"></Head>
    <Authenticated>
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Hesap Bilgileri</h3>
                        <p class="mt-1 text-sm text-gray-600">Hesabınıza ait kişisel bilgileriniz.</p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form @submit.prevent="submit">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <FormInput label="Ad" v-model="form.first_name" :error="form.errors.first_name" class="block w-full"></FormInput>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <FormInput label="Soyad" v-model="form.last_name" :error="form.errors.last_name" class="block w-full"></FormInput>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <FormInput label="E-Posta" v-model="form.email" :error="form.errors.email" class="block w-full">
                                            <template  #icon>
                                                <CheckCircleIcon v-if="auth.user.email_verified_at" class="h-5 w-5 text-green-500" aria-hidden="true" />
                                                <ExclamationIcon v-else class="h-5 w-5 text-orange-500" aria-hidden="true" />
                                            </template>
                                        </FormInput>
                                        <div v-if="!auth.user.email_verified_at" class="text-sm text-orange-500 mt-2">E-Posta onayı gerekli </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <va-button :loading="form.processing" :disabled="!form.isDirty"
                                           type="submit">Kaydet</va-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-200" />
            </div>
        </div>

        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Güvenlik</h3>
                        <p class="mt-1 text-sm text-gray-600">Hesap güvenlik seçenekleri ve şifreniz.</p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form @submit.prevent="submitPassword">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <FormInput label="Şifre" v-model="formPassword.password"
                                                   :error="formPassword.errors.password" class="block w-full"></FormInput>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <FormInput label="Şifre Tekrar" v-model="formPassword.password_confirmation"
                                                   :error="formPassword.errors.password_confirmation" class="block w-full"></FormInput>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <va-button :loading="formPassword.processing" :disabled="!formPassword.isDirty"
                                           type="submit">Kaydet</va-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Authenticated>
</template>

<script setup>
import Authenticated from "@/Layouts/Authenticated";
import {Head, useForm} from "@inertiajs/inertia-vue3"
import FormInput from "@/Components/vaInput";
import VaButton from "@/Components/vaButton";
import 'notyf/notyf.min.css';
import { CheckCircleIcon,ExclamationIcon } from '@heroicons/vue/solid'

const props = defineProps(['auth'])

const form = useForm({
    first_name: props.auth.user.first_name,
    last_name: props.auth.user.last_name,
    email: props.auth.user.email
})
const formPassword = useForm({
    password: null,
    password_confirmation: null
})

const submit = () => {
    form.put(route('account.update'),{
        preserveScroll:true,
        onSuccess: (page) => {
            form.first_name = page.props.auth.user.first_name
            form.last_name = page.props.auth.user.last_name
            form.email = page.props.auth.user.email
        }
    })
}
const submitPassword = () => {
    formPassword.put(route('account.password.update'),{
        preserveScroll:true,
        onSuccess: () => {
            formPassword.reset()
        }
    })
}

</script>

<style scoped>

</style>
