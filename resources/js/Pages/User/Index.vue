<template>
    <Authenticated>
        <PageHeader :back-href="route('dashboard')" title="Kullanıcılar" sub-title="Sistemde kayıtlı tüm kullanıcılar">
            <template #actions>
                <va-link :href="route('user.create')" v-tippy="'Yeni Kullanıcı Ekle'"><plus-icon></plus-icon> Yeni Ekle</va-link>
            </template>
        </PageHeader>
        <Table
            :filters="queryBuilderProps.filters"
            :search="queryBuilderProps.search"
            :columns="queryBuilderProps.columns"
            :on-update="setQueryBuilder"
            :meta="page_users"
        >
            <template #head>
                <tr>
                    <th @click.prevent="sortBy('first_name')">
                        <SortAscendingIcon v-show="sortableHeader('first_name').sort === 'desc'" class="icon inline-flex"/>
                        <SortDescendingIcon v-show="sortableHeader('first_name').sort === 'asc'" class="icon inline-flex"/>
                        Ad Soyad</th>
                    <th @click.prevent="sortBy( 'email')">
                        <SortAscendingIcon v-show="sortableHeader('email').sort === 'desc'" class="icon inline-flex"/>
                        <SortDescendingIcon v-show="sortableHeader('email').sort === 'asc'" class="icon inline-flex"/>
                        E-Posta</th>
                    <th @click.prevent="sortReset" :class="{'cursor-pointer':route().params.sort}"  class="w-1 text-right pt-0" style="padding-top:.4rem;padding-bottom:.4rem">
                        <span v-if="route().params.sort">
                            <XCircleIcon class="icon text-red-600 h-6 ml-auto outline-0" v-tippy="'Sıralamayı temizle'"></XCircleIcon>
                        </span>
                    </th>
                </tr>
            </template>

            <template #body>
                <tr v-for="user in page_users.data" :key="user.id">
                    <td><VaUserInfo show-id avatar email :user="user"></VaUserInfo></td>
                    <td>{{ user.email }}</td>
                    <td>
                        <va-link :href="route('user.show',user)" class="va-button-white">Görüntüle</va-link>
                    </td>
                </tr>
            </template>
        </Table>
    </Authenticated>
</template>

<script setup>

import Authenticated from "@/Layouts/Authenticated";
import PageHeader from "@/Components/PageHeader";
import VaLink from "@/Components/vaLink";
import {ref} from "vue"
import {PlusIcon} from "vue-tabler-icons"
import {SortAscendingIcon,SortDescendingIcon} from "@heroicons/vue/outline"
import {XCircleIcon} from "@heroicons/vue/solid"
import VaUserInfo from "@/Components/vaUserInfo";
import {Inertia} from "@inertiajs/inertia";

defineProps({
    page_users: Object
})

 const sortReset = () => {
    const params = route().params
     if( params.sort ){
         params.sort = undefined
         Inertia.get(route('user.index',params))
     }
 }

</script>

<script>
import { InteractsWithQueryBuilder, Tailwind2 } from '@protonemedia/inertiajs-tables-laravel-query-builder';
import {Tailwind3} from '@/Components/Tables/Tailwind3'

export default {
    mixins: [InteractsWithQueryBuilder],

    components: {
        Table: Tailwind3.Table
    }
};
</script>
