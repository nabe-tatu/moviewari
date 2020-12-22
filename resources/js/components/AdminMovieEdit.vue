<template>
    <div>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                            <div class="invalid-feedback d-block" v-for="error in nameErrors">
                                {{ error }}
                            </div>

                            <div class="invalid-feedback d-block" v-for="error in siteUrlErrors">
                                {{ error }}
                            </div>

                            <div class="invalid-feedback d-block" v-for="error in pictureErrors">
                                {{ error }}
                            </div>

                            <div class="invalid-feedback d-block" v-for="error in categoryIdErrors">
                                {{ error }}
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">映画名</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                v-model="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">公式サイトURL</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                       v-model="siteUrl">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">映画イメージ</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputFile" @change="fileSelected">
                                    <label class="custom-file-label" for="inputFile">{{ pictureText }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="dropdown">
                                    <label for="exampleInputEmail1">カテゴリー</label>
                                    <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-toggle="dropdown" v-model="categoryText">
                                        {{ categoryText }}
                                    </button>
                                    <div class="dropdown-menu w-100">
                                        <a class="dropdown-item" v-for="(category,index) in categories" @click="categorySelected(category)">
                                            {{ category.attributes.category }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary mx-auto" @click="updateData">編集</button>
                            <button type="button" class="btn btn-outline-secondary mx-auto" data-dismiss="modal">閉じる</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AdminMovieEdit",
        props: ['categories'],
        data:function () {
            return {
                movie: null,
                name: '',
                siteUrl: '',
                picture: '',
                categoryId: 0,
                nameErrors: [],
                siteUrlErrors: [],
                pictureErrors: [],
                categoryIdErrors: [],
                pictureText: '画像を選択してください',
                categoryText: 'カテゴリーを選択してください'
            }
        },
        methods: {
            updateData: function () {

                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('site_url', this.siteUrl);
                formData.append('category_id', this.categoryId);
                formData.append('picture',this.picture);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-HTTP-Method-Override': 'PUT'
                        //'enctype': 'multipart/form-data'
                    }
                };
                axios.post('/api/v1/movies/' + this.movie.id, formData, config)
                    .then((response) => {
                        this.$emit('movie-has-updated',response.data.data);
                        this.close();
                    })
                    .catch((error) => {
                        this.name = this.movie.attributes.name;
                        this.siteUrl = this.movie.attributes.site_url;
                        this.picture = this.movie.attributes.picture;
                        this.categoryId = this.movie.attributes.category_id;

                        this.nameErrors = error.response.data.errors['name'];
                        this.siteUrlErrors = error.response.data.errors['site_url'];
                        this.pictureErrors = error.response.data.errors['picture'];
                        this.categoryIdErrors = error.response.data.errors['category_id'];
                        console.log(error);
                    });
            },
            open: function (movie) {
                this.movie = movie;
                this.name = movie.attributes.name;
                this.siteUrl = movie.attributes.site_url;
                this.pictureText = movie.attributes.picture;
                this.categoryId = movie.attributes.category_id;
                this.categoryText = movie.relationships.category.attributes.category;

                this.nameErrors = [];
                this.siteUrlErrors = [];
                this.pictureErrors = [];
                this.categoryIdErrors = [];
                $('#editModal').modal('show');
            },
            close: function(){
                $('#editModal').modal('hide');
            },
            fileSelected: function (event) {
                this.picture = event.target.files[0];
            },
            categorySelected: function (category) {
                this.categoryId = category.id;
                this.categoryText = category.attributes.category;
            }
        }
    }
</script>

<style scoped>

</style>
