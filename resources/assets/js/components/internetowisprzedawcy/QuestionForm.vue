<template>
  <div class="modal-content px-5 py-3">
    <div class="modal-header">
      <h5 class="text-center w-100">
        <img :src="icon"/>
      </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="reset">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body" v-if="!success">
      <h3 class="font-size-16 mb-3">Masz pytanie lub problem? Skontaktuj się z nami:</h3>

      <h5 class="font-size-12 text-gray">Jesteś tutaj:</h5>
      <h6 class="text-bold text-black" v-if="course.id">Kurs: {{ course.title }}</h6>
      <h6 class="text-bold text-black mb-5" v-if="lesson.id">Lekcja: {{ lesson.title }}</h6>

      <div class="alert alert-danger mb-1" v-if="error">
        Wpisz swoją wiadomość.
      </div>

      <textarea
        class="form-control rounded-50 p-4 "
        style="min-height: 500px"
        v-model="message"
        placeholder="Opisz tutaj swoją sprawę..."
      ></textarea>

      <div class="form-group" v-if="showPhone">

        <label>
          Numer telefonu
        </label>
        <input type="text" class="form-control" v-model="phone">
      </div>

    </div>
    <div class="modal-body p-5" v-if="success">
      <div class="alert alert-success my-5">
        Wiadomość wysłana. Skontaktujemy się z Tobą tak szybko, jak to możliwe.
      </div>
    </div>
    <div class="modal-footer d-flex justify-content-between">
      <button
        @click="reset()"
        type="button" class="btn btn-outline-secondary" data-dismiss="modal">
        <i class="fa fa-caret-left"></i> Powrót
      </button>
      <button
        v-if="!success"
        @click.prevent="send"
        type="button"
        class="btn btn-red-outline">
        Wyślij wiadomość
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "QuestionForm",

  props: {
    'course': {
      type: Object
    },
    'lesson': {
      type: Object
    },
    'showPhone': {
      type: Boolean,
      required: false,
      default: false,
    },
    'icon': {
      type: String,
      required: true,
    }
  },

  data() {
    return {
      message: '',
      phone: '',
      error: false,
      success: false
    }
  },

  methods: {
    send() {
      this.error = false;

      axios.post('/a/question', {
        course: this.course.id,
        lesson: this.lesson.id,
        message: this.message,
        phone: this.phone,
      }).then(r => {
        console.log(r);
        this.success = true;
        document.getElementById('askQuestionButton').disabled = true;
      }).catch(r => {
        this.error = true;
      });
    },

    reset() {
      setTimeout(() => {
        this.message = '';
        this.phone = '';
        this.error = false;
        this.success = false;
      }, 1000);
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
