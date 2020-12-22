<template>
    <div>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">映画削除</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td>映画名</td>
                                <td>{{ name }}</td>
                            </tr>
                            <tr>
                                <td>公式サイト</td>
                                <td>{{ siteUrl }}</td>
                            </tr>
                            <tr>
                                <td>映画イメージ</td>
                                <td><img :src="'/storage/' + picture" class="img-fluid"></td>
                            </tr>
                            <tr>
                                <td>カテゴリー</td>
                                <td>{{ category }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger mx-auto" @click="deleteData">削除</button>
                        <button type="button" class="btn btn-outline-secondary mx-auto" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AdminMovieDelete",
        data:function () {
            return {
                movie: {},
                name: '',
                siteUrl: '',
                picture: '',
                category: '',
            }
        },
        methods: {
            open: function (movie) {
                this.movie = movie;
                this.name = movie.attributes.name;
                this.siteUrl = movie.attributes.site_url;
                this.picture = movie.attributes.picture;
                this.category = movie.relationships.category.attributes.category;

                //this.picture = movie.attributes.picture;
                $('#deleteModal').modal('show');
            },
            close: function(){
                $('#deleteModal').modal('hide');
            },
            deleteData: function () {
                axios.delete('/api/v1/movies/' + this.movie.id)
                    .then(() => {
                        //console.log(this.movie.id);
                        this.$emit('movie-has-deleted', this.movie);
                        this.close();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
