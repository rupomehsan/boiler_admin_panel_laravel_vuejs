<template>
    <div class="container">

        <div class="row mt-3 justify-content-center">
            <div class="col-lg-6 card my-5 p-2">
                <div class="account-heading mb-25">
                    <h2 class="text-center">Login</h2>
                </div>
                <div class="account-form form-style p-20 mb-30 bg-fff box-shadow">
                    <form @submit.prevent="submitHandlerForLogin">
                        <b>Username or email address <span>*</span></b>
                        <input type="text" name="email">
                        <b>Password <span>*</span></b>
                        <input type="password" name="password">
                        <div class="login-button">
                            <div class="d-flex gap-3 align-items-center">
                                <button type="submit">Login</button>
                                <b>Remember me </b>
                                <input class="mt-2" style="width: 15px;" type="checkbox" name="remember">
                            </div>
                            <a href="#">Lost your password?</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="col-lg-6">
                <div class="account-heading mb-25">
                    <h2>Register</h2>
                </div>
                <div class="account-form form-style p-20 mb-30 bg-fff box-shadow">
                    <form action="#">
                        <b>Name <span>*</span></b>
                        <input type="text">
                        <b>Email address <span>*</span></b>
                        <input type="text">
                        <b>Phone <span>*</span></b>
                        <input type="text">
                        <b>Password <span>*</span></b>
                        <input type="password">
                        <b>Confirm Password <span>*</span></b>
                        <input type="password">
                    </form>
                    <div class="login-button">
                        <button>register</button>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        submitHandlerForLogin: async function () {
            let formData = new FormData(event.target);
            let response = await axios.post('login', formData);
            if (response.data.status === "success") {
                localStorage.setItem('token', response.data?.data?.access_token);
                if (response.data?.data?.user.role_id == 3) {
                    window.location.href = 'profile';
                }
                if (response.data?.data?.user.role_id != 3) {
                    window.location.href = 'admin';
                }

            }

        }
    }
};
</script>
<style lang="scss" scoped></style>
