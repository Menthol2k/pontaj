<template>
    <div :class="$attrs.class" class="flex flex-col">
        <label v-if="label" :for="id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
            {{ label }}
        </label>
        <textarea :rows="height" :id="id" ref="input" v-bind="{ ...$attrs, class: null }"
            class="w-full bg-white px-4 py-2 text-sm rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transition-all duration-200 ease-in-out"
            :class="{ 'border-red-500': error }" :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)">
      </textarea>
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
                return `textarea-input-${uuid()}`
            },
        },
        error: String,
        label: String,
        modelValue: String,
        height: {
            type: Number,
            default: 4,
        }
    },
    emits: ['update:modelValue'],
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