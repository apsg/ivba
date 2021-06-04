<template>
    <div class="d-flex">
        <div :class=" isTpay ? 'alert-success' : ''" @click="clicked('tpay')" class="pointer m-1 p-2">
            <i class="fa fa-check" v-if="isTpay"></i>
            <i class="fa fa-square-o" v-else></i>
            TPAY
        </div>

        <div :class=" isPayu ? 'alert-success' : ''" @click="clicked('payu')" class="pointer m-1 p-2">
            <i class="fa fa-check" v-if="isPayu"></i>
            <i class="fa fa-square-o" v-else></i>
            PAYU
        </div>

        <input type="hidden" name="payments[]" value="tpay" v-if="isTpay">
        <input type="hidden" name="payments[]" value="payu" v-if="isPayu">
    </div>
</template>

<script>
export default {
    name: "PaymentMethod",

    props: [
        'methods'
    ],

    data() {
        return {
            payments: {
                payu: false,
                tpay: false
            }
        }
    },

    mounted() {
        this.payments.payu = this.methods.includes('payu');
        this.payments.tpay = this.methods.includes('tpay');
    },

    methods: {
        clicked(type) {
            this.payments[type] = !this.payments[type];
        }
    },

    computed: {
        isTpay() {
            return this.payments.tpay;
        },
        isPayu() {
            return this.payments.payu;
        }
    }
}
</script>

<style scoped>
.pointer {
    cursor: pointer;
}
</style>
