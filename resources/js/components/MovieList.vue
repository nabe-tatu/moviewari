<template>
<div>
    <div class="container">
        <div class="row">
            <div class="input-group mb-5 col-8">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                          <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                        </svg>
                    </span>
                </div>
                <input type="text" class="form-control" aria-label="Sizing example input"
                       aria-describedby="inputGroup-sizing-default"
                       v-model="keyword">
            </div>
            <div class="col-2 text-right">
                <button type="button" class="btn btn-outline-dark"
                        @click="openRegisterModal">＋</button>
            </div>
            <div class="col-2 text-center" data-toggle="tooltip" title="Tooltip message">
                <button type="button" class="btn btn-outline-dark" @click="openTheaterEditModal">✏︎</button>

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 mb-5" v-for="movie in filteredMovies">
                <movie-card v-bind:movie="movie" @edit-button-has-clicked="openEditModal($event)"
                                                 @delete-button-has-clicked="openDeleteModal($event)"></movie-card>
            </div>
        </div>
    </div>
    <movie-register ref="registerModal" v-bind:movieMasters="movieMasters" @movie-has-registered="$emit('movie-has-registered',$event)"></movie-register>
    <movie-edit ref="editModal" @movie-has-updated="$emit('movie-has-updated',$event)"></movie-edit>
    <movie-delete ref="deleteModal" @movie-has-deleted="$emit('movie-has-deleted',$event)"></movie-delete>
    <theater-edit ref="theaterEditModal" v-bind:user="user"></theater-edit>
</div>
</template>

<script>
    import MovieCard from "./MovieCard";
    import MovieEdit from "./MovieEdit";
    import MovieDelete from "./MovieDelete";
    import MovieRegister from "./MovieRegister";
    import TheaterEdit from "./TheaterEdit";
    export default {
        name: "MovieList",
        components: {TheaterEdit, MovieRegister, MovieDelete, MovieEdit, MovieCard},
        props: ['movies', 'user', 'movieMasters'],
        data: function(){
          return {
              keyword: ''
          }
        },
        methods: {
            openEditModal: function ($event) {
                this.$refs.editModal.open($event);
            },
            openDeleteModal: function ($event) {
                this.$refs.deleteModal.open($event);
            },
            openTheaterEditModal: function () {
                this.$refs.theaterEditModal.open();
            },
            openRegisterModal: function () {
                this.$refs.registerModal.open();
            },
            closeRegisterModal: function ($event) {
                this.$refs.registerModal.close($event);
            },
            closeTheaterEditModal: function ($event) {
                this.$refs.theaterEditModal.close($event);
            }
        },
        computed: {
            filteredMovies: function () {
                let movies = [];
                for (let i in this.movies) {
                    let movie = this.movies[i];
                    if (Object.keys(this.user).length && movie.relationships.movie.attributes.name.indexOf(this.keyword) !== -1){
                        movies.push(movie);
                    }
                }
                return movies;
            }
        }
    }
</script>

<style scoped>

</style>
