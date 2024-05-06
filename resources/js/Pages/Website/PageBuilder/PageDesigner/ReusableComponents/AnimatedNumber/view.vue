<template>
    {{ displayNumber }}
</template>
<script>
export default {
    props: {
        number: {
        type: Number,
        required: true,
        },
        edit: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
        displayNumber: 0,
        interval: null, 
        };
    },
    mounted() {
        this.animateNumber();
    },
    methods: {
        animateNumber() {
            if(!this.edit){
                clearInterval(this.interval);
                if (this.number === this.displayNumber) {
                    return;
                }
                if (this.number) {
                    this.interval = setInterval(() => {
                    if (this.displayNumber !== this.number) {
                    const change = Math.ceil(Math.abs(this.number - this.displayNumber) / 10);
                        this.displayNumber = this.displayNumber + change;
                    } else {
                        clearInterval(this.interval);
                    }
                }, 20);
                }
            }else{
                this.displayNumber = this.number
            }
        },
    },
};
</script>
  
