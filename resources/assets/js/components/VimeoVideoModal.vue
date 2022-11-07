<template>
    <div class="iframe-vimeo" @click="toggleModal()">
        <img :src="image">
        <iframe style="pointer-events: none;" :src="videoSrc"
                frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen>
        </iframe>
        <button ref="modalButton" hidden type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"></button>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div style="max-width: 1200px;" class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div style="padding: 0" class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div ref="modalIframe" style="padding:56.15% 0 0 0;position:relative;">
                            <iframe id="modalVimeoIframe" :src="videoSrc"
                                style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                frameborder="0" allow="autoplay" allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Player from '@vimeo/player';

    export default {
        name: "VimeoVideoModal",

        mounted() {
            $('#exampleModalCenter').on('hide.bs.modal', function (event) {
                const iframe = $('#modalVimeoIframe');
                const player = new Player(iframe);
                player.pause();
            })
        },
        methods: {
            toggleModal() {
                this.$refs.modalButton.click();
            }
        },
        props: {
            videoSrc: {
                type: String,
                default: null,
            },
            image: {
                type: String,
                default: null,
            }
        },
    }
</script>

<style scoped lang="scss">
    .close {
        position:absolute;
        right:-30px;
        top:0;
        z-index:999;
        font-size:2rem;
        font-weight: normal;
        color:#fff;
        opacity:1;
    }
</style>
