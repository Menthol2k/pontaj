<template>
    <div class="w-full max-w-md rounded-xl border border-gray-200 bg-white p-6 shadow-lg">
        <div class="mb-6 text-center">
            <div class="relative mt-4 flex items-center justify-center">
                <div class="absolute left-0">
                    <button @click="$emit('prev')" class="rounded-lg cursor-pointer transition-all bg-gray-300 px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-400">
                        Înapoi
                    </button>
                </div>
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gray-800">
                    <span class="text-lg font-bold text-white">
                        <pre>{{ PrintFirstLetter(employee.first_name + ' ' + employee.last_name) }}</pre>
                    </span>
                </div>
            </div>
            <h1 class="mb-2 text-xl font-bold text-gray-900">{{ employee.first_name }} {{ employee.last_name }}</h1>
            <div class="flex items-center justify-center space-x-3 text-sm">
                <span class="rounded-full bg-gray-100 px-3 py-1 text-gray-700">{{ employee.position }}</span>
                <span class="rounded-full bg-blue-100 px-3 py-1 text-blue-700">{{ employee.location }}</span>
            </div>
        </div>

        <div class="mb-6 grid grid-cols-2 gap-3 text-sm">
            <div class="rounded-lg bg-gray-50 p-3">
                <div class="mb-1 text-gray-500">Telefon</div>
                <div class="font-medium text-gray-900">{{ employee.phone_number }}</div>
            </div>
            <div class="rounded-lg bg-gray-50 p-3">
                <div class="mb-1 text-gray-500">Adresa</div>
                <div class="font-medium text-gray-900">{{ employee.adresa }}</div>
            </div>
            <div class="rounded-lg bg-gray-50 p-3">
                <div class="mb-1 text-gray-500">Angajat din</div>
                <div class="font-medium text-gray-900">{{ moment(employee.hired_at).format('DD/MM/YYYY') }}</div>
            </div>
            <div class="rounded-lg bg-gray-50 p-3">
                <div class="mb-1 text-gray-500">Status</div>
                <div class="flex items-center">
                    <div class="mr-2 h-2 w-2 rounded-full bg-green-500"></div>
                    <span class="font-medium text-gray-900">{{ employee.status ? 'Activ' : 'Inactiv' }}</span>
                </div>
            </div>
        </div>

        <div class="space-y-3">
            <h2 class="mb-4 text-center text-lg font-semibold text-gray-900">Pontaj</h2>

            <button @click="$emit('next', 'absent', employee)"
                class="w-full cursor-pointer rounded-lg bg-red-500 px-6 py-3 font-medium text-white transition-colors duration-200 hover:bg-red-700"
            >
                <div class="flex items-center justify-center space-x-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span>Absent</span>
                </div>
            </button>

            <button @click="$emit('next', 'birou', employee)"
                class="w-full cursor-pointer rounded-lg bg-blue-500 px-6 py-3 font-medium text-white transition-colors duration-200 hover:bg-blue-700"
            >
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                            ></path>
                        </svg>
                        <span>Birou</span>
                    </div>
                    <span class="rounded-full bg-white/20 px-3 py-1 text-sm">300 Lei</span>
                </div>
            </button>

            <button @click="$emit('next', 'deplasare', employee)"
                class="w-full cursor-pointer rounded-lg bg-green-500 px-6 py-3 font-medium text-white transition-colors duration-200 hover:bg-green-700"
            >
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                            ></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Deplasare</span>
                    </div>
                    <span class="rounded-full bg-white/20 px-3 py-1 text-sm">350 Lei</span>
                </div>
            </button>
        </div>

        <div class="mt-6 text-center">
            <div class="text-sm text-gray-500">
                <span>{{ moment().format('DD/MM/YYYY') }}</span> | <span>{{ current }} din {{ totalEmployees }}</span>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment';

export default {
    props: {
        employee: Object,
        current: Number,
        totalEmployees: Number,
    },

    methods: {
        PrintFirstLetter(word) {
            if (!word) return '';
            return word
                .split(' ')
                .map((w) => w[0])
                .join('');
        },
    },

    created() {
        this.moment = moment;
    },
};
</script>
