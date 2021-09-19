<template>
    <div>
        <div class="innr-banner fullwidth">
            <img src="images/wishlist-banner.jpg">
            <div class="heading">
                <h2>login</h2>
             </div>
        </div><!--/.banner-->

        <div class="container innr-cont-area">
            <div class="row">
                <div class="col-sm-12 about-us">
                    <form class="col-lg-10 col-lg-offset-1" @submit.prevent="submit">
                        <div class="form-group mt-10 mb-10 fullwidth">
                            <label for="exampleInputusername1">usernameAddress</label>
                            <input type="username" class="form-control" id="exampleInputusername1" aria-describedby="usernameHelp" placeholder="username" v-model="credentials.username">
                        </div>
                        <div class="form-group mt-10 mb-10 fullwidth">
                            <label for="exampleInputPassword1">password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="password" v-model="credentials.password">
                        </div>
                        <div class="form-check clearfix mt-10 mb-10">

                        </div>
                        <br>
                        <button class="btn btn-danger rounded-0">login</button>
                    </form>
                </div><!--/.col-sm-12-->
            </div>

        </div><!--/.innr-cont-area-->
    </div>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        name: 'login',

        data() {
            return {
                credentials: {
                    username: '',
                    password: '',
                },
            };
        },
        methods: {
            ...mapActions('authModule', [
                'login',
            ]),
            submit() {
                this.login({ ...this.credentials })
                    .then(() => {
                        this.$router.push({name: 'home'});
                    })
                    .catch((errors) => {
                        // Handle Errors
                        this.$swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: errors.data.message,
                        });
                    });
            }
        }
    }
</script>
