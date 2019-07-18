<template>
    <div class="w-50 card d-flex flex-column align-content-start">
        <div class="progress">
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
                    <span class="price">{{ sale.price }} PLN</span>
                </div>
                <div class="w-50">
                    <i class="fa fa-info"></i> Opis:
                    <p>{{ sale.description }}</p>
                </div>
            </div>
            <label>
                <input type="checkbox" id="rules" v-model="confirmed"/>
                Akceptuję <a :href="sale.rules_url" target="_blank">Regulamin</a>
            </label>
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
            <h5><span class="badge badge-pill badge-primary">3</span> Płatność</h5>
            <div>
                <p>Kliknięcie w przycisk kupuję i płacę potwierdza zamówienie oraz przenosi do wyboru metody
                    płatności</p>
            </div>
            <div class="text-center">
                <button
                        @click="stepBack"
                        class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Wstecz
                </button>
                <button
                        @click="createOrder"
                        class="btn btn-primary">Kupuję i płacę <i class="fa fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="step" v-if="step==4">
            <div v-if="isTpayEnabled">
                <div class="text-center">
                    <img src="https://tpay.com/img/logo/tpaycom.png" class="tpay-logo">
                    <p>Wybierz metodę płatności:</p>
                </div>
                <div class="row overflow-auto groups mb-3">
                    <div v-for="method in groups" class="col-md-4 group">
                        <label :class="(group==method[0]) ? 'selected' : ''">
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
                        :disabled="!group"
                        @click="finish"
                        class="btn btn-primary">Kupuję i płacę <i class="fa fa-chevron-right"></i>
                </button>
            </div>
            <div v-if="!isTpayEnabled" class="alert alert-danger">
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
            }
        },

        computed: {
            progress() {
                return "width: " + (100 * this.step / 4) + "%;";
            },

            isStep2Completed() {
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
                    && window.tr_groups.length > 0;
            },

            groups() {
                return tr_groups;
            }
        },

        mounted() {
            console.log(tr_groups);
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

            createOrder() {
                axios.post(window.baseUrl + '/qs/' + this.sale.hash + '/order', {
                    name: this.username,
                    email: this.email,
                    phone: this.phone
                })
                    .then(response => {
                        console.log(response);
                        this.order = response.data.order_id;
                        this.step += 1;

                    }).catch(error => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
            },

            prevalidate() {
                axios.post(window.baseUrl + '/qs/' + this.sale.hash + '/prevalidate', {
                    email: this.email,
                    name: this.username,
                    phone: this.phone
                }).then(response => {
                    this.stepIn();
                }).catch(error => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
            },

            finish() {
                axios.post(window.baseUrl + '/qs/' + this.sale.hash + '/finish', {
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

</style>
