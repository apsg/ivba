<template>
  <div class="tooltip-container">
    <div class="pointer" @mouseenter="expand = true" @mouseleave="expand=false" @click="expand = !expand">
      <slot></slot>
    </div>
    <div class="text-gray-light tooltip-text bg-white p-3 font-size-12 m-2 border rounded rounded-50" v-if="expand">
      <slot name="text"></slot>
    </div>
  </div>
</template>
<script>

export default {
  name: "TooltipInfo",

  data() {
    return {
      expand: true
    }
  },

  props: {}
}
</script>

<style scoped lang="scss">
.tooltip-container{
  position: relative;

  .tooltip-text{
    position: absolute;
    border: 1px solid  #9E9E9E;
  }
}
.pointer {
  cursor: pointer;
}
</style>
