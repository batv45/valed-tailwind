<script setup>
import {
    Menu,
    MenuButton,
    MenuItem,
    MenuItems
} from '@headlessui/vue'
import {Inertia} from "@inertiajs/inertia";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink"
import { Link } from '@inertiajs/inertia-vue3';
import VaUserInfo from "@/Components/vaUserInfo";

const logout = () => {
    alert('baba')
    Inertia.post(route('logout'))
}
</script>

<template>
    <Menu as="div" class="ml-3 relative">
        <div>
            <MenuButton class="max-w-xs bg-white flex items-center text-sm">
                <VaUserInfo avatar :user="$page.props.auth.user"></VaUserInfo>
            </MenuButton>
        </div>
        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
            <MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none divide-y">
                <div class="px-4 py-3">
                    <p class="text-sm">Hoş geldin</p>
                    <p class="text-sm font-bold text-gray-900 truncate">{{ $page.props.auth.user.first_name }}</p>
                </div>
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <Link :href="route('account')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Hesabım</Link>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <Link :href="route('account.settings')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Ayarlar</Link>
                    </MenuItem>
                </div>
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <Link :href="route('logout')" method="post" as="button" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block w-full text-left px-4 py-2 text-sm']">Oturumu Kapat</Link>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>


<style scoped>

</style>
