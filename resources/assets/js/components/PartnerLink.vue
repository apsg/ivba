<template>
    <div class="col-md-12">
        <h3>Twój link partnerski</h3>
        <p>Użyj tego linku partnerskiego, by polecać naszą platformę.</p>
        <div class="d-flex">
            <div class="alert alert-secondary flex-fill"
                 @click="copy"
            >{{ link }}
            </div>
            <div class="w-25">
                <button class="btn btn-ivba h-75 ml-1"
                        v-clipboard:copy="link"
                        v-clipboard:success="copied"
                >
                    Kopiuj do schowka
                </button>
            </div>
        </div>
        <p v-if="count > 0">Dotychczas z Twojego linku zarejestrowało się {{ count }} użytkowników</p>
        <hr/>
    </div>
</template>

<script>
    export default {
        name: "PartnerLink",
        props: {
            link: {
                type: String,
            },
            count: {
                default: 0
            }
        },

        methods: {
            copy() {
                console.log('copy');
                this.$copyText(this.link).then(() => {
                    this.copied();
                });
            },

            copied() {
                this.flash('Skopiowano do schowka!', 'success', {
                    timeout: 3000
                });
            }
        }
    }
</script>

<style scoped lang="scss">

</style>