<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div>
                    上映日：{{ movie.attributes.date }}
                </div>
                <div>
                    開始時間：{{ movie.attributes.time }}
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <h5 class="card-title text-center">{{ movie.relationships.movie.attributes.name }}</h5>
                    <div class="row">
                        <div class="col-6">
                            <div class="thumbs">
                                <img :src="'/storage/' + movie.relationships.movie.attributes.picture" class="img img-responsive full-width">
                            </div>                        </div>
                        <div class="col-6">
                            <p>{{ movie.attributes.discount }}円引き</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small><a :href="movie.relationships.movie.attributes.site_url">公式サイトへ</a></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="mx-auto">
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editModal"
                            @click="$emit('edit-button-has-clicked',movie)">
                        映画編集
                    </button>
                </div>
                <div class="mx-auto">
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal"
                            @click="$emit('delete-button-has-clicked',movie)">
                        映画削除
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MovieCard",
        props: ['movie'],

    }
</script>

<style scoped>
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
    }
</style>
