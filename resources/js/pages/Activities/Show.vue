<template>
    <Head :title="`Săptămâna ${activities[0].week}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto mt-10 px-2">
            <h1 class="mb-4 text-2xl font-bold">Activități - Săptămâna {{ activities[0].week }}</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full rounded border border-gray-200 bg-white shadow">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border-b px-4 py-2 text-left">#</th>
                            <th class="border-b px-4 py-2 text-left">Nume angajat</th>
                            <th class="border-b px-4 py-2 text-left">Telefon</th>
                            <th class="border-b px-4 py-2 text-left">Tip activitate</th>
                            <th class="border-b px-4 py-2 text-left">Dată</th>
                            <th class="border-b px-4 py-2 text-left">Săptămână</th>
                            <th class="border-b px-4 py-2 text-left">Preț</th>
                            <th class="border-b px-4 py-2 text-left">Locație</th>
                            <th class="border-b px-4 py-2 text-left">Poziție</th>
                            <th class="border-b px-4 py-2 text-left">Creat de</th>
                            <th class="border-b px-4 py-2 text-left">Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(activity, index) in activities" :key="activity.id" class="hover:bg-gray-50">
                            <td class="border-b px-4 py-2">{{ index + 1 }}</td>
                            <td class="border-b px-4 py-2">{{ activity.employee.first_name }} {{ activity.employee.last_name }}</td>
                            <td class="border-b px-4 py-2">{{ activity.employee.phone_number }}</td>
                            <td class="border-b px-4 py-2 capitalize">{{ activity.type }}</td>
                            <td class="border-b px-4 py-2">{{ moment(activity.date).format('DD/MM/YYYY') }}</td>
                            <td class="border-b px-4 py-2">{{ activity.week }}</td>
                            <td class="border-b px-4 py-2">{{ activity.price }} RON</td>
                            <td class="border-b px-4 py-2">{{ activity.employee.location }}</td>
                            <td class="border-b px-4 py-2">{{ activity.employee.position }}</td>
                            <td class="border-b px-4 py-2">{{ activity.created_by.name }}</td>
                            <td class="border-b px-4 py-2">
                                <Link
                                    :href="`/activities/${activity.id}/edit`"
                                    class="rounded bg-blue-500 px-3 py-1 text-sm font-semibold text-white hover:bg-blue-600"
                                >
                                    Modifică
                                </Link>
                            </td>
                        </tr>
                        <tr class="bg-gray-100 font-bold">
                            <td class="border-t px-4 py-2 text-right" colspan="6">Total general</td>
                            <td class="border-t px-4 py-2">{{ totalPrice }} RON</td>
                            <td class="border-t px-4 py-2" colspan="4"></td>
                        </tr>
                    </tbody>
                </table>
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
        activities: Array,
    },

    data() {
        return {
            breadcrumbs: [
                {
                    title: 'Activitate',
                    href: '/activities',
                },
                {
                    title: 'Sumar săptămâna ' + this.activities[0]?.week,
                    href: '/activities/' + this.activities[0]?.id + '/show',
                },
            ],
        };
    },

    computed: {
        totalPrice() {
            return this.activities
                .reduce((total, act) => {
                    return total + parseFloat(act.price);
                }, 0)
                .toFixed(2);
        },
    },

    created() {
        this.moment = moment;
    },
};
</script>
