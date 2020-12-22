<template>
    <div>
        <div class="card">
            <div class="card-header">
                {{ movie.attributes.name }}
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="thumbs">
                                <img :src="'/storage/' + movie.attributes.picture" class="img img-responsive full-width">
                            </div>
                        </div>
                        <div class="col-6">
                            <p>{{ movie.relationships.category.attributes.category }}映画</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small><a :href="movie.attributes.site_url">公式サイトへ</a></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="mx-auto">
                    <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#editModal"
                            @click="$emit('edit-button-has-clicked',movie)">編集</button>
                    <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#deleteModal"
                            @click="$emit('delete-button-has-clicked',movie)">削除</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "AdminMovieCard",
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
