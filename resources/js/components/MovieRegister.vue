<template>
    <div>
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">映画登録</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="invalid-feedback d-block" v-for="error in movieIdErrors">
                            {{ error }}
                        </div>

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
                            <div class="dropdown">
                                <label for="exampleInputEmail1">映画名</label>
                                <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-toggle="dropdown" v-model="movieText">
                                    {{ movieText }}
                                </button>
                                <div class="dropdown-menu w-100">
                                    <a class="dropdown-item" v-for="(movieMaster,index) in movieMasters" v-model="movieId" @click="movieSelected(movieMaster)">
                                        {{ movieMaster.attributes.name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">割引額</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                   v-model="discount">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">上映日</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                   v-model="date">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">上映時間</label>
                            <input type="time" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                   v-model="time">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">QRコードURL</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                   v-model="url">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary mx-auto" @click="createData">登録</button>
                        <button type="button" class="btn btn-outline-secondary mx-auto" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MovieRegister",
        props: ['movieMasters'],
        data: function () {
            return {
                movie: null,
                movieId: '',
                discount: '',
                date: '',
                time: '',
                url: '',
                movieIdErrors: [],
                discountErrors: [],
                dateErrors: [],
                timeErrors: [],
                urlErrors: [],
                movieText: '映画を選択してください'

            }
        },
        methods: {
            createData: function () {
                let formData = new FormData();
                formData.append('movie_id', this.movieId);
                formData.append('discount', this.discount);
                formData.append('date', this.date);
                formData.append('time', this.time);
                formData.append('url', this.url);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    }
                };
                axios.post('/api/v1/movieUser', formData, config)
                    .then((response) => {
                        this.close();
                        this.$emit('movie-has-registered', response.data.data)
                    })
                    .catch((error) => {
                        this.movieIdErrors = error.response.data.errors['movie_id'];
                        this.discountErrors = error.response.data.errors['discount'];
                        this.dateErrors = error.response.data.errors['date'];
                        this.timeErrors = error.response.data.errors['time'];
                        this.urlErrors = error.response.data.errors['url'];

                        this.movieId = '';
                        this.discount = '';
                        this.date = '';
                        this.time = '';
                        this.url = '';

                        console.log(error);
                    });

            },
            open: function () {
                this.movieId = '';
                this.discount = '';
                this.date = '';
                this.time = '';
                this.url = '';
                this.movieText = '映画を選択してください';

                this.movieIdErrors = [];
                this.discountErrors = [];
                this.dateErrors = [];
                this.timeErrors = [];
                this.urlErrors = [];
                $('#registerModal').modal('show');
            },
            close: function () {
                this.movieId = '';
                this.discount = '';
                this.date = '';
                this.time = '';
                this.url = '';
                $('#registerModal').modal('hide');
            },
            movieSelected: function (movieMaster) {
                this.movieId = movieMaster.id;
                this.movieText = movieMaster.attributes.name;
            }
        }
    }
</script>

<style scoped>

</style>
