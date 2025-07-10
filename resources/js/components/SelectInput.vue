<template>
    <div :class="$attrs.class">
        <label v-if="label" :for="id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
            {{ label }}
        </label>
        <select :id="id" ref="input" v-model="selected" v-bind="{ ...$attrs, class: null }"
            class="w-full px-4 py-2 text-sm rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 focus:outline-none focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-200 ease-in-out"
            :class="{ 'border-red-500': error }">
            <slot />
        </select>
        <div v-if="error" class="text-sm text-red-500">
            {{ error }}
        </div>
    </div>
</template>


<script>
import { v4 as uuid } from 'uuid'

export default {
    inheritAttrs: false,
    props: {
        id: {
            type: String,
            default() {
                return `select-input-${uuid()}`
            },
        },
        error: String,
        label: String,
        modelValue: [String, Number, Boolean],

    },
    emits: ['update:modelValue'],
    data() {
        return {
            selected: this.modelValue,
        }
    },
    watch: {
        selected(selected) {
            this.$emit('update:modelValue', selected)
        },
    },
    methods: {
        focus() {
            this.$refs.input.focus()
        },
        select() {
            this.$refs.input.select()
        },
    },
}
</script>

<style>
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    appearance: none;
    outline: 0;
    box-sizing: none;
    box-shadow: none;
    border-color: #d1d5db;
    background: white;
    background-image: none;
    color: black;
    font-weight: normal;
    border-radius: 3px !important;
}

select:focus {
    border-color: black !important;
}

select option {
    background-color: white;
    color: black;
    font-weight: normal;
    border: 2px solid black;
}

select option:hover {
    text-decoration: green !important;
}
</style>
