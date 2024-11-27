<script>
export default {
  name: "PasswordReset",

  props: {
    user: {
      type: Number,
      required: true
    }
  },

  data() {
    return {
      'new_password': null
    }
  },

  methods: {
    reset() {
      axios.post('/admin/user/reset_password', {
        id: this.user
      })
        .then((res) => {
          this.new_password = res.data.password;
        })
    }
  }

}
</script>

<template>
  <div class="mt-3">
    <button
      class="btn btn-warning"
      @click="reset"
    > Resetuj i pobierz hasło
    </button>

    <div class="mt-1">
      <input type="text" disabled v-model="new_password">
    </div>

  </div>
</template>

<style scoped lang="scss">

</style>
