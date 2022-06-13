<template>
    <authenticated>
        <PageHeader title="Kullanıcı Hesabı" :back-href="route('user.index')">
            <template #sub-title>
                <user-icon></user-icon> {{page_user.full_name}}
                <mail-icon class="ml-2" stroke-width="1.5"/> {{page_user.email}}
            </template>
            <template #actions>
                <Menu as="div" class="relative  text-left">
                    <div>
                        <MenuButton class="va-button ">
                            Seçenekler
                            <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
                        </MenuButton>
                    </div>

                    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                        <MenuItems class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none divide-y divide-gray-100">
                            <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <Link :href="route('user.edit',page_user)" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex items-center px-4 py-2 text-sm']">
                                        <PencilAltIcon class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                        Düzenle
                                    </Link>
                                </MenuItem>
                            </div>
                            <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a href="#" @click.prevent="startDelete = true" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex items-center px-4 py-2 text-sm']">
                                        <TrashIcon class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                        Sil
                                    </a>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </template>
        </PageHeader>
        <va-confirm :show="startDelete"
                    @confirm="userDelete(); startDelete = false" @cancel="startDelete = false"
                    title="Hesap silme onayı"
                    content="Bu kullanıcı hesabını silmek istediğinize emin misiniz?"></va-confirm>
    </authenticated>
</template>

<script setup>
import Authenticated from "@/Layouts/Authenticated";
import PageHeader from "@/Components/PageHeader";
import {UserIcon,MailIcon,EditIcon} from "vue-tabler-icons"
import VaConfirm from "@/Components/vaConfirm"
import {Link} from "@inertiajs/inertia-vue3"
import {ref} from "vue"
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/solid'
import { PencilAltIcon,TrashIcon } from '@heroicons/vue/outline'
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    page_user: Object
})
const startDelete = ref(false)
const userDelete = () => {
    Inertia.delete(route('user.destroy',props.page_user))
}



</script>
