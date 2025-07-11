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
                    <div class="mt-4 w-full items-center md:flex md:w-auto">
                        <Link
                            href="/activities/create"
                            class="mx-auto block w-full cursor-pointer rounded-md bg-gray-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm transition-all hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 md:w-fit"
                        >
                            Adauga pontaj
                        </Link>
                    </div>
                </div>

                <div class="mt-8 flow-root">
                    <div class="sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <!-- Verifică dacă există date -->
                            <div v-if="adays.data.length == 0" class="py-8 text-center text-gray-600 dark:text-gray-300">
                                Nu au fost gasite inregistrari
                            </div>

                            <!-- Afișează grupurile pe săptămâni -->
                            <div v-else class="space-y-4">
                                <div
                                    v-for="(weekData, week) in groupedByWeek"
                                    :key="week"
                                    class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-background"
                                >
                                    <!-- Header pentru săptămână - clickabil și responsive -->
                                    <div
                                        @click="toggleWeek(week)"
                                        class="cursor-pointer rounded-t-lg border-b border-gray-200 bg-gray-50 p-4 transition-colors hover:bg-gray-100 md:p-6 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                                        :class="{ 'rounded-b-lg border-b-0': !isWeekExpanded(week) }"
                                    >
                                        <!-- Layout pentru desktop -->
                                        <div class="hidden items-center justify-between md:flex">
                                            <div class="flex items-center space-x-3">
                                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Săptămâna {{ week }}</h2>
                                                <!-- Iconică pentru acordeon -->
                                                <svg
                                                    class="h-5 w-5 text-gray-500 transition-transform duration-200"
                                                    :class="{ 'rotate-180': isWeekExpanded(week) }"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                            <div class="flex items-center space-x-6 text-sm">
                                                <div class="flex items-center space-x-2">
                                                    <span
                                                        class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-200"
                                                    >
                                                        {{ weekData.length }} înregistrări
                                                    </span>
                                                    <span
                                                        class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-200"
                                                    >
                                                        {{ calculateWeekTotal(weekData) }} lei
                                                    </span>
                                                </div>
                                                <div class="text-gray-500 dark:text-gray-400">
                                                    {{ getWeekDateRange(weekData) }}
                                                </div>
                                                <div>
                                                    <button
                                                        @click="exportExcel(weekData)"
                                                        class="mx-auto mt-2 ml-0 block w-full cursor-pointer rounded-md bg-green-800 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm transition-all hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 md:mt-0 md:ml-2 md:w-fit"
                                                    >
                                                        <svg
                                                            class="fill-white stroke-2"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            x="0px"
                                                            y="0px"
                                                            width="20"
                                                            height="20"
                                                            viewBox="0 0 50 50"
                                                        >
                                                            <path
                                                                d="M 28.875 0 C 28.855469 0.0078125 28.832031 0.0195313 28.8125 0.03125 L 0.8125 5.34375 C 0.335938 5.433594 -0.0078125 5.855469 0 6.34375 L 0 43.65625 C -0.0078125 44.144531 0.335938 44.566406 0.8125 44.65625 L 28.8125 49.96875 C 29.101563 50.023438 29.402344 49.949219 29.632813 49.761719 C 29.859375 49.574219 29.996094 49.296875 30 49 L 30 44 L 47 44 C 48.09375 44 49 43.09375 49 42 L 49 8 C 49 6.90625 48.09375 6 47 6 L 30 6 L 30 1 C 30.003906 0.710938 29.878906 0.4375 29.664063 0.246094 C 29.449219 0.0546875 29.160156 -0.0351563 28.875 0 Z M 28 2.1875 L 28 6.53125 C 27.867188 6.808594 27.867188 7.128906 28 7.40625 L 28 42.8125 C 27.972656 42.945313 27.972656 43.085938 28 43.21875 L 28 47.8125 L 2 42.84375 L 2 7.15625 Z M 30 8 L 47 8 L 47 42 L 30 42 L 30 37 L 34 37 L 34 35 L 30 35 L 30 29 L 34 29 L 34 27 L 30 27 L 30 22 L 34 22 L 34 20 L 30 20 L 30 15 L 34 15 L 34 13 L 30 13 Z M 36 13 L 36 15 L 44 15 L 44 13 Z M 6.6875 15.6875 L 12.15625 25.03125 L 6.1875 34.375 L 11.1875 34.375 L 14.4375 28.34375 C 14.664063 27.761719 14.8125 27.316406 14.875 27.03125 L 14.90625 27.03125 C 15.035156 27.640625 15.160156 28.054688 15.28125 28.28125 L 18.53125 34.375 L 23.5 34.375 L 17.75 24.9375 L 23.34375 15.6875 L 18.65625 15.6875 L 15.6875 21.21875 C 15.402344 21.941406 15.199219 22.511719 15.09375 22.875 L 15.0625 22.875 C 14.898438 22.265625 14.710938 21.722656 14.5 21.28125 L 11.8125 15.6875 Z M 36 20 L 36 22 L 44 22 L 44 20 Z M 36 27 L 36 29 L 44 29 L 44 27 Z M 36 35 L 36 37 L 44 37 L 44 35 Z"
                                                            ></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div>
                                                    <button
                                                        @click="exportPDF(weekData)"
                                                        class="mx-auto mt-2 ml-0 block w-full cursor-pointer rounded-md bg-red-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm transition-all hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 md:mt-0 md:ml-2 md:w-fit"
                                                    >
                                                        <svg
                                                            class="fill-white"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="20"
                                                            height="20"
                                                            viewBox="0 0 20 20"
                                                        >
                                                            <rect x="0" fill="none" width="20" height="20" />

                                                            <g>
                                                                <path
                                                                    d="M5.8 14H5v1h.8c.3 0 .5-.2.5-.5s-.2-.5-.5-.5zM11 2H3v16h13V7l-5-5zM7.2 14.6c0 .8-.6 1.4-1.4 1.4H5v1H4v-4h1.8c.8 0 1.4.6 1.4 1.4v.2zm4.1.5c0 1-.8 1.9-1.9 1.9H8v-4h1.4c1 0 1.9.8 1.9 1.9v.2zM15 14h-2v1h1.5v1H13v1h-1v-4h3v1zm0-2H4V3h7v4h4v5zm-5.6 2H9v2h.4c.6 0 1-.4 1-1s-.5-1-1-1z"
                                                                />
                                                            </g>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Layout pentru mobil - container patrat -->
                                        <div class="md:hidden">
                                            <!-- Header cu titlu și iconă -->
                                            <div class="flex items-center justify-between">
                                                <h2 class="text-base font-semibold text-gray-900 dark:text-white">Săptămâna {{ week }}</h2>
                                                <svg
                                                    class="h-5 w-5 text-gray-500 transition-transform duration-200"
                                                    :class="{ 'rotate-180': isWeekExpanded(week) }"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>

                                            <!-- Grid container patrat pentru informații -->
                                            <div class="grid grid-cols-2 gap-3">
                                                <div class="rounded-lg border border-gray-200 bg-white p-3 dark:border-gray-600 dark:bg-gray-700">
                                                    <div class="flex flex-col items-center text-center">
                                                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                                            {{ weekData.length }}
                                                        </div>
                                                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">Înregistrări</div>
                                                    </div>
                                                </div>

                                                <div class="rounded-lg border border-gray-200 bg-white p-3 dark:border-gray-600 dark:bg-gray-700">
                                                    <div class="flex flex-col items-center text-center">
                                                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                                                            {{ calculateWeekTotal(weekData) }}
                                                        </div>
                                                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">Lei</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 flex flex-col gap-4 md:flex-row">
                                                <!-- Export Excel Button -->
                                                <button
                                                    @click="exportExcel(weekData)"
                                                    class="flex w-full items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow transition-all hover:bg-green-700 focus:ring-2 focus:ring-green-400 focus:outline-none md:w-auto"
                                                >
                                                    <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                                                        <path
                                                            d="M 28.875 0 C 28.855469 0.0078125 28.832031 0.0195313 28.8125 0.03125 L 0.8125 5.34375 C 0.335938 5.433594 -0.0078125 5.855469 0 6.34375 L 0 43.65625 C -0.0078125 44.144531 0.335938 44.566406 0.8125 44.65625 L 28.8125 49.96875 C 29.101563 50.023438 29.402344 49.949219 29.632813 49.761719 C 29.859375 49.574219 29.996094 49.296875 30 49 L 30 44 L 47 44 C 48.09375 44 49 43.09375 49 42 L 49 8 C 49 6.90625 48.09375 6 47 6 L 30 6 L 30 1 C 30.003906 0.710938 29.878906 0.4375 29.664063 0.246094 C 29.449219 0.0546875 29.160156 -0.0351563 28.875 0 Z M 28 2.1875 L 28 6.53125 C 27.867188 6.808594 27.867188 7.128906 28 7.40625 L 28 42.8125 C 27.972656 42.945313 27.972656 43.085938 28 43.21875 L 28 47.8125 L 2 42.84375 L 2 7.15625 Z M 30 8 L 47 8 L 47 42 L 30 42 L 30 37 L 34 37 L 34 35 L 30 35 L 30 29 L 34 29 L 34 27 L 30 27 L 30 22 L 34 22 L 34 20 L 30 20 L 30 15 L 34 15 L 34 13 L 30 13 Z M 36 13 L 36 15 L 44 15 L 44 13 Z M 6.6875 15.6875 L 12.15625 25.03125 L 6.1875 34.375 L 11.1875 34.375 L 14.4375 28.34375 C 14.664063 27.761719 14.8125 27.316406 14.875 27.03125 L 14.90625 27.03125 C 15.035156 27.640625 15.160156 28.054688 15.28125 28.28125 L 18.53125 34.375 L 23.5 34.375 L 17.75 24.9375 L 23.34375 15.6875 L 18.65625 15.6875 L 15.6875 21.21875 C 15.402344 21.941406 15.199219 22.511719 15.09375 22.875 L 15.0625 22.875 C 14.898438 22.265625 14.710938 21.722656 14.5 21.28125 L 11.8125 15.6875 Z M 36 20 L 36 22 L 44 22 L 44 20 Z M 36 27 L 36 29 L 44 29 L 44 27 Z M 36 35 L 36 37 L 44 37 L 44 35 Z"
                                                        />
                                                    </svg>
                                                    <span>Export EXCEL</span>
                                                </button>

                                                <!-- Export PDF Button -->
                                                <button
                                                    @click="exportPDF(weekData)"
                                                    class="flex w-full items-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow transition-all hover:bg-red-700 focus:ring-2 focus:ring-red-400 focus:outline-none md:w-auto"
                                                >
                                                    <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <rect x="0" fill="none" width="20" height="20" />
                                                        <path
                                                            d="M5.8 14H5v1h.8c.3 0 .5-.2.5-.5s-.2-.5-.5-.5zM11 2H3v16h13V7l-5-5zM7.2 14.6c0 .8-.6 1.4-1.4 1.4H5v1H4v-4h1.8c.8 0 1.4.6 1.4 1.4v.2zm4.1.5c0 1-.8 1.9-1.9 1.9H8v-4h1.4c1 0 1.9.8 1.9 1.9v.2zM15 14h-2v1h1.5v1H13v1h-1v-4h3v1zm0-2H4V3h7v4h4v5zm-5.6 2H9v2h.4c.6 0 1-.4 1-1s-.5-1-1-1z"
                                                        />
                                                    </svg>
                                                    <span>Export PDF</span>
                                                </button>
                                            </div>
                                            <!-- Perioada datelor -->
                                            <div class="mt-3 text-center">
                                                <span
                                                    class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-600 dark:text-gray-300"
                                                >
                                                    {{ getWeekDateRange(weekData) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Conținut pentru săptămâna respectivă - se afișează doar dacă este expandată -->
                                    <div v-if="isWeekExpanded(week)" class="transition-all duration-300 ease-in-out">
                                        <!-- Tabel pentru desktop -->
                                        <div class="hidden overflow-x-auto md:block">
                                            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                                                <thead class="bg-gray-50 dark:bg-gray-800">
                                                    <tr>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                                        >
                                                            ID PONTAJ
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                                        >
                                                            Data
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                                        >
                                                            Angajati
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                                        >
                                                            Total
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                                        >
                                                            Creat de
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                                        >
                                                            Actiuni
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-background">
                                                    <tr
                                                        v-for="(aday, index) in weekData"
                                                        :key="aday.id"
                                                        :class="index % 2 === 0 ? 'bg-white dark:bg-background' : 'bg-gray-50 dark:bg-gray-800/50'"
                                                    >
                                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900 dark:text-white">
                                                            {{ aday.id }}
                                                        </td>
                                                        <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-900 dark:text-white">
                                                            {{ moment(aday.date).format('DD/MM/YYYY') }}
                                                        </td>
                                                        <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-900 dark:text-white">
                                                            {{ aday.activities_count }}
                                                        </td>
                                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900 dark:text-white">
                                                            {{ aday.grand_total }} lei
                                                        </td>
                                                        <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-900 dark:text-white">
                                                            {{ aday.created_by.name }}
                                                        </td>
                                                        <td class="space-x-2 px-6 py-4 text-sm whitespace-nowrap">
                                                            <Link
                                                                :href="`/activities/${aday.id}/show`"
                                                                class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-3 py-1.5 text-xs font-medium text-white transition-colors hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
                                                            >
                                                                Vezi
                                                            </Link>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Card-uri pentru mobil -->
                                        <div class="mt-5 md:hidden">
                                            <!-- Container cu overflow pentru înregistrări -->
                                            <div class="px-4 pb-4">
                                                <div class="space-y-3">
                                                    <div
                                                        v-for="(aday, index) in weekData"
                                                        :key="aday.id"
                                                        class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-600 dark:bg-gray-700"
                                                    >
                                                        <div class="mb-3 flex items-start justify-between">
                                                            <div class="flex flex-col">
                                                                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                                                    Pontaj #{{ aday.id }}
                                                                </span>
                                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                                    {{ moment(aday.date).format('DD/MM/YYYY') }}
                                                                </span>
                                                            </div>
                                                            <div class="flex flex-col items-end">
                                                                <span class="text-sm font-bold text-green-600 dark:text-green-400">
                                                                    {{ aday.grand_total }} lei
                                                                </span>
                                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                                    {{ aday.activities_count }} angajați
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 border-b border-gray-200 pb-3 dark:border-gray-600">
                                                            <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                                    ></path>
                                                                </svg>
                                                                Creat de: {{ aday.created_by.name }}
                                                            </div>
                                                        </div>

                                                        <div class="flex space-x-2">

                                                            <Link
                                                                :href="`/activities/${aday.id}/show`"
                                                                class="inline-flex flex-1 items-center justify-center rounded-md border border-transparent bg-blue-600 px-3 py-2 text-xs font-medium text-white transition-colors hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
                                                            >
                                                                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                                    ></path>
                                                                    <path
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                                    ></path>
                                                                </svg>
                                                                Vezi
                                                            </Link>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                v-if="weekData.length > 3"
                                                class="rounded-b-lg bg-gray-50 py-2 text-center text-xs text-gray-500 dark:bg-gray-800/50 dark:text-gray-400"
                                            >
                                                Derulează pentru a vedea mai multe înregistrări
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import axiosLink from '@/axiosLink';
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
            selectedWeeks: moment().isoWeek(),
            expandedWeeks: {},
        };
    },

    computed: {
        groupedByWeek() {
            const grouped = {};

            this.adays.data.forEach((aday) => {
                const week = aday.week;
                if (!grouped[week]) {
                    grouped[week] = [];
                }
                grouped[week].push(aday);
            });

            const sortedWeeks = Object.keys(grouped).sort((a, b) => parseInt(a) - parseInt(b));
            const sortedGrouped = {};

            sortedWeeks.forEach((week) => {
                sortedGrouped[week] = grouped[week].sort((a, b) => moment(a.date).valueOf() - moment(b.date).valueOf());
            });

            return sortedGrouped;
        },
    },

    methods: {
        async exportExcel(weekData) {
            let week = weekData[0].week;
            let year = moment(weekData[0].date).format('YYYY');
            this.exporting = true;
            await axiosLink(`/activities/export/${week}/${year}`, `pontaj_${week}.xlsx`);
            this.exporting = false;
        },

        async exportPDF(weekData) {
            let week = weekData[0].week;
            let year = moment(weekData[0].date).format('YYYY');
            this.exporting = true;
            await axiosLink(`/activities/export/${week}/${year}/pdf`, `pontaj_${week}.pdf`);
            this.exporting = false;
        },

        calculateWeekTotal(weekData) {
            return weekData
                .reduce((total, aday) => {
                    return total + parseFloat(aday.grand_total || 0);
                }, 0)
                .toFixed(2);
        },

        toggleWeek(week) {
            this.expandedWeeks[week] = !this.expandedWeeks[week];
            this.$forceUpdate();
        },

        isWeekExpanded(week) {
            return this.expandedWeeks[week] || false;
        },

        getWeekDateRange(weekData) {
            if (weekData.length === 0) return '';

            const dates = weekData.map((aday) => moment(aday.date)).sort((a, b) => a.valueOf() - b.valueOf());
            const firstDate = dates[0];
            const lastDate = dates[dates.length - 1];

            if (firstDate.isSame(lastDate, 'day')) {
                return firstDate.format('DD/MM/YYYY');
            } else {
                return `${firstDate.format('DD/MM')} - ${lastDate.format('DD/MM/YYYY')}`;
            }
        },
    },

    created() {
        this.moment = moment;
    },
};
</script>
<style scoped>
.st0 {
    fill-rule: evenodd;
    clip-rule: evenodd;
}
</style>
