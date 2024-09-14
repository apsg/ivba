<template>
  <div class="row">
    <div class="col-12">
      <div class="faq-accordion" id="accordion">
        <div class="card mb-2 border-0"
             v-for="card in cards"
             :key="card.id" v-bind:class="{'active-card': collapsedId === card.id}">
          <div class="card-header" v-bind:id="'heading' + card.id">
            <h5 class="mb-0">
              <button v-on:click="setCollapsedId(card.id)" class="w-100 btn btn-link"
                      style="text-decoration: none !important;"
                      data-toggle="collapse"
                      v-bind:data-target="'#collapse' + card.id" aria-expanded="true"
                      v-bind:aria-controls="'collapse' + card.id">
                <div class="d-flex justify-content-between align-items-center color-gray" >
                  <span>{{ card.title }}</span>
                  <i class="fa fa-2x" v-bind:class="[collapsedId === card.id ? 'fa-caret-up' : 'fa-caret-down']"></i>
                </div>
              </button>
            </h5>
          </div>
          <div v-bind:id="'collapse' + card.id" class="collapse" style="transition-duration: 100ms;"
               v-bind:class="{'show' : collapsedId === card.id}"
               v-bind:aria-labelledby="'heading' + card.id" data-parent="#accordion">
            <div class="card-body" v-html="card.description"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FaqAccordion",
  props: ["email", "phone"],
  data() {
    return {
      collapsedId: null,
      cards: [
        {
          id: 1,
          title: 'Czy dostęp do platformy jest dożywotni?',
          description: 'Dostęp do platformy jest w modelu miesięcznym lub rocznym.',
        },
        {
          id: 2,
          title: 'Czy otrzymam fakturę za dostęp do platformy? ',
          description: 'Jasne, wystarczy, że w kokpicie uzupełnisz dane do faktury.',
        },
        {
          id: 3,
          title: 'W jaki sposób mogę zapłacić za dostęp do platformy?',
          description: `<a href="buy_access">TUTAJ</a> dostępne możliwości zapłaty. Jeśli masz jakieś pytania śmiało pisz na ${this.email}`,
        },
        {
          id: 4,
          title: 'Platforma nie spełniła moich oczekiwań, czy mogę dokonać zwrotu?',
          description: `Tak, jeśli po zakupie stwierdzisz, że materiały nie spełniły Twoich oczekiwań wystarczy, że do nas napiszesz na maila: ${this.email}`,
        },
        {
          id: 5,
          title: 'Nie jestem zdecydowany/a gdzie mogę otrzymać więcej informacji?',
          description: `Możesz napisać do nas na adres: ${this.email}.`,
        },
      ]
    }
  },
  methods: {
    setCollapsedId(id) {
      this.collapsedId = this.collapsedId === id ? null : id;
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
