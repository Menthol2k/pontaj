<template>
    <Head title="Adaugare angajat" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto mt-10">
            <Title class="px-3 md:px-0">Adauga angajat</Title>
            <div class="rounded-lg bg-gray-50 p-5 shadow">
                <div class="grid grid-cols-12 gap-3">
                    <div class="col-span-12 md:col-span-3">
                        <text-input v-model="form.last_name" type="text" label="Nume" :error="errors.last_name" placeholder="numele de familie..." />
                    </div>
                    <div class="col-span-12 md:col-span-3">
                        <text-input v-model="form.first_name" type="text" label="Prenume" :error="errors.first_name" placeholder="prenumele..." />
                    </div>
                    <div class="col-span-12 md:col-span-3">
                        <text-input
                            v-model="form.phone_number"
                            type="text"
                            label="Numar de telefon"
                            :error="errors.phone_number"
                            placeholder="numarul de telefon..."
                        />
                    </div>
                    <div class="col-span-12 md:col-span-3">
                        <text-input v-model="form.adresa" type="text" label="Adresa" :error="errors.adresa" placeholder="comuna..." />
                    </div>
                    <div class="col-span-12 md:col-span-3">
                        <select-input v-model="form.position" label="Calificare" :error="errors.position">
                            <option :value="null">Alege o optiune...</option>
                            <option :value="'Calificat'">Calificat</option>
                            <option :value="'Necalificat'">Necalificat</option>
                        </select-input>
                    </div>
                    <div class="col-span-12 md:col-span-3">
                        <select-input v-model="form.location" label="Departament" :error="errors.location">
                            <option :value="null">Alege o optiune...</option>
                            <option :value="'Deplasare'">Deplasare</option>
                            <option :value="'Birou'">Birou</option>
                        </select-input>
                    </div>
                    <div class="col-span-12 md:col-span-3">
                        <text-input
                            v-model="form.hired_at"
                            type="date"
                            label="Data angajarii"
                            :error="errors.hired_at"
                            placeholder="data angajarii..."
                        />
                    </div>
                    <div class="col-span-12 md:col-span-3">
                        <text-input
                            v-model="form.left_at"
                            type="date"
                            label="Data demisie"
                            :error="errors.left_at"
                            placeholder="data demisionarii..."
                        />
                    </div>
                    <div class="col-span-12">
                        <TextAreaInput v-model="form.obs" label="Observatii" placeholder="Noteaza-ti toate observatiile aici..." />
                    </div>
                    <div class="col-span-12 gap-3 md:col-span-12 md:flex">
                        <div
                            class="flex items-center gap-3 rounded-lg border-2 border-gray-200 bg-white p-2 transition-all select-none hover:shadow-sm"
                        >
                            <Switcher v-model="form.workbook" />
                            <InputLabel @click="form.workbook = !form.workbook">Angajat cu carte de munca</InputLabel>
                        </div>

                        <div
                            class="mt-2 flex items-center gap-3 rounded-lg border-2 border-gray-200 bg-white p-2 transition-all select-none hover:shadow-sm md:mt-0"
                        >
                            <Switcher v-model="form.status" />
                            <InputLabel @click="form.status = !form.status">Status</InputLabel>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-2 md:col-start-12">
                        <button
                            type="button"
                            @click="submit"
                            :disabled="loading"
                            :class="
                                loading
                                    ? 'animate-pulse cursor-no-drop bg-gray-300'
                                    : 'cursor-pointer bg-gray-600 hover:bg-gray-500 focus-visible:outline-gray-600'
                            "
                            class="inline-flex w-full items-center gap-x-1.5 rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 md:w-auto"
                        >
                            <svg class="-ml-0.5 size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            Salveaza
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import InputLabel from '@/components/InputLabel.vue';
import SelectInput from '@/components/SelectInput.vue';
import Switcher from '@/components/Switcher.vue';
import TextAreaInput from '@/components/TextAreaInput.vue';
import TextInput from '@/components/TextInput.vue';
import Title from '@/components/Title.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
        Head,
        TextInput,
        Title,
        SelectInput,
        Switcher,
        TextAreaInput,
        InputLabel,
    },

    props: {
        errors: Object,
        employee: Object,
    },

    data() {
        return {
            breadcrumbs: [
                {
                    title: 'Angajati',
                    href: '/employees',
                },
                {
                    title: 'Modificare angajat',
                    href: '/employees/create',
                },
            ],
            form: this.$inertia.form({
                first_name: this.employee.first_name,
                last_name: this.employee.last_name,
                phone_number: this.employee.phone_number,
                adresa: this.employee.adresa,
                position: this.employee.position,
                location: this.employee.location,
                hired_at: this.employee.hired_at,
                left_at: this.employee.left_at,
                workbook: this.employee.workbook,
                status: this.employee.status,
                obs: this.employee.obs,
            }),
            loading: false,
        };
    },

    methods: {
        submit() {
            this.loading = true;
            this.$inertia.put(`/employees/${this.employee.id}/update`, this.form, {
                inline: 'default',
                onError: (errors) => {
                    console.error(errors);
                    this.loading = false;
                },
            });
            this.loading = false;
        },
    },
};
</script>
