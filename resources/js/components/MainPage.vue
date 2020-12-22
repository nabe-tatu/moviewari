<template>
<div>
    <movie-list v-bind:movies="movies"
                v-bind:user="user"
                v-bind:movieMasters="movieMasters"
                 @movie-has-deleted="deleteDataFromPage($event)"
                @movie-has-updated="updateDataInThisPage($event)"
                @movie-has-registered="createDataInThisPage($event)"></movie-list>
</div>
</template>

<script>
    import MovieList from "./MovieList";
    export default {
        name: "MainPage",
        components: {MovieList},
        data:function () {
            return{
                movies: [],
                movieMasters: [],
                user: {},
                name: '',
                discount: null,
                date: null,
                time: null,
                url: ''
            }
        },
        created: function () {
            this.loadMovieUserData();
            this.loadUserData();
            this.loadMovieData();
        },
        methods:{
            loadMovieUserData: function () {
                axios.get('api/v1/movieUser')
                    .then((response) => {
                        this.movies = response.data.data;
                        console.log(this.movies);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            loadUserData: function () {
                axios.get('api/v1/users')
                    .then((response) => {
                        this.user = response.data.data;
                        //console.log(response.data.data);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            loadMovieData: function () {
                axios.get('api/v1/movies')
                    .then((response) => {
                        this.movieMasters = response.data.data;
                        //console.log(response.data.data);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            createDataInThisPage: function ($event) {
                this.movies.unshift($event);
            },
            updateDataInThisPage: function ($event) {
                const index = this.movies.findIndex(function (movie) {
                    return movie.id === $event.id;
                })
                if (index !== -1) {
                    this.movies.splice(index, 1, $event);
                }
            },
            deleteDataFromPage: function ($event) {
                const index = this.movies.findIndex(function (movie) {
                    return movie.id === $event.id;
                })
                if (index !== -1) {
                    this.movies.splice(index, 1);
                }
            },
        }
    }
</script>

<style scoped>

</style>
