<template>
    <BreezeNavLink v-for="item in navigation" :href="item.route ? route(item.route) : (item.href ? item.href : '#') " :active="item.active">
        <component :is="item.icon" :class="[item.active ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300', 'mr-3 flex-shrink-0 h-6 w-6']" aria-hidden="true" />
        {{ item.name }}
    </BreezeNavLink>
</template>

<script setup>
import BreezeNavLink from '@/Components/NavLink.vue';
import {HomeIcon} from "@heroicons/vue/outline";
import {AwardIcon, UsersIcon} from "vue-tabler-icons";

const navigation = [
    { name: 'Ana Sayfa', route: 'dashboard', icon: HomeIcon, active: route().current('dashboard.*') },
    { name: 'Kullanıcılar', route: 'user.index', icon: UsersIcon, active: route().current('user.*') },
    { name: 'Test', route:'test', icon: AwardIcon, active: route().current('test')}
]
</script>

<style scoped>

</style>

