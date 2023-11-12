<template>
    <div class="container card d-flex flex-column align-content-start">
        <div class="row progress">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                 :style="progress"></div>
        </div>
        <h4 class="text-center m-1"><i class="fa fa-cart"></i> {{ sale.name }}</h4>

        <div v-if="hasErrors" class="alert alert-danger">
            <div v-for="error in errors">
                <div v-for="message in error">{{ format(message) }}</div>
            </div>
        </div>

        <div v-if="step==1" class="step">
            <h5><span class="badge badge-pill badge-primary">1</span> Informacje o zamówieniu</h5>
            <div class="d-flex mb-3">
                <div class="w-50">
                    Cena:
                    <span class="price old-price" v-if="sale.full_price">{{ sale.full_price }}</span>
                    <span class="price" :class="coupon.valid ? 'old-price' : ''">{{ sale.price }} PLN</span>
                    <span class="price pl-1" v-if="coupon.valid">
                        (rabat {{ coupon.description }})
                        {{ coupon.newPrice }} PLN
                    </span>
                </div>
                <div class="w-50">
                    <i class="fa fa-info"></i> Opis:
                    <p>{{ sale.description }}</p>
                </div>
            </div>
            <div class="col-auto" v-if="sale.has_coupons">
                <label class="sr-only" for="couponCodeGroup">Kupon</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Kupon rabatowy:</div>
                    </div>
                    <input v-model="coupon.code"
                           type="text"
                           class="form-control"
                           id="couponCodeGroup"
                           placeholder="wpisz kod..."
                           @change="checkCoupon"
                    >
                    <div class="input-group-append d-flex align-content-center p-1" v-if="coupon.valid">
                        <span style="color: #00a65a"><i class="fa fa-check fa-2x"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-auto pt-3">
                <label>
                    <input type="checkbox" id="rules" v-model="confirmed"/>
                    Akceptuję <a :href="sale.rules_url" target="_blank">Regulamin</a>
                </label>
            </div>
            <div class="text-center">
                <button
                    title="Musisz zaakceptować regulamin aby przejsć dalej"
                    @click.prevent="stepIn"
                    :disabled="!confirmed"
                    class="btn btn-primary">
                    Dalej <i class="fa fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div v-if="step==2" class="step">
            <form @submit.prevent="checkStep2">
                <h5><span class="badge badge-pill badge-primary">2</span> Podaj dane do płatności</h5>
                <div>
                    <div class="form-group">
                        <label>Imię i nazwisko</label>
                        <input class="form-control" type="text" required v-model="username"/>
                    </div>

                    <div class="form-group">
                        <label>email</label>
                        <input class="form-control" type="email" required v-model="email"/>
                    </div>

                    <div class="form-group">
                        <label>Telefon</label>
                        <input class="form-control" type="text" required v-model="phone" placeholder="podaj 9 cyfr"/>
                    </div>
                </div>
                <div v-if="sale.is_full_data_required">

                    <div class="form-group">
                        <label>Ulica</label>
                        <input class="form-control" type="text" required v-model="street"/>
                    </div>
                    <div class="form-group">
                        <label>Kod pocztowy</label>
                        <input class="form-control" type="text" required v-model="postcode"/>
                    </div>
                    <div class="form-group">
                        <label>Miasto</label>
                        <input class="form-control" type="text" required v-model="city"/>
                    </div>
                </div>
                <div class="text-center">
                    <button
                        @click="prevalidate"
                        :disabled="!isStep2Completed"
                        class="btn btn-primary">Dalej <i class="fa fa-chevron-right"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="step" v-if="step ===3">
            <h5 v-if="!isFree"><span class="badge badge-pill badge-primary">3</span> Płatność</h5>
            <h5 v-else><span class="badge badge-pill badge-primary">3</span> Finalizacja</h5>
            <div>
                <p v-if="!isFree">Kliknięcie w przycisk kupuję i płacę potwierdza zamówienie oraz przenosi do wyboru
                    metody
                    płatności</p>
                <p v-if="isFree">Kliknięcie w przycisk zakończ sfinalizuje proces i aktywuje zamówione produkty.
                    W wiadomości email otrzymasz szczegóły w jaki sposób możesz zalogować się na swoje konto.</p>
            </div>
            <div class="text-center">
                <button
                    @click="stepBack"
                    class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Wstecz
                </button>
                <button v-if="!isFree"
                        @click="createOrder"
                        class="btn btn-primary">Kupuję i płacę <i class="fa fa-chevron-right"></i>
                </button>
                <button v-if="isFree"
                        @click="finishFree"
                        class="btn btn-primary">Zakończ <i class="fa fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="step" v-if="step==4">
            <div class="d-flex justify-content-center">
                <div v-if="isPayuEnabled" class="text-center">
                    <a :href="payments['payu'].url" alt="przejdź na stronę płatności">
                        <img src="/images/payu.png">
                    </a>
                </div>
                <div v-if="isTpayEnabled" @click="tpaySelected = !tpaySelected" class="pointer">
                    <img src="https://tpay.com/img/logo/tpaycom.png" class="tpay-logo">
                </div>
            </div>
            <div v-if="tpaySelected">
                <div class="text-center">
                    <p>Wybierz metodę dla płatności Tpay:</p>
                </div>
                <div class="row overflow-auto groups mb-3">
                    <div v-for="method in groups" class="col-md-4 group pointer">
                        <label :class="(group==method[0]) ? 'selected pointer' : 'pointer'">
                            <input type="radio" :value="method[0]" name="group" v-model="group"
                                   class="group-selection"/>
                            <img :src="method[3]" class="bank-logo">
                            <p class="text-center">{{ method[1] }}</p>
                        </label>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button
                    @click="stepBack"
                    class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Wstecz
                </button>
                <button
                    v-if="group"
                    :disabled="!group"
                    @click="finish"
                    class="btn btn-primary">Kupuję i płacę <i class="fa fa-chevron-right"></i>
                </button>
            </div>
            <div v-if="!isTpayEnabled && !isPayuEnabled && !isFree" class="alert alert-danger">
                Błąd systemu płatności. Spróbuj później lub skontaktuj się z nami.
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Quicksale",

    props: {
        sale: {
            type: Object,
            default: null,
        },
    },

    data() {
        return {
            step: 1,
            confirmed: false,
            username: null,
            email: null,
            phone: null,
            errors: [],
            order: null,
            group: null,
            street: null,
            postcode: null,
            city: null,
            payments: [],
            tpaySelected: false,
            coupon: {
                code: null,
                id: null,
                valid: false,
                newPrice: null,
                description: null
            }
        }
    },

    computed: {
        progress() {
            return "width: " + (100 * this.step / 4) + "%;";
        },

        isStep2Completed() {
            if (this.sale.is_full_data_required) {
                return this.username != null
                    && this.email != null
                    && this.phone != null
                    && this.street != null
                    && this.postcode != null
                    && this.city != null;
            }

            return this.username != null
                && this.email != null
                && this.phone != null;
        },

        hasErrors() {
            if (this.errors === null || typeof this.errors == 'undefined') {
                return false;
            }

            if (this.errors.length === 0) {
                return false;
            }

            return true;
        },

        isTpayEnabled() {
            return typeof window.tr_groups !== 'undefined'
                && window.tr_groups.length > 0
                && (this.payments.length === 0 || this.payments['tpay']);
        },

        isPayuEnabled() {
            return !!this.payments['payu'];
        },

        isFree() {
            return parseFloat(this.sale.price) === 0
                || parseFloat(this.coupon.newPrice) === 0;
        },

        groups() {
            return tr_groups;
        }
    },

    mounted() {
        // console.log(this.sale);
    },

    methods: {
        stepIn() {
            this.errors = [];
            this.step += 1;
        },

        stepBack() {
            this.step -= 1;
        },

        checkStep2(e) {
            e.preventDefault();
        },

        baseUrl() {
            return window.baseUrl + '/qs/' + this.sale.hash;
        },

        createOrder() {
            return axios.post(this.baseUrl() + '/order', {
                name: this.username,
                email: this.email,
                phone: this.phone,
                street: this.street,
                postcode: this.postcode,
                city: this.city,
                is_full_data_required: this.sale.is_full_data_required,
                coupon: this.coupon.id
            })
                .then(response => {
                    this.order = response.data.order_id;
                    this.payments = response.data.payments;
                    this.step += 1;

                    if (this.isTpayEnabled && !this.isPayuEnabled) {
                        this.tpaySelected = true;
                    }
                }).catch(error => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
        },

        finishFree() {
            axios.post(this.baseUrl() + '/finish_free', {
                name: this.username,
                email: this.email,
                phone: this.phone,
                street: this.street,
                postcode: this.postcode,
                city: this.city,
                coupon: this.coupon.id
            }).then(response => {
                console.log(response);
                window.location.href = response.data.url;
            });
        },

        prevalidate() {
            axios.post(this.baseUrl() + '/prevalidate', {
                email: this.email,
                name: this.username,
                phone: this.phone,
                street: this.street,
                postcode: this.postcode,
                city: this.city,
                is_full_data_required: this.sale.is_full_data_required,
                coupon: this.coupon.id
            }).then(response => {
                this.stepIn();
            }).catch(error => {
                console.log(error.response);
                this.errors = error.response.data.errors;
            });
        },

        finish() {
            axios.post(this.baseUrl() + '/finish', {
                email: this.email,
                order: this.order,
                group: this.group
            })
                .then(response => {
                    console.log(response);
                    window.location.href = response.data.url;
                }).catch(error => {
                console.log(error.response);
                this.errors = error.response.data.errors;
            });
        },

        format(str) {
            return str.replace('Atrybut phone', 'Numer telefonu');
        },

        checkCoupon() {
            axios.post(this.baseUrl() + '/check_coupon', {
                code: this.coupon.code
            }).then((data) => {
                this.coupon.id = data.data.id;
                this.coupon.valid = data.data.valid;
                this.coupon.newPrice = data.data.newPrice;
                this.coupon.description = data.data.description;
            });
        }
    }
}
</script>

<style scoped lang="scss">
.card {
    min-height: 300px;
    background-color: #fafafa;
}

.step {
    padding: 20px;
}

.price {
    font-size: 15px;
    font-weight: bold;
}

.old-price {
    text-decoration: line-through;
    color: #3a3a3a;
}

.tpay-logo {
    max-width: 300px;
}

.bank-logo {
    height: 50px;
    max-width: 100%;
}

.group-selection {
    display: none;
}

.groups {
    height: 300px;

    .group {
        label {
            border: 2px solid transparent;
        }

        label.selected {
            border: 2px solid green;
        }
    }
}

.pointer {
    cursor: pointer;
}

</style>
