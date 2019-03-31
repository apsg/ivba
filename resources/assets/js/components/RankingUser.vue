<template>
    <div>
        <div v-if="ranking == null">
            Ukończ jakieś lekcje lub zakończ pozytywnie testy, by zobaczyć swój rankinkg.
        </div>
        <div v-else class="card-deck">
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">W tym miesiącu</h4>
                </div>
                <div class="card-body" v-if="ranking.position_month != 0">
                    <h1 class="card-title pricing-card-title">{{ ranking.position_month }}
                        <small class="text-muted">/ {{ ranking.users_month }} użytkowników</small>
                    </h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Zdobyto punktów: <strong>{{ ranking.points_month }}</strong></li>
                    </ul>
                    <a href="/ranking" class="btn btn-lg btn-block btn-outline-primary">Zobacz pełen
                        ranking</a>
                </div>
                <div class="card-body" v-else>
                    W tym miesiącu nie zdobyto jeszcze żadnych punktów.
                </div>
            </div>
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Klasyfikacja generalna</h4>
                </div>
                <div class="card-body" v-if="ranking.position_total != 0">
                    <h1 class="card-title pricing-card-title">{{ ranking.position_total }}
                        <small class="text-muted">/ {{ ranking.users_total }} użytkowników</small>
                    </h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Zdobyto punktów: <strong>{{ ranking.points_total }}</strong></li>
                    </ul>
                    <a href="/ranking" class="btn btn-lg btn-block btn-outline-primary">Zobacz pełen
                        ranking</a>
                </div>
                <div class="card-body" v-else>
                    Nie zdobyto jeszcze żadnych punktów.
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RankingUser",
        data() {
            return {
                ranking: null
            }
        },

        mounted() {
            axios.get('/a/ranking/my')
                .then((data) => {
                    this.ranking = data.data;
                }).catch(() => {
                this.ranking = null;
            });
        }
    }
</script>

<style scoped lang="scss">

</style>