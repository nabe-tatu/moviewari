<template>
    <div>
        <div class="modal fade" id="adminEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">管理者情報</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">

                            <div class="invalid-feedback d-block" v-for="error in nameErrors">
                                {{ error }}
                            </div>

                            <div class="invalid-feedback d-block" v-for="error in emailErrors">
                                {{ error }}
                            </div>

                            <div class="invalid-feedback d-block" v-for="error in passwordErrors">
                                {{ error }}
                            </div>

                            <div class="invalid-feedback d-block" v-for="error in newPasswordErrors">
                                {{ error }}
                            </div>

                            <div class="invalid-feedback d-block" v-for="error in confirmPasswordErrors">
                                {{ error }}
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">管理者名</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">メールアドレス</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">現在のパスワード</label>
                                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">新しいパスワード</label>
                                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="newPassword">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">パスワード(確認)</label>
                                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="confirmPassword">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary mx-auto" @click="updateData">更新</button>
                            <button type="button" class="btn btn-outline-danger mx-auto" @click="deleteData">削除</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "AdminEdit",
        props: ['user'],
        data: function () {
            return{
                name: '',
                email: '',
                password: '',
                newPassword: '',
                confirmPassword: '',
                nameErrors: [],
                emailErrors: [],
                passwordErrors: [],
                newPasswordErrors: [],
                confirmPasswordErrors: [],
            }
        },
        methods: {
            open: function () {
                this.name = this.user.attributes.name;
                this.email = this.user.attributes.email;

                this.password = '';
                this.newPassword = ''
                this.confirmPassword = '';

                this.nameErrors = [];
                this.emailErrors = [];
                this.passwordErrors = [];
                this.newPasswordErrors = [];
                this.confirmPasswordErrors = [];

                $('#adminEditModal').modal('show');
            },
            close: function(){
                this.user.attributes.name = this.name;
                this.user.attributes.email = this.email;

                $('#adminEditModal').modal('hide');
            },
            updateData: function () {
                if (this.newPassword === this.confirmPassword){

                    axios.patch('/api/v1/users/' + this.user.id,{
                        'name': this.name,
                        'email': this.email,
                        'password': this.password,
                        'newPassword': this.newPassword,
                        'confirmPassword':this.confirmPassword
                    })
                        .then(() => {
                            this.close();
                        })
                        .catch((error) => {
                            this.name = this.user.attributes.name;
                            this.email = this.user.attributes.email;

                            this.nameErrors = error.response.data.errors['name'];
                            this.emailErrors = error.response.data.errors['email'];
                            this.passwordErrors = error.response.data.errors['password'];
                            this.newPasswordErrors = error.response.data.errors['newPassword'];
                            this.confirmPasswordErrors = error.response.data.errors['confirmPassword'];

                            console.log(error);
                        });
                }else{
                    this.newPassMessage = 'パスワードが異なります';
                }
            },
            deleteData: function () {
                axios.delete('/api/v1/users/' + this.user.id)
                    .then(() => {
                        window.location.href = "/";
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
        },
    }
</script>

<style scoped>

</style>
