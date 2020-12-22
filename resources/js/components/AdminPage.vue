<template>
    <div>
        <admin-movie-list v-bind:movies="movies"
                          v-bind:categories="categories"
                          v-bind:user="user"
                          @movie-has-registered="createDataInThisPage($event)"
                          @movie-has-updated="updateDataInThisPage($event)"
                          @movie-has-deleted="deleteDataFromPage($event)"></admin-movie-list>
    </div>
</template>

<script>
    import AdminMovieList from "./AdminMovieList";
    export default {
        name: "AdminPage",
        components: {AdminMovieList},
        data: function() {
          return{
              movies: [],
              categories: [],
              user: {}
          }
        },
        created: function () {
            this.loadMovieData();
            this.loadCategoryData();
            this.loadUserData();
        },
        methods:{
            loadMovieData: function () {
                axios.get('api/v1/movies')
                    .then((response) => {
                        //console.log(response.data.data);
                        this.movies = response.data.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            loadCategoryData: function () {
                axios.get('api/v1/categories')
                    .then((response) => {
                        //console.log(response.data.data);
                        this.categories = response.data.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            loadUserData: function () {
                axios.get('api/v1/users')
                    .then((response) => {
                        this.user = response.data.data;
                        //console.log(this.user);

                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            createDataInThisPage: function ($event) {
                this.movies.unshift($event);
            },
            updateDataInThisPage: function ($event) {

                console.log($event);

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
