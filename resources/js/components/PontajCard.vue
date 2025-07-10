<template>
    <div class="w-full max-w-md rounded-xl border border-gray-200 bg-white p-6 shadow-lg">
        <div class="mb-6 text-center">
            <h1 class="mb-2 text-xl font-bold text-gray-900">Începe pontajul</h1>
            <p class="text-sm text-gray-600">Selectează data pentru pontaj</p>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Data</label>
            <input
                type="date"
                v-model="date"
                class="mt-1 w-full cursor-pointer rounded-lg border border-gray-300 px-4 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
            />
            <p class="text-xs text-red-500 mt-2">{{ errorMessage }}</p>
        </div>

        <button
            @click="startPontaj"
            class="w-full cursor-pointer rounded-lg bg-blue-500 px-6 py-3 text-sm font-medium text-white transition transition-all hover:bg-blue-700"
        >
            Începe pontajul
        </button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            date: new Date().toISOString().split('T')[0],
            errorMessage: null,
        };
    },
    methods: {
        startPontaj() {
            axios
                .get(`/activities/${this.date}/verify`)
                .then((response) => {
                    if (response.status == 200 && response.data.message == 'Totul este in regula') {
                        this.$emit('start', { date: this.date });
                    } else {
                        this.errorMessage = response.data.message;
                    }
                })
                .catch((errors) => {
                    console.error(errors);
                });
        },
    },
};
</script>

<style scoped></style>
