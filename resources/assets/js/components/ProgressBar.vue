<template>
    <div class="progressbar d-flex">
        <div class="meter orange flex-fill">
            <span :style="width">{{ current }}/{{ max }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProgressBar",

        props: {
            min:{
                type: Number,
                default: 0,
            },

            max:{
                type: Number,
                default: 100,
            },

            current:{
                type: Number,
                default: 10,
            }
        },

        computed:{
            width()
            {
                let width = 100*(this.current-this.min)/(this.max - this.min);

                return "width: " + width + "%;";
            }
        }
    }
</script>

<style scoped lang="scss">

    .progressbar{
        height: 35px;

        .meter {
            height: 100%;

            span{
                color: #fff;
                vertical-align: middle;
                padding-left:10px;
                line-height:12px;
                font-weight: 700;
            }
        }
    }


</style>