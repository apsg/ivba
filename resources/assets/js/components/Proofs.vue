<template>
    <div class="proofs fixed-bottom ml-5">
        <transition name="fade">
            <a :href="proof.url" v-if="proof && should_show" class="text-dark">
                <div class="proof rounded-pill d-flex bg-white border border-dark">
                    <div class="proof-icon rounded align-self-center px-3">
                        <i class="fa fa-check text-orange fa-4x"></i>
                    </div>
                    <div class="proof-body py-1">
                        <div class="proof-title">
                            <strong>{{ proof.name }}</strong>
                        </div>
                        <div class="proof-text">{{ proof.body }}</div>
                        <div class="proof-meta">{{ proof.created_at }} <span v-if="proof.city">z {{ proof.city }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </transition>
    </div>
</template>

<script>
    export default {
        name: "Proofs",
        data() {
            return {
                proof: null,
                should_show: false,
                nextTimeout: 30000,
            }
        },

        mounted() {
            setTimeout(this.getProof, 5000);
        },

        methods: {
            getProof() {
                axios.get('/proofs/next').then(data => {
                    this.proof = data.data.data;
                }).then(this.show());
            },

            show() {
                this.should_show = true;
                setTimeout(this.hide, 3000);
                setTimeout(this.getProof, this.nextTimeout);
                this.nextTimeout += 10000;
            },

            hide() {
                this.should_show = false;
            }
        },
    }
</script>

<style lang="scss">

    .proofs {

        margin-bottom: 90px;

        .proof {
            width: 350px;
            max-width: 90%;
        }

    }

</style>