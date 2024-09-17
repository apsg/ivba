<template>
  <div class="overlay hidden" id="overlay">
    <div style="text-align: right" class="py-3 px-1">
      <a href="#" @click="hide">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
          <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
        </svg>
      </a>
    </div>
    <div class="px-3">
      <h5>Co nowego</h5>
    </div>
    <div class="pl-3 bg-white-faded post">
      <div v-for="post in news" class="bg-white rounded p-1">
        <img :src="post.img"/>
        <div class="date">{{ post.published_at }}</div>
        <h3>{{ post.title }}</h3>
        <div v-html="post.body"></div>
        <a :href="post.cta_url" class="btn btn-coral">Dowiedz się więcej</a>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Overlay',

  props: {
    'news': {
      type: Array
    }
  },

  methods: {
    hide() {
      document.getElementById('overlay').classList.add('hidden');
    }
  }
}
</script>

<style scoped lang="scss">
.overlay {
  &.hidden {
    display: none;
  }

  z-index: 1000;
  position: absolute;
  top: 0px;
  right: 0px;
  width: 30%;
  height: 100%;
  background-color: white;
  overflow-y: scroll;

  @media (max-width: 786px) {
    width: 100%;
  }

  .post {
    img{
      width: 100%;
    }
  }
}
</style>
