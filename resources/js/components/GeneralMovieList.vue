<template>
    <div>
<!--        <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 mb-5">-->
<!--            <a class="navbar-brand" href="#">moviewari</a>-->
<!--            <button class="btn btn-outline-dark my-2 my-sm-0 ml-auto" type="submit" data-toggle="modal" data-target="#searchMovieModal">-->
<!--                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">-->
<!--                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>-->
<!--                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>-->
<!--                </svg>-->
<!--            </button>-->
<!--        </nav>-->
        <div class="container">
            <header class="sticky-top">
                <div class="clearfix pt-4 pb-4">
                    <div class="float-left">
                        <h1 class="text-white font-weight-bold mt-2">moviewari</h1>
                    </div>
                    <div class="float-right">
                        <button class="btn btn-outline-dark my-2 my-sm-0 ml-auto" type="submit" @click="openSearchMovieModal">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </header>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 mb-5" v-for="movie in movies">
                   <general-movie-card v-bind:movie="movie"></general-movie-card>
                </div>
            </div>
        </div>
        <search-movie-modal ref="searchMovieModal" v-bind:movies="movies" v-bind:categories="categories"
                            @movie-has-searched="$emit('movie-has-searched',$event)"></search-movie-modal>
        <qr-modal></qr-modal>
    </div>
</template>

<script>
    import GeneralMovieCard from "./GeneralMovieCard";
    import SearchMovieModal from "./SearchMovieModal";
    import QrModal from "./QrModal";
    export default {
        name: "GeneralMovieList",
        components: {QrModal, SearchMovieModal, GeneralMovieCard},
        props: ['movies','categories'],
        methods: {
            openSearchMovieModal: function () {
                this.$refs.searchMovieModal.open();
            },
        }
    }
</script>

<style scoped>

</style>
