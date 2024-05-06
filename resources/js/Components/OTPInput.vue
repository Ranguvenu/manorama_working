<template>
    <div ref="otpCont" class="text-center">
        <input type="text" class="digit-box" :class="{ bounce: digits[ind] !== null }" v-for="(el, ind) in digits"
            :key="el + ind" v-model="digits[ind]" :autofocus="ind === 0" maxlength="1"
            @keydown="handleKeyDown($event, ind)">
    </div>
</template>
<script setup>
import { ref, reactive } from 'vue';

const props = defineProps({
    default: String,

    digitCount: {
        type: Number,
        required: true
    }
});

const digits = reactive([])

if (props.default && props.default.length === props.digitCount) {
    for (let i = 0; i < props.digitCount; i++) {
        digits[i] = props.default.charAt(i)
    }
} else {
    for (let i = 0; i < props.digitCount; i++) {
        digits[i] = null;
    }
}

const otpCont = ref(null)

const handleKeyDown = function (event, index) {
    if (event.key !== "Tab" &&
        event.key !== "ArrowRight" &&
        event.key !== "ArrowLeft"
    ) {
        event.preventDefault();
    }

    if (event.key === "Backspace") {
        digits[index] = null;

        if (index != 0) {
            (otpCont.value.children)[index - 1].focus();
        }

        return;
    }

    if ((new RegExp('^([0-9])$')).test(event.key)) {
        digits[index] = event.key;

        if (index != props.digitCount - 1) {
            (otpCont.value.children)[index + 1].focus();
        }
    }
    if (isDigitsFull()) {
        emit('update:otp', digits.join(''))
    }
}
const emit = defineEmits(['update:otp']);
const isDigitsFull = function () {
    for (const elem of digits) {
        if (elem == null || elem == undefined) {
            return false;
        }
    }

    return true;
}
</script>
<style scoped>
.digit-box {
    height: 4rem;
    width: 50px;
    text-align: center;
    color: #474747;
    border: 1px solid #cfcfcf;
    display: inline-block;
    border-radius: 5px;
    margin: 5px;
    padding: 10px;
    font-size: 24px;
}

.digit-box:focus {
    outline: 3px solid #c4c4c4;
}

.bounce {
    animation: pulse .3s ease-in-out alternate;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }

    100% {
        transform: scale(1.1);
    }
}
</style>