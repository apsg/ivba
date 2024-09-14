<template>
  <div>
    <iframe
      :src="`https://customer-gnl8urc1wq6n6cqi.cloudflarestream.com/`+this.uid+`/iframe`"
      style="border: none"
      :height="this.height"
      :width="this.width"
      allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;"
      allowfullscreen="true"
      id="stream-player"
    ></iframe>
  </div>
</template>
<script>

export default {
  name: "CludflareVideo",

  props: {
    uid: {
      type: String
    },
    width: {
      type: Number,
      default: 1280
    },
  },

  data() {
    return {
      height: 720
    }
  },

  mounted() {
    this.height = 0.5625 * this.width;
    console.log(this.uid);
  }
}

</script>
<style scoped lang="scss">

</style>
