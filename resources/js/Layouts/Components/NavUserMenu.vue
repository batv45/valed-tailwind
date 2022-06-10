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

const logout = () => {
    alert('baba')
    Inertia.post(route('logout'))
}
</script>

<template>
    <Menu as="div" class="ml-3 relative">
        <div>
            <MenuButton class="max-w-xs bg-white flex items-center text-sm">
                <div class="flex items-center">
                    <div>
                        <img class="inline-block h-9 w-9 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">{{$page.props.auth.user.first_name}} {{$page.props.auth.user.last_name}}</p>
                        <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700">{{$page.props.auth.user.email}}</p>
                    </div>
                </div>
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
