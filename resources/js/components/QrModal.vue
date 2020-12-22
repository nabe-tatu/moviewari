<template>
<div>
    <!-- Modal -->
    <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">このQRコードを提示してください</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="d-block mx-auto" :src="'/img/qr.jpeg'">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "QrModal"
    }
</script>

<style scoped>

</style>
