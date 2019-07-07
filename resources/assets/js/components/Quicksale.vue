<template>
    <div class="w-50 card d-flex flex-column align-content-start">
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                 :style="progress"></div>
        </div>
        <h4 class="text-center m-1"><i class="fa fa-cart"></i> {{ sale.name }}</h4>

        <div v-if="hasErrors" class="alert alert-danger">
            <div v-for="error in errors">{{ error }}</div>
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
                        @click.prevent="stepIn"
                        :disabled="!confirmed"
                        class="btn btn-primary">Dalej <i class="fa fa-chevron-right"></i>
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
                        <input class="form-control" type="text" required v-model="phone"/>
                    </div>
                </div>
                <div class="text-center">
                    <button
                            @click="stepIn"
                            :disabled="!isStep2Completed"
                            class="btn btn-primary">Dalej <i class="fa fa-chevron-right"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="step" v-if="step==3">
            <h5><span class="badge badge-pill badge-primary">3</span> Płatność</h5>
            <div>
                <p>Kliknięcie w przycisk kupuję i płacę potwierdza zamówienie oraz przenosi do systemu płatności</p>
            </div>
            <div class="text-center">
                <button
                        @click="stepBack"
                        class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Wstecz
                </button>
                <button
                        @click="finish"
                        class="btn btn-primary">Kupuję i płacę <i class="fa fa-chevron-right"></i>
                </button>
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
            }
        },

        computed: {
            progress() {
                return "width: " + (100 * this.step / 3) + "%;";
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
            }
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

            finish() {
                axios.post(window.baseUrl + '/qs/' + this.sale.hash + '/order', {
                    name: this.username,
                    email: this.email,
                    phone: this.phone
                })
                    .then(response => {
                        console.log(response);
                    }).catch(error => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
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

    .price-old {
        text-decoration: line-through;
        color: #3a3a3a;
    }

</style>
