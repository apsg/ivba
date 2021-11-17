<template>
    <div class="w-100 h-100 d-flex flex-column order">
        <div class="d-flex justify-content-center mt-2 progress-indicator align-items-end w-50 ml-auto mr-auto">
            <div
                class="p-3 text-center text-gray-light"
                :class="step==1 ? 'active text-gray-44' : ''">
                Informacje <br/>o zamówieniu
            </div>
            <div
                class="p-3 text-center text-gray-light"
                :class="step==2 ? 'active text-gray-44' : ''">
                Dane do <br/>płatności
            </div>
            <div
                class="p-3 text-center text-gray-light"
                :class="step==3 ? 'active text-gray-44' : ''">
                Podsumowanie
            </div>
        </div>
        <div class="d-flex justify-content-center progress-indicator align-items-start w-50 ml-auto mr-auto">
            <div
                class="text-center text-blue-order indicator">
                <i class="fa fa-circle-o" v-if="step === 1"></i>
                <i class="fa fa-circle" v-if="step > 1"></i>
            </div>
            <div
                class="text-center indicator"
                :class="step > 1 ? 'active text-blue-order' : 'text-gray-light'">
                <i class="fa fa-circle" v-if="step > 2"></i>
                <i class="fa fa-circle-o" v-else></i>
            </div>
            <div
                class="text-center indicator"
                :class="step==3 ? 'active text-blue-order' : 'text-gray-light'">
                <i class="fa fa-circle-o"></i>
            </div>
        </div>
        <div class="pt-5 w-75 ml-auto mr-auto">
            <h2 class="text-gray-44">Dostęp do platformy Internetowi Sprzedawcy</h2>

            <div class="d-flex w-100 mt-5 border-bottom-gray pb-3">
                <div class="w-60">
                    Opis:
                </div>
                <div>
                    Wartość zamówienia:
                </div>
            </div>
            <div class="d-flex mt-3">
                <div class="w-60 pr-5 text-gray-44">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.
                    </p>
                </div>
                <div class="text-right">
                    <span class="price">{{ price }}</span>
                </div>
            </div>
            <div class="d-flex mt-3">
                <div class="w-60 pr-5 text-gray-44">
                    <p>Kupon rabatowy</p>
                    <input class="form-control w-50" v-model="coupon">
                </div>
                <div class="text-right">
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Order",

    props: ['price'],

    data() {
        return {
            step: 3,
            coupon: null,
        }
    }
}
</script>

<style lang="scss" scoped>
.order {
    font-family: 'Poppins', sans-serif;
    font-size: 18px;

    .progress-indicator {
        font-size: 15px/19px;

        & > div {
            width: 33%;
        }

        .indicator {
            font-size: 1.3em;
        }
    }

    h2 {
        font-weight: 700;
    }

    .w-60 {
        width: 60%;
    }

    .border-bottom-gray {
        border-bottom: 1px solid #E2E2E2;
    }

    .price {
        color: #8AC348;
        font-size: 33px;
    }
}
</style>
