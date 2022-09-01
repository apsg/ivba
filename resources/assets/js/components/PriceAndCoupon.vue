<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th>Opis</th>
                <th>Koszt</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="first_duration > 0">
                <td>Pierwsza płatność w abonamencie ({{ first_duration }} dni dostępu)</td>
                <td>{{ first_price }} PLN</td>
            </tr>
            <tr>
                <td>Stała miesięczna płatność</td>
                <td v-if="currentPrice == price">{{ currentPrice }} PLN</td>
                <td v-if="currentPrice!=price">
                    <del>{{ price }}</del>
                    <span class="text-success"><strong>{{ currentPrice }}</strong></span>
                    PLN
                </td>
            </tr>
            </tbody>
        </table>

        Masz kupon zniżkowy? Wpisz go tutaj:
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Kupon zniżkowy:</div>
            </div>
            <input type="text"
                   class="form-control"
                   name="code"
                   placeholder="wielkość liter ma znaczenie"
                   v-model="coupon"
                   @change="checkCoupon">
        </div>
        <div class="alert alert-danger" v-if="error">{{ error }}</div>

    </div>
</template>

<script>
    export default {
        name: "PriceAndCoupon",

        props: {
            price: {
                type: String,
                required: true,
            },
            first_price: {
                type: String,
                required: true,
            },
            first_duration: {
                type: String,
                required: true,
            }
        },

        data () {
            return {
                currentPrice: 0,
                coupon: '',
                error: '',
            }
        },

        mounted () {
            this.currentPrice = parseInt(this.price);
        },

        methods: {
            checkCoupon (e) {
                console.log(this.coupon);
                axios.post('/a/check_coupon', {
                    'code': this.coupon
                }).then(data => {
                    this.error = null;
                    this.currentPrice = data.data.price;
                }).catch(error => {
                    console.log('invalid');

                    this.currentPrice = this.price;

                    if (error.response.status == 404) {
                        this.error = 'Nie znaleziono takiego kuponu.';
                        return;
                    }

                    if (error.response.status == 403) {
                        this.error = 'Ten kupon został już wykorzystany maksymalną liczbę razy.';
                        return;
                    }

                    if (error.response.status == 422) {
                        this.error = 'Ten kupon może być wykorzystany tylko przy zakupie pełnego dostępu.';
                        return;
                    }

                    this.error = error.data.message;

                    console.log(error.response.data);
                    console.log(error.response.status);
                });
            }
        }
    }
</script>

<style scoped lang="scss">

</style>
