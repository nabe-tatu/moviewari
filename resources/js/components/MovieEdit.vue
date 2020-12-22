<template>
    <div>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">映画編集</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">

                            <div class="invalid-feedback d-block" v-for="error in discountErrors">
                                {{ error }}
                            </div>

                            <div class="invalid-feedback d-block" v-for="error in dateErrors">
                                {{ error }}
                            </div>

                            <div class="invalid-feedback d-block" v-for="error in timeErrors">
                                {{ error }}
                            </div>

                            <div class="invalid-feedback d-block" v-for="error in urlErrors">
                                {{ error }}
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">割引額</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" v-model="discount">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">上映日</label>
                                <input type="date" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" v-model="date">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">上映時間</label>
                                <input type="time" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" v-model="time">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">QRコードURL</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" v-model="url">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary mx-auto" @click="updateData">編集
                            </button>
                            <button type="button" class="btn btn-outline-secondary mx-auto" data-dismiss="modal">閉じる
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MovieEdit",
        data: function () {
            return {
                movie: null,
                discount: '',
                date: '',
                time: '',
                url: '',
                discountErrors: [],
                dateErrors: [],
                timeErrors: [],
                urlErrors: [],
            }
        },
        methods: {
            open: function (movie) {
                this.movie = movie;
                this.discount = movie.attributes.discount;
                this.date = movie.attributes.date;
                this.time = movie.attributes.time;
                this.url = movie.attributes.url;

                this.discountErrors = [];
                this.dateErrors = [];
                this.timeErrors = [];
                this.urlErrors = [];
                $('#editModal').modal('show');
            },
            close: function () {
                $('#editModal').modal('hide');
            },

            updateData: function () {

                let formData = new FormData();
                formData.append('discount', this.discount);
                formData.append('date', this.date);
                formData.append('time', this.time);
                formData.append('url', this.url);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-HTTP-Method-Override': 'PUT'
                    }
                };

                axios.post('/api/v1/movieUser/' + this.movie.id, formData, config)
                    .then((response) => {
                        this.$emit('movie-has-updated', response.data.data);
                        this.close();
                    })
                    .catch((error) => {
                        this.discount = this.movie.attributes.discount;
                        this.date = this.movie.attributes.date;
                        this.time = this.movie.attributes.time;
                        this.url = this.movie.attributes.url;

                        this.discountErrors = error.response.data.errors['discount'];
                        this.dateErrors = error.response.data.errors['date'];
                        this.timeErrors = error.response.data.errors['time'];
                        this.urlErrors = error.response.data.errors['url'];

                        console.log(error);
                    });
            },
        }
    }
</script>

<style scoped>

</style>
