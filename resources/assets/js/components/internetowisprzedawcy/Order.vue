<template>
    <div class="w-100 h-100 d-flex flex-column order">
        <div class="d-flex justify-content-center mt-2 progress-indicator align-items-end w-50 ml-auto mr-auto">
            <div
                class="p-3 text-center text-gray-light"
                :class="step === 1 ? 'active text-gray-44' : ''">
                Informacje <br/>o zamówieniu
            </div>
            <div
                class="p-3 text-center text-gray-light"
                :class="step === 2 ? 'active text-gray-44' : ''">
                Dane do <br/>płatności
            </div>
            <div
                class="p-3 text-center text-gray-light"
                :class="step === 3 ? 'active text-gray-44' : ''">
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
                :class="step === 3 ? 'active text-blue-order' : 'text-gray-light'">
                <i class="fa fa-circle-o"></i>
            </div>
        </div>

        <div class="pt-5 w-75 ml-auto mr-auto" v-if="step === 1">
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
                <div class="text-right flex-fill">
                    <span class="price">{{ price }} PLN</span>
                </div>
            </div>
            <div class="d-flex mt-3">
                <div class="w-60 pr-5 text-gray-44">
                    <p>Kupon rabatowy</p>
                    <input
                        placeholder="Wpisz kod"
                        class="form-control w-50"
                        v-model="coupon">
                </div>
                <div class="text-right flex-grow-1">
                    <div class="form-group">
                        <label>
                            <input type="checkbox" class="form-control rules-checkbox" v-model="rules">
                            Akceptuję <a :href="rules_link" target="_blank">Regulamin</a>
                        </label>
                    </div>
                    <button
                        class="btn btn-lg btn-blue next-button px-5 py-3"
                        @click.prevent="next()"
                        :disabled="!rules">
                        Dalej <i class="fa fa-caret-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="pt-5 w-75 ml-auto mr-auto text-gray-44" v-if="step === 2">
            <div class="rounded-50 product-box bg-white p-4">
                Twoje zamówienie
                <h5 class="text-black">Dostęp do platformy Internetowi Sprzedawcy</h5>
            </div>

            <div class="d-flex mt-5">
                <div class="w-50 p-3">
                    <h5 class="text-black">Podaj dane do płatności</h5>

                    <div class="form-group">
                        <label>Imię i nazwisko</label>
                        <input
                            v-model="name"
                            type="text"
                            class="form-control"
                            required/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input
                            v-model="email"
                            type="email"
                            class="form-control"
                            :disabled="isLogged"
                            required/>
                    </div>
                    <div class="form-group">
                        <label>Telefon</label>
                        <input
                            v-model="phone"
                            type="text"
                            class="form-control"
                            required/>
                    </div>

                </div>
                <div class="w-50 p-3" v-if="!isLogged">
                    <h5 class="text-black">Masz już konto? Zaloguj się!</h5>
                    <form class="form-outer" role="form" method="POST" action="/login">
                        <input type="hidden" name="_token" :value="token">
                        <div class="form-group">
                            <label>Email</label>
                            <input
                                name="email"
                                type="email"
                                class="form-control"
                                required/>
                        </div>
                        <div class="form-group">
                            <label>Hasło</label>
                            <input
                                name="password"
                                type="password"
                                class="form-control"
                                required/>
                        </div>
                        <button type="submit" class="btn btn-ivba">
                            Zaloguj się
                        </button>
                    </form>

                </div>
            </div>

            <div class="d-flex mt-3 align-items-center">
                <div class="w-60 pr-5 text-gray-44">
                    <a href="#" @click.prevent="prev()" class="color-gray">
                        <i class="fa fa-caret-left"></i> Wróć
                    </a>
                </div>
                <div class="text-right flex-grow-1">
                    <button
                        class="btn btn-lg btn-blue next-button px-5 py-3"
                        @click.prevent="next()"
                        :disabled="!rules || !email">
                        Dalej <i class="fa fa-caret-right"></i>
                    </button>
                </div>
            </div>

        </div>

        <div class="pt-5 w-75 ml-auto mr-auto text-gray-44" v-if="step === 3">
            <div class="rounded-50 product-box bg-white p-4">
                Twoje zamówienie
                <h5 class="text-black">Dostęp do platformy Internetowi Sprzedawcy</h5>
            </div>

            <div class="mt-5">
                <h3 class="text-black">Podsumowanie</h3>
                <p>Kliknięcie w przycisk kupuję i płacę potwierdza zamówienie oraz przenosi do wyboru metody
                    płatności.</p>
            </div>

            <div class="d-flex mt-3 align-items-center">
                <div class="w-60 pr-5 text-gray-44">
                    <a href="#" @click.prevent="prev()" class="color-gray">
                        <i class="fa fa-caret-left"></i> Wróć
                    </a>
                </div>
                <div class="text-right flex-grow-1">
                    <button
                        class="btn btn-lg btn-blue next-button px-5 py-3"
                        @click.prevent="next()"
                        :disabled="!rules || !email">
                        Kupuję i płacę <i class="fa fa-caret-right"></i>
                    </button>
                </div>
            </div>

            <div class="mt-5 pt-5">
                <p>Dostępne metody płatności:</p>
                <img src="/images/internetowisprzedawcy/payu.png"/>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Order",

    props: ['price', 'rules_link', 'user'],

    data() {
        return {
            step: 1,
            coupon: null,
            rules: false,
            name: '',
            email: '',
            phone: '',
            token: null,
        }
    },

    mounted() {
        this.token = document.head.querySelector('meta[name="csrf-token"]').content;

        if (this.isLogged) {
            this.email = this.user.email;
            this.name = this.user.name;
            this.phone = this.user.phone;
        }
    },

    methods: {
        next() {
            this.step = Math.min(3, this.step + 1);
        },

        prev() {
            this.step = Math.max(0, this.step - 1);
        }
    },

    computed: {
        isLogged() {
            if (this.user === null || this.user === '')
                return false;

            return !!this.user.id;
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

    .rules-checkbox {
        display: inline-block;
        width: 20px;
        height: 20px;
        line-height: 18px;
    }

    .next-button {
        font-size: 25px;
        font-weight: 500;
    }

    .product-box {
        border: 1px solid #D8D9D9;
    }
}
</style>
