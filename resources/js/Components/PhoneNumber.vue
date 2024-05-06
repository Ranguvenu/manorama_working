<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    modelValue: {
        type: [Object],
        required: true,
    },
    placeholder: {
        type: String
    },
    disabled: {
        type: Boolean,
        default: false
    }
});

let emit = defineEmits(['update:modelValue']);
const number = ref(null);
const code = ref(null);
onMounted(() => {
    if (number.value.hasAttribute('autofocus')) {
        number.value.focus();
    }
});
const phone = props.modelValue;
const update_number = (e) => {
    phone.number = e.target.value;
    emit('update:modelValue', phone)
}

const update_code = (e) => {
    phone.code = e.target.value;
    emit('update:modelValue', phone)
}

defineExpose({ focus: () => number.value.focus() });
</script>

<template>
    <div class="flex ">
        <div class="w-52 mr-2">
            <select :value="modelValue.code"
                class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm w-full"
                @change="update_code"
                ref="code"
                :disabled="disabled">
                <option :value="country.code" v-for="(country, index) in $page.props.countrycode">{{ country.name }} {{ country.code }}</option>
            </select>
        </div>
        <div class="w-full">
            <input
                type="text"
                class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm w-full"
                :value="modelValue.number"
                :placeholder="placeholder"
                :disabled="disabled"
                @input="update_number"
                ref="number"
                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
            />
        </div>
    </div>
</template>
