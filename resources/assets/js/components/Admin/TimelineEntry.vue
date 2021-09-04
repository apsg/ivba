<template>
    <div class="d-flex timeline-item my-2 align-items-center">
        <div class="d-flex flex-column align-items-center justify-content-center pl-1">
            <i class="fa fa-circle-o"></i>
        </div>
        <div class="p-3">
            {{ entry.date }}
        </div>
        <div class="p-3" v-html="entry.content">
        </div>
    </div>
</template>

<script>
export default {
    name: "TimelineEntry",
    props: ['entry']
}
</script>

<style lang="scss" scoped>
.timeline-item {
    border-left: 1px black dashed;
    background-color: rgba(100,240,123,0.1);
}
</style>
