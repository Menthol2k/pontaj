<template>
    <Head :title="'Modificare pontaj ' + activity.employee.first_name + ' ' + activity.employee.last_name" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <form @submit.prevent="submitForm" class="container mx-auto mt-10 space-y-4 rounded bg-white p-4 shadow">
            <div class="mb-6 text-center">
                <div class="relative mt-4 flex items-center justify-center">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gray-800">
                        <span class="text-lg font-bold text-white">
                            <pre>{{ PrintFirstLetter(activity.employee.first_name + ' ' + activity.employee.last_name) }}</pre>
                        </span>
                    </div>
                </div>
                <h1 class="mb-2 text-xl font-bold text-gray-900">{{ activity.employee.first_name }} {{ activity.employee.last_name }}</h1>
                <div class="flex items-center justify-center space-x-3 text-sm">
                    <span class="rounded-full bg-gray-100 px-3 py-1 text-gray-700">{{ activity.employee.position }}</span>
                    <span class="rounded-full bg-blue-100 px-3 py-1 text-blue-700">{{ activity.employee.location }}</span>
                </div>
                <div class="mt-3 text-sm font-light text-gray-600">Data pontajului: {{ moment(activity.date).format('DD/MM/YYYY') }}</div>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Tip activitate</label>
                <SelectInput v-model="form.type" class="w-full" required>
                    <option value="" disabled>Selectează tipul</option>
                    <option value="absent">Absent</option>
                    <option value="birou">Birou</option>
                    <option value="deplasare">Deplasare</option>
                </SelectInput>
            </div>

            <div class="pt-2">
                <button type="submit" class="cursor-pointer rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Trimite</button>
            </div>
        </form>
    </AppLayout>
</template>
<script>
import SelectInput from '@/components/SelectInput.vue';
import TextInput from '@/components/TextInput.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment';

export default {
    components: {
        AppLayout,
        Head,
        Link,
        TextInput,
        SelectInput,
    },

    props: {
        activity: Object,
    },

    data() {
        return {
            breadcrumbs: [
                {
                    title: 'Activitate',
                    href: '/activities',
                },
                {
                    title: 'Sumar săptămâna ' + this.activity.week,
                    href: '/activities/' + this.activity.activity_day_id + '/show',
                },
                {
                    title: 'Modificare pontaj ' + this.activity.employee.first_name + ' ' + this.activity.employee.last_name,
                    href: '/activities/' + this.activity.id + '/edit',
                },
            ],
            form: this.$inertia.form({
                type: this.activity.type,
            }),
        };
    },

    methods: {
        PrintFirstLetter(word) {
            if (!word) return '';
            return word
                .split(' ')
                .map((w) => w[0])
                .join('');
        },
        submitForm() {
            this.$inertia.patch(`/activities/${this.activity.id}/update`, this.form, {
                inline: 'default',
                onError: (errors) => {
                    console.error(errors);
                },
            });
        },
    },

    created() {
        this.moment = moment;
    },
};
</script>
