<template>
    <div>
        <div class="d-flex">
            <a class="btn btn-outline-primary m-3"
               :class="active == 'month' ? 'btn-ivba' : ''"
               @click.prevent="fetchMonthlyRanking"
            >Ranking miesięczny</a>
            <a class="btn btn-outline-primary m-3"
               :class="active == 'total' ? 'btn-ivba' : ''"
               @click.prevent="fetchRanking"
            >Ranking wszechczasów</a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Imię</th>
                <th scope="col">Punkty</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in ranking"
                :class="item.is_me ? 'table-success' : ''"
            >
                <th scope="row">{{ item.position }}</th>
                <td>{{ item.name }}</td>
                <td>{{ item.points }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "Ranking",

        data() {
            return {
                'ranking': [],
                'active': null,
            }
        },

        mounted() {
            this.fetchMonthlyRanking();
        },

        methods: {
            fetchMonthlyRanking() {
                axios.get('/a/ranking/month')
                    .then(data => {
                        this.ranking = data.data.data;
                        this.active = 'month';
                    })
                    .catch(() => {
                        this.ranking = [];
                    })
            },

            fetchRanking() {
                axios.get('/a/ranking/total')
                    .then(data => {
                        this.ranking = data.data.data;
                        this.active = 'total'
                    })
                    .catch(() => {
                        this.ranking = [];
                    })
            }
        }

    }
</script>

<style scoped lang="scss">

</style>