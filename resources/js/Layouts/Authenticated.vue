<script setup>
import { ref } from 'vue'
import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import {
    BellIcon,
    MenuAlt2Icon,
    XIcon,
} from '@heroicons/vue/outline'
import { UserSearchIcon } from 'vue-tabler-icons'
import BreezeApplicationLogo from "@/Components/ApplicationLogo"
import {Link} from "@inertiajs/inertia-vue3"
import NavMenu from "./Components/NavMenu"
import NavUserMenu from "@/Layouts/Components/NavUserMenu";
import {Inertia} from "@inertiajs/inertia";

const sidebarOpen = ref(false)

const query = ref()

const submitSearch = () => {
    Inertia.get(encodeURI(route('user.index',{
        'filter[global]':query.value
    })))
}

</script>

<template>
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog as="div" class="fixed inset-0 flex z-40 md:hidden" @close="sidebarOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 bg-gray-600 bg-opacity-75" />
                </TransitionChild>
                <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                    <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-gray-800">
                        <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
                                    <span class="sr-only">Close sidebar</span>
                                    <XIcon class="h-6 w-6 text-white" aria-hidden="true" />
                                </button>
                            </div>
                        </TransitionChild>
                        <div class="flex-shrink-0 flex items-center px-4">
                            <Link :href="route('dashboard')" class="flex">
                                <BreezeApplicationLogo class="block h-9 w-auto" />
                                <span class=" self-center ml-3 text-2xl text-gray-300 font-thin">Valed</span>
                            </Link>
                        </div>
                        <div class="mt-5 flex-1 h-0 overflow-y-auto">
                            <nav class="px-2 space-y-1">
                                <NavMenu></NavMenu>
                            </nav>
                        </div>
                    </div>
                </TransitionChild>
                <div class="flex-shrink-0 w-14" aria-hidden="true">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex-1 flex flex-col min-h-0 bg-gray-800">
                <div class="flex items-center h-16 flex-shrink-0 px-4 bg-gray-900">
                    <Link :href="route('dashboard')" class="flex">
                        <BreezeApplicationLogo class="block h-9 w-auto" />
                        <span class=" self-center ml-3 text-2xl text-gray-300 font-thin">Valed</span>
                    </Link>
                </div>
                <div class="flex-1 flex flex-col overflow-y-auto">
                    <nav class="flex-1 px-2 py-4 pr-3 space-y-1">
                        <!-- Profile dropdown -->
                        <NavMenu></NavMenu>
                    </nav>
                </div>
            </div>
        </div>
        <div class="md:pl-64 flex flex-col">
            <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
                <button type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500 md:hidden" @click="sidebarOpen = true">
                    <span class="sr-only">Open sidebar</span>
                    <MenuAlt2Icon class="h-6 w-6" aria-hidden="true" />
                </button>
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1 flex">
                        <form class="w-full flex md:ml-0" @submit.prevent="submitSearch">
                            <label for="search-field" class="sr-only">Search</label>
                            <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                                    <UserSearchIcon class="h-5 w-5" aria-hidden="true" />
                                </div>
                                <input v-model="query" id="search-field" class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400
                                focus:ring-0 focus:border-transparent sm:text-sm"
                                       placeholder="Kullanıcı Ara" type="search" name="search" autocomplete="off" />
                            </div>
                        </form>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <button type="button" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <span class="sr-only">View notifications</span>
                            <BellIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                        <NavUserMenu></NavUserMenu>
                    </div>
                </div>
            </div>

            <main class="flex-1">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 ">
                   <slot />
                </div>
            </main>
        </div>
    </div>
</template>


<style>

</style>
