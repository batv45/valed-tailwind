<script setup>
import {
    BriefcaseIcon,
    CalendarIcon,
    CheckIcon,
    ChevronDownIcon,
    CurrencyDollarIcon,
    LinkIcon,
    LocationMarkerIcon,
    PencilIcon,
} from '@heroicons/vue/solid'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import VaButton from "@/Components/vaButton";
import {ChevronLeftIcon} from "vue-tabler-icons"
import VaLink from "@/Components/vaLink"

defineProps({
    title:String,
    subTitle:String,
    backHref: String,
    backText: {
        type: String,
        default: 'Geri Dön'
    }
})

</script>

<template>
    <div class="lg:flex lg:items-center lg:justify-between mb-5">
        <div class="flex-1 min-w-0">
            <h1 class="text-xl font-semibold text-gray-900">{{title}}</h1>
            <p class="mt-2 text-sm text-gray-700 flex">
                <slot name="sub-title">{{subTitle}}</slot>
            </p>
        </div>
        <div class="mt-5 flex lg:mt-0 lg:ml-4">
            <div class="sm:ml-3 flex">
               <slot name="actions"></slot>
                <va-link v-if="backHref" :href="backHref" class="ml-3">

                    <ChevronLeftIcon   aria-hidden="true" />
                    {{backText}}
                </va-link>
            </div>
        </div>
    </div>
</template>
