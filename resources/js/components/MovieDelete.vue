<template>
    <div>
<!--        &lt;!&ndash; Button trigger modal &ndash;&gt;-->
<!--        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">-->
<!--            映画削除-->
<!--        </button>-->

        <!-- Modal -->
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
                                    <td>割引額</td>
                                    <td>{{ discount }}</td>
                                </tr>
                                <tr>
                                    <td>上映日</td>
                                    <td>{{ date }}</td>
                                </tr>
                                <tr>
                                    <td>上映時間</td>
                                    <td>{{ time }}</td>
                                </tr>
                                <tr>
                                    <td>URL</td>
                                    <td>{{ url }}</td>
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
        name: "MovieDelete",
        data: function(){
            return {
                movie: null,
                name: '',
                discount: null,
                date: null,
                time: null,
                url: ''
            }
        },
        methods: {
            open: function (movie) {
                this.movie = movie;
                this.name = movie.relationships.movie.attributes.name;
                this.discount = movie.attributes.discount;
                this.date = movie.attributes.date;
                this.time = movie.attributes.time;
                this.url = movie.attributes.url;
                $('#deleteModal').modal('show');
            },
            close: function(){
                $('#deleteModal').modal('hide');
            },
            deleteData: function () {
                axios.delete('/api/v1/movieUser/' + this.movie.id)
                    .then(() => {
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
