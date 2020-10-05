<template>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success" v-if="alert">
                <i class="fa fa-info-circle"></i> {{ alert }}
                <a href="#" class="pull-right" @click.prevent="alert=null"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="col-md-6">
            <select @change="changeBaselinker" class="form-control" v-model="baselinkerId">
                <option>Brak</option>
                <option
                    v-for="product in products"
                    :value="product.id"
                >
                    ({{ product.id }}) {{ product.name }}
                </option>
            </select>
        </div>
        <div class="col-md-6">
            Albo dodaj nowy:
            <button class="btn btn-secondary" type="button" @click.prevent="generateNew">
                <i class="fa fa-plus"></i> Wygeneruj
            </button>
        </div>
        <input type="hidden"
               name="baselinker_id"
               :value="baselinkerId"
        />
    </div>
</template>

<script>
export default {
    name: "Baselinker",

    props: [
        'quicksaleid',
        'baselinkerid'
    ],

    data() {
        return {
            baselinkerId: null,
            products: [],
            alert: null
        }
    },

    mounted() {
        this.baselinkerId = this.baselinkerid;
        this.flash('ok');
        this.fetchProducts();
    },

    methods: {
        generateNew() {
            axios.get('/admin/quicksales/' + this.quicksale_id + '/baselinker_new')
                .then(r => {
                    console.log(r.data);
                    this.baselinkerId = r.data.product_id;
                    this.alert = 'Wygenerowano pomyślnie! ID: ' + this.baselinkerId;
                });
        },

        changeBaselinker(e) {
            this.baselinkerId = e.target.value;
            this.alert = 'Wybrano nowy produkt. ID: ' + this.baselinkerId;
        },

        fetchProducts() {
            axios.get('/admin/baselinker/products')
                .then(r => {
                    this.products = r.data.data;
                });
        }
    }
}
</script>

<style scoped>

</style>