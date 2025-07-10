<template>
    <Head title="Adaugare activitate" />
    <AppLayout :breadcrumbs="breadcrumbs" class="relative overflow-hidden">
        <!-- Dacă pontajul nu a început, afișăm cardul de dată -->
        <div v-if="!started" class="mt-10 flex justify-center">
            <PontajCard @start="handleStartPontaj" />
        </div>

        <div v-else-if="started && currentIndex == employees.length" class="mt-0 md:mt-5">
            <SummaryCard v-if="showSummary" :data="data" @confirm="handleConfirm" @previous="returnToCards" />
        </div>

        <!-- După start, afișăm animațiile pentru angajați -->
        <div v-else-if="started" class="relative mx-auto mt-10 min-h-[400px] w-11/12 max-w-md">
            <TransitionRoot :show="showCard" @after-leave="afterLeave" appear>
                <TransitionChild
                    :key="employees[currentIndex]?.id ?? currentIndex"
                    as="div"
                    :enter="
                        transitionDirection === 'next'
                            ? 'transform transition ease-in-out duration-500'
                            : 'transform transition ease-in-out duration-500'
                    "
                    :enter-from="transitionDirection === 'next' ? 'translate-x-full opacity-0' : '-translate-x-full opacity-0'"
                    enter-to="translate-x-0 opacity-100"
                    leave="transform transition ease-in-out duration-500 absolute inset-0"
                    leave-from="translate-x-0 opacity-100"
                    :leave-to="transitionDirection === 'next' ? '-translate-x-full opacity-0' : 'translate-x-full opacity-0'"
                >
                    <Card
                        :employee="employees[currentIndex]"
                        :totalEmployees="employees.length"
                        :current="currentIndex + 1"
                        @next="startNext"
                        @prev="startPrev"
                    />
                </TransitionChild>
            </TransitionRoot>
        </div>
    </AppLayout>
</template>

<script>
import Card from '@/components/Card.vue';
import PontajCard from '@/components/PontajCard.vue';
import SummaryCard from '@/components/SummaryCard.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { TransitionChild, TransitionRoot } from '@headlessui/vue';
import { Head } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
        Head,
        Card,
        TransitionRoot,
        TransitionChild,
        PontajCard,
        SummaryCard,
    },

    props: {
        employees: Object,
    },

    data() {
        return {
            started: false,
            selectedDate: null,
            currentIndex: 0,
            showCard: true,
            pendingIndex: null,
            showSummary: false,
            transitionDirection: 'next',
            breadcrumbs: [
                { title: 'Activitate', href: '/activities' },
                { title: 'Adaugare activitate', href: '/activities/create' },
            ],
            data: [],
        };
    },

    methods: {
        handleStartPontaj({ date }) {
            this.selectedDate = date;
            this.started = true;
        },

        startNext(type, employee) {
            if (!employee || !type) return;

            const existingIndex = this.data.findIndex((entry) => entry.employee_id === employee.id);

            const newEntry = {
                employee_id: employee.id,
                type,
                date: this.selectedDate,
                employee: employee,
            };

            if (existingIndex !== -1) {
                this.data.splice(existingIndex, 1, newEntry);
            } else {
                this.data.push(newEntry);
            }

            if (this.currentIndex < this.employees.length - 1) {
                this.transitionDirection = 'next';
                this.pendingIndex = this.currentIndex + 1;
                this.showCard = false;
            } else {
                this.pendingIndex = this.employees.length;
                this.showSummary = true;
                this.showCard = false;
            }
        },

        startPrev() {
            if (this.currentIndex > 0) {
                this.transitionDirection = 'prev';
                this.pendingIndex = this.currentIndex - 1;
                this.showCard = false;
            } else {
                this.showCard = false;
                this.$nextTick(() => {
                    this.started = false;
                });
            }
        },

        returnToCards() {
            this.transitionDirection = 'prev';
            this.currentIndex = this.currentIndex - 1;
            this.pendingIndex = this.employees.length - 1;
            this.showSummary = false;

            this.$nextTick(() => {
                this.showCard = true;
            });
        },

        afterLeave() {
            if (this.pendingIndex !== null) {
                this.currentIndex = this.pendingIndex;
                this.pendingIndex = null;
            }
            this.$nextTick(() => {
                this.showCard = true;
            });
        },

        handleConfirm() {
            this.$inertia.post('/activities/store', this.data, {
                inline: 'default',
                onError: (errors) => {
                    console.error(errors);
                },
            });
        },
    },
};
</script>
