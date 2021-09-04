<template>
    <div class="main-container">
        <a :href="this.url"
           :style="divStyle"
           target="_blank"
           class="d-flex align-content-center justify-content-center align-items-center">
            <i class="fa fa-search-plus"></i>
        </a>
    </div>
</template>

<script>
export default {
    name: "ImagePreview",
    props: {
        'url': {
            type: String,
            required: true
        },
        'size': {
            type: Array,
            required: false,
            default: function () {
                return [200, 150]
            }
        }
    },

    computed: {
        divStyle() {
            return 'width: ' + this.size[0] + 'px; '
                + 'height: ' + this.size[1] + 'px; '
                + 'background-image: url("' + this.url + '");';
        }
    }
}
</script>

<style lang="scss" scoped>
.main-container {
    a {
        background-size: cover;
    }
}
</style>
