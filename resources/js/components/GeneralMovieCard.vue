<template>
    <div>
        <div class="card">
            <div class="card-header">
                {{ movie.relationships.user.attributes.name }}
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="mb-4">
                        <h5 class="card-title text-center">『{{ movie.relationships.movie.attributes.name }}』</h5>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="thumbs">
                                <img :src="'/storage/' + movie.relationships.movie.attributes.picture" class="img img-responsive full-width">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                {{ movie.relationships.movie.relationships.category.attributes.category }}映画
                            </div>
                            <div class="mb-4">
                                上映日：{{ movie.attributes.date }}
                            </div>
                            <div class="mb-4">
                                開始時間：{{ movie.attributes.time }}
                            </div>
                            <p>割引:{{ movie.attributes.discount }}円</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small><a :href="movie.relationships.movie.attributes.site_url">公式サイトへ</a></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark mx-auto" data-toggle="modal" data-target="#qrModal">QRコードを開く</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "GeneralMovieCard",
        props: ['movie']
    }
</script>

<style scoped>
    .card{
        opacity: 0.9;
    }
    .thumbs {
        width: 100%;
        max-width: 150px;
        position: relative;
    }
    .thumbs::before {
        content: "";
        display: block;
        padding-top: 100%;
    }
    .thumbs img {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        object-fit: cover;
        opacity: 1;
    }
</style>
