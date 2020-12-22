<template>
<div>
    <div class="modal fade" id="searchMovieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">検索</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">映画館名</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="theater">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">映画名</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="movie">
                    </div>
                    <div class="form-group">
                        <div class="dropdown">
                            <label for="exampleInputEmail1">カテゴリー</label>
                            <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-toggle="dropdown" v-model="categoryText">
                                {{ categoryText }}
                            </button>
                            <div class="dropdown-menu w-100">
                                <a class="dropdown-item" v-for="(category,index) in categories" v-model="categoryId" @click="categorySelected(category)">
                                    {{ category.attributes.category }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">上映日</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="date">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">割引額</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="discount">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary mx-auto" @click="search">検索</button>
                    <button type="button" class="btn btn-outline-secondary mx-auto" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "SearchMovieModal",
        props: ['movies','categories'],
        data: function () {
            return {
                movie: '',
                theater: '',
                date: '',
                discount: '',
                categoryId: 0,
                categoryText: 'カテゴリーを選択してください'
            }
        },
        methods: {
            search: function () {
                let params = {
                    movie:this.movie,
                    theater:this.theater,
                    date:this.date,
                    discount:this.discount,
                    categoryId:this.categoryId
                }
                axios.get('api/v1/filteredIndex', {
                    params: {
                        search : params
                    }
                })
                    .then((response) => {
                        this.close();
                        this.$emit('movie-has-searched',response.data.data);
                        this.movie = '';
                        this.theater = '';
                        this.date = '';
                        this.discount = '';
                        this.categoryId = 0;
                    })
                    .catch((error) => {
                        console.log(error);
                    });

            },
            open: function () {
               this.categoryText = 'カテゴリーを選択してください';
               this.categoryId = 0;
                $('#searchMovieModal').modal('show');
            },
            close: function(){
                $('#searchMovieModal').modal('hide');
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
