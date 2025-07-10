<template>
    <Head title="Activitate" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto mt-10 w-11/12 md:container">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-center text-base font-semibold text-gray-900 md:text-left dark:text-white">Pontaje</h1>
                        <p class="mt-2 text-center text-sm text-gray-700 md:text-left dark:text-muted-foreground">
                            Lista cu toate pontajele zilnice ale angajatilor
                        </p>
                    </div>
                    <div class="mt-4 w-full md:w-auto md:flex items-center">
                        <Link
                            href="/activities/create"
                            class="mx-auto block w-full cursor-pointer rounded-md bg-gray-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm transition-all hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 md:w-fit"
                        >
                            Adauga pontaj
                        </Link>
                        <button @click="exportExcel"
                            class="mx-auto block w-full md:mt-0 mt-2 md:ml-2 ml-0 cursor-pointer rounded-md bg-green-800 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm transition-all hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 md:w-fit"
                        >
                            EXPORT EXCEL
                        </button>
                    </div>
                </div>

                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900 md:text-sm dark:text-gray-100">
                                            ID PONTAJ
                                        </th>
                                        <th class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900 md:text-sm dark:text-gray-100">Data</th>
                                        <th class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900 md:text-sm dark:text-gray-100">Saptamana</th>
                                        <th class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900 md:text-sm dark:text-gray-100">
                                            Angajati
                                        </th>
                                        <th class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900 md:text-sm dark:text-gray-100">Total</th>
                                        <th class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900 md:text-sm dark:text-gray-100">
                                            Creat de
                                        </th>
                                        <th class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900 md:text-sm dark:text-gray-100">
                                            Actiuni
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-background">
                                    <tr v-if="adays.data.length == 0">
                                        <td colspan="11">
                                            <div class="py-2 text-center text-gray-600 sm:text-[10px] md:text-sm dark:text-gray-300">
                                                Nu au fost gasite inregistrari
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-else v-for="aday in adays.data" :key="aday.id" class="even:bg-gray-50 dark:even:bg-sidebar-border">
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ aday.id }}
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ moment(aday.date).format('DD/MM/YYYY') }}
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ aday.week }}
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ aday.activities_count }}
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ aday.grand_total }} lei
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ aday.created_by.name }}
                                        </td>
                                        <td class="py-4 space-x-2 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            <Link
                                                :href="`/activities/${aday.id}/edit`"
                                                class="rounded bg-green-500 px-2 py-1.5 font-extrabold text-white transition-all hover:bg-green-600 hover:text-gray-100 dark:hover:text-white"
                                                >Modifica</Link
                                            >
                                            <Link
                                                :href="`/activities/${aday.id}/edit`"
                                                class="rounded bg-blue-500 px-2 py-1.5 font-extrabold text-white transition-all hover:bg-blue-600 hover:text-gray-100 dark:hover:text-white"
                                                >Vezi</Link
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment';
import axiosLink from '@/axiosLink'

export default {
    components: {
        AppLayout,
        Head,
        Link,
    },

    props: {
        adays: Object,
    },

    data() {
        return {
            breadcrumbs: [
                {
                    title: 'Activitate',
                    href: '/activities',
                },
            ],
            exporting: false,
        };
    },

    methods: {
		async exportExcel() {
			this.exporting = true;
			await axiosLink('/activities/export/28/2025', 'pontaj.xlsx');
			this.exporting = false;
		},
    },

    created() {
        this.moment = moment;
    },
};
</script>
