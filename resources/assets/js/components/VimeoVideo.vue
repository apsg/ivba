<template>
    <div class="col-md-12 video centered" :style="style">
        <iframe :src="src"
                :width="width"
                :height="height"
                frameborder="0"
                title="Untitled"
                webkitallowfullscreen mozallowfullscreen allowfullscreen
        ></iframe>
        <img :src="watermark">
    </div>
</template>

<script>
export default {
    name: "VimeoVideo",

    props: {
        src: {
            type: Object,
            default: null,
        },
        width: {
            type: Number,
            default: 1000
        },
        height: {
            type: Number,
            default: 600,
        },
        watermark: {
            type: String,
            default: "/images/watermark.png"
        }
    },

    computed: {
        style() {
            return 'width: ' + this.width + 'px;'
                + 'max-width: ' + this.width + 'px;'
        }
    }
}
</script>

<style scoped lang="scss">
.video {
    img {
        position: absolute;
        bottom: 19px;
        right: -12px;
        width: 150px;
    }

    &:hover img {
        display: none;
    }
}
</style>