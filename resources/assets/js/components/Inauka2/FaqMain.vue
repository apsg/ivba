<script>
export default {
  name: "FaqMainPage",
  data() {
    return {
      collapsedId: 1,
      cards: [
        {
          id: 1,
          title: 'Czy wystawiacie fakturę vat? (+ gdzie znaleźć fakturę?)',
          subtitle: 'Tak, wystawiamy faktury',
          description: `<p class="my-3"> Jesteśmy polską firma</p>
                        <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, totam!</p>`,
        },
        {
          id: 2,
          title: 'Jak uzyskam certyfikat szkolenia? ',
          subtitle: 'Tak, wystawiamy faktury',
          description: `<p class="my-3"> Jesteśmy polsk firma</p>
                        <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, totam!</p>`,
        },
        {
          id: 3,
          title: 'Czy mogę pobtać fimly na dysk?',
          subtitle: 'Tak, wystawiamy faktury',
          description: `<p class="my-3"> Jesteśmy polsk firma</p>
                        <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, totam!</p>`,
        },
        {
          id: 4,
          title: 'Platforma nie spełniła moich oczekiwań, czy mogę dokonać zwrotu?',
          subtitle: 'Tak, wystawiamy faktury',
          description: `<p class="my-3"> Jesteśmy polsk firma</p>
                        <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, totam!</p>`,
        },
        {
          id: 5,
          title: 'Nie jestem zdecydowany/a gdzie mogę otrzymać więcej informacji?',
          subtitle: 'Tak, wystawiamy faktury',
          description: `<p class="my-3"> Jesteśmy polsk firma</p>
                        <p class="my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, totam!</p>`,
        },
      ]
    }
  },
  methods: {
    setCollapsedId(id) {
      this.collapsedId = this.collapsedId === id ? null : id;
    }
  },
  computed: {
    selectedCard() {
      return this.cards.find(card => card.id === this.collapsedId) || null;
    }
  }
}
</script>

<template>
  <div>
    <span class="color-red subtitle-1">FAQ</span>
    <h3 class="h3-headline color-graphite">Najczęściej zadawane pytania</h3>
    <div class="row">
      <div class="col-12 col-md-5">
        <div class="card border-0 bg-transparent my-3"
             v-for="card in cards"
             :key="card.id"
             :class="{'selected-card' : card.id === collapsedId}">
          <button v-on:click="setCollapsedId(card.id)"
                  class="w-100 btn btn-link text-start color-graphite bg-color-white-box rounded"
                  style="text-decoration: none !important;">
            <div class="color-graphite p-2"
            >
              <span>{{ card.title }}</span>
              <div class="pt-2 text-black d-md-none" v-if="card.id === collapsedId" v-html="card.description">
              </div>
            </div>
          </button>
        </div>
      </div>
      <div class="col-12 offset-md-1 col-md-6 d-none d-md-flex align-content-center flex-wrap">
        <div v-if="selectedCard" class="">
          <h4>{{ selectedCard.subtitle }}</h4>
          <div v-html="selectedCard.description">
          </div>
        </div>
      </div>
    </div>
    <p class="p-3 font-sora text-uppercase" style="scale: 50%">
      Masz inne pytania?
      <a
        class="color-red "
        href="mailto:hello@inauka.pl">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
          <g id="Group_582" data-name="Group 582" transform="translate(-11073.56 -852) rotate(-90)">
            <rect id="Rectangle_373" data-name="Rectangle 373" width="25" height="25"
                  transform="translate(-877 11073.56)" fill="none"/>
            <path id="Path_4155" data-name="Path 4155" d="M4.6,0,0,.017,4.041,10.11.085,20,4.7,19.983,8.656,10.11Z"
                  transform="translate(-854 11082.172) rotate(90)" fill="currentColor"/>
          </g>
        </svg>
        Napisz do nas na hello@inauka.pl
      </a>
    </p>
  </div>
</template>

<style scoped lang="scss">
</style>
