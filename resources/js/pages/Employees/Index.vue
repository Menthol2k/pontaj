<template>
    <Head title="Angajati" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto mt-10 w-11/12 md:container">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-center text-base font-semibold text-gray-900 md:text-left dark:text-white">Angajati</h1>
                        <p class="mt-2 text-center text-sm text-gray-700 md:text-left dark:text-muted-foreground">
                            Lista cu toti angajatii din societate
                        </p>
                    </div>
                    <div class="mt-4 w-full md:w-auto">
                        <Link
                            href="/employees/create"
                            class="mx-auto block w-full cursor-pointer rounded-md bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm transition-all hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 md:w-fit"
                        >
                            Adauga angajat
                        </Link>
                    </div>
                </div>

                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th
                                            v-for="title in [
                                                'Nume',
                                                'Telefon',
                                                'Adresă',
                                                'Calificare',
                                                'Locație',
                                                'Carte de munca',
                                                'Angajat din',
                                                'Demis in',
                                                'Status',
                                                'Observații',
                                                'Actiuni',
                                            ]"
                                            :key="title"
                                            class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900 md:text-sm dark:text-gray-100"
                                        >
                                            {{ title }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-background">
                                    <tr v-if="employee.data.length == 0">
                                        <td colspan="11">
                                            <div class="py-2 text-center text-gray-600 sm:text-[10px] md:text-sm dark:text-gray-300">
                                                Nu au fost gasite inregistrari
                                            </div>
                                        </td>
                                    </tr>

                                    <tr
                                        v-else
                                        v-for="employee in employee.data"
                                        :key="employee.id"
                                        class="even:bg-gray-50 dark:even:bg-sidebar-border"
                                    >
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ employee.first_name + ' ' + employee.last_name }}
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ employee.phone_number }}
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ employee.adresa }}
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ employee.position }}
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ employee.location }}
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm whitespace-nowrap sm:pl-3">
                                            <span
                                                v-if="employee.workbook"
                                                class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset dark:bg-green-900/20 dark:text-green-300"
                                                >Da</span
                                            >
                                            <span
                                                v-else
                                                class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-red-600/10 ring-inset dark:bg-red-900/20 dark:text-red-300"
                                                >Nu</span
                                            >
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ moment(employee.hired_at).format('DD/MM/YYYY') }}
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            <span
                                                v-if="employee.left_at"
                                                class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-red-600/10 ring-inset dark:bg-red-900/20 dark:text-red-300"
                                            >
                                                {{ moment(employee.left_at).format('DD/MM/YYYY') }}
                                            </span>
                                            <span v-else class="text-gray-500 dark:text-gray-400">-</span>
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            <span
                                                v-if="employee.status"
                                                class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset dark:bg-green-900/20 dark:text-green-300"
                                                >Activ</span
                                            >
                                            <span
                                                v-else
                                                class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-red-600/10 ring-inset dark:bg-red-900/20 dark:text-red-300"
                                                >Inactiv</span
                                            >
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                            {{ employee.obs ? employee.obs : '-' }}
                                        </td>
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-green-600 sm:pl-3 dark:text-green-400">
                                            <Link
                                                :href="`/employees/${employee.id}/edit`"
                                                class="hover:text-gray-100 font-extrabold dark:hover:text-white bg-green-500 text-white px-2 py-1.5 rounded hover:bg-green-600 transition-all"
                                                >Modifica</Link>
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

export default {
    components: {
        AppLayout,
        Head,
        Link,
    },

    props: {
        employee: Object,
    },

    data() {
        return {
            breadcrumbs: [
                {
                    title: 'Angajati',
                    href: '/employees',
                },
            ],
        };
    },

    created() {
        this.moment = moment;
    },
};
</script>
