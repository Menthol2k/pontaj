<template>
    <div :class="$attrs.class" class="z-0">
        <label v-if="label" :for="id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
            {{ label }}
        </label>
        <input
            :onkeydown="type === 'number' ? 'return !(event.key === \'e\' || event.key === \'-\' || event.key === \'+\')' : ''"
            :step="type === 'number' ? 'any' : ''" :id="id" ref="input" v-bind="{ ...$attrs, class: null }"
            class="w-full bg-white px-4 py-2 text-sm rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 focus:outline-none focus:border-gray-500 dark:focus:border-gray-400 transition-all duration-200 ease-in-out"
            :class="{ 'border-red-500': error }" :type="type" :placeholder="placeholder" :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)" />
        <slot />
        <div v-if="error" class="text-sm text-red-500">
            {{ error }}
        </div>
    </div>
</template>


<script>
export default {
    props: {
        id: {
            type: String,
            default() {
                return `select-input-${Math.random() * 1000}`;
            },
        },
        type: {
            type: String,
            default: 'text',
        },
        modelValue: String | Number,
        label: String,
        error: String,
        placeholder: {
            type: String,
            default: ''
        }
    },
    methods: {
        focus() {
            this.$refs.input.focus()
        },
        select() {
            this.$refs.input.select()
        },
        setSelectionRange(start, end) {
            this.$refs.input.setSelectionRange(start, end)
        },
    },
}
</script>
