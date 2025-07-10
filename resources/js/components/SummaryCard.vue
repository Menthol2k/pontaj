<template>
    <div class="mx-auto max-w-xl rounded-2xl border border-gray-200 bg-white p-8 shadow-xl">
        <h2 class="mb-6 text-center text-2xl font-semibold text-gray-800">Sumar pontaj</h2>

        <div v-if="data.length === 0" class="text-center text-gray-400 italic">Nu există date introduse.</div>

        <ul v-else class="space-y-6">
            <li v-for="(employee, index) in groupedData" :key="index" class="border-b border-gray-100 pb-4 last:border-b-0">
                <div class="text-lg font-medium text-gray-700">{{ employee.name }}</div>
                <ul class="mt-2 space-y-1 pl-4 text-sm text-gray-600">
                    <li v-for="(entry, idx) in employee.entries" :key="idx" class="leading-relaxed">
                        <span class="font-semibold text-gray-800">Data:</span> {{ entry.date }}<br />
                        <span class="font-semibold text-gray-800">Tip:</span> <span class="capitalize">{{ entry.type }}</span
                        ><br />
                        <span class="font-semibold text-gray-800">Preț:</span> {{ getPrice(entry.type) }} Lei
                    </li>
                </ul>
            </li>
        </ul>

        <div class="mt-6 border-t border-gray-200 pt-6 text-center text-xl font-bold text-gray-800">Total general: {{ totalSum }} Lei</div>
        <div class="text-center text-gray-500">
            <small class="mt-6 border-gray-200 pt-6 text-center font-bold">
                {{ moment(groupedData[0].entries[0].date).format('DD/MM/YYYY') }}
            </small>
        </div>

        <div class="mt-8 flex flex-col space-y-3">
            <button @click="$emit('confirm')" class="cursor-pointer w-full rounded-xl bg-blue-600 px-6 py-3 text-white transition hover:bg-blue-700">
                Confirmă pontaj
            </button>
            <button @click="$emit('previous')" class="cursor-pointer w-full rounded-xl bg-gray-500 px-6 py-3 text-white transition hover:bg-gray-600">Înapoi</button>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    props: {
        data: {
            type: Array,
            required: true,
        },
    },
    computed: {
        groupedData() {
            const grouped = {};

            for (const entry of this.data) {
                const name = `${entry.employee.first_name} ${entry.employee.last_name}`;
                if (!grouped[name]) {
                    grouped[name] = {
                        name,
                        entries: [],
                        total: 0,
                    };
                }
                const price = this.getPrice(entry.type);
                grouped[name].entries.push(entry);
                grouped[name].total += price;
            }

            return Object.values(grouped);
        },
        totalSum() {
            return this.groupedData.reduce((sum, emp) => sum + emp.total, 0);
        },
    },
    methods: {
        getPrice(type) {
            switch (type.toLowerCase()) {
                case 'birou':
                    return 300;
                case 'deplasare':
                    return 350;
                case 'absent':
                default:
                    return 0;
            }
        },
    },
    created() {
        this.moment = moment;
    },
};
</script>
