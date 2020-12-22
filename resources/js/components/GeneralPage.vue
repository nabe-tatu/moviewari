<template>
    <div class="general">
        <general-movie-list v-bind:movies="movies" v-bind:categories="categories"
                            @movie-has-searched="searchedMovie($event)"></general-movie-list>
    </div>
</template>

<script>
    import GeneralMovieList from "./GeneralMovieList";
    export default {
        name: "GeneralPage",
        components: {GeneralMovieList},
        data:function () {
            return{
                movies: [],
                categories: []
                // user: {},
                // name: '',
                // discount: null,
                // date: null,
                // time: null,
                // url: ''
            }
        },
        created: function () {
            this.loadMovieData();
            this.loadCategoryData();
        },
        methods: {
            loadMovieData: function() {
                axios.get('api/v1/general')
                    .then((response) => {
                        this.movies = response.data.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            loadCategoryData: function () {
                axios.get('api/v1/categories')
                    .then((response) => {
                        this.categories = response.data.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            searchedMovie: function ($event) {
                this.movies = $event;
            }
        }
    }
</script>

<style scoped>

</style>
