<template>
    <div class="row">
        <div class="col-12">
            <div class="text-center mb-4">
                <h2>FAQ</h2>
            </div>
            <div class="faq-accordion" id="accordion">
                <div class="card mb-2"  v-for="card in cards" :key="card.id" v-bind:class="{'active-card': collapsedId === card.id}">
                    <div class="card-header" v-bind:id="'heading' + card.id">
                        <h5 class="mb-0">
                            <button v-on:click="setCollapsedId(card.id)" class="w-100 btn btn-link" data-toggle="collapse" v-bind:data-target="'#collapse' + card.id" aria-expanded="true" v-bind:aria-controls="'collapse' + card.id">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>
                                        {{ card.title }}
                                    </span>
                                    <i class="fa fa-2x"  v-bind:class="[collapsedId === card.id ? 'fa-caret-up' : 'fa-caret-down']"></i>
                                </div>
                            </button>
                        </h5>
                    </div>
                    <div v-bind:id="'collapse' + card.id" class="collapse" style="transition-duration: 100ms;" v-bind:aria-labelledby="'heading' + card.id" data-parent="#accordion">
                        <div class="card-body">
                            {{ card.description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FaqAccordion",
        data() {
            return {
                collapsedId: null,
                cards: [
                    {   
                        id: 1,
                        title: 'Czy mogę zapłacić za platformę przelewem tradycyjnym?',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                    },
                    {   
                        id: 2,
                        title: 'Czy mogę zapłacić za platformę przelewem tradycyjnym?2',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                    },
                    {   
                        id: 3,
                        title: 'Czy mogę zapłacić za platformę przelewem tradycyjnym?3',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                    },
                    {   
                        id: 4,
                        title: 'Czy mogę zapłacić za platformę przelewem tradycyjnym?4',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                    },
                    {   
                        id: 5,
                        title: 'Czy mogę zapłacić za platformę przelewem tradycyjnym?5',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
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

<style scoped>

</style>
