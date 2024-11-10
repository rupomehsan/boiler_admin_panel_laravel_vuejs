<template>

    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6 ">
            <form @submit.prevent="ResetPasswordSubmitHandler">
                <h3>Reset Password</h3>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <div class="password-icon">
                        <input class="form-control" :type="showPassword ? 'text' : 'password'"
                            placeholder="Enter your password" name="password" value="@12345678"
                            onchange="errorReset(event)">
                        <i class="fa-solid fa-eye-slash" :class="{ 'fa-eye': showPassword }"
                            @click="showPassword = !showPassword"></i>
                    </div>

                    <p class="alert-danger" id="password"></p>
                </div>
                <div class="form-group">
                    <label for="password">Confirm New Password</label>
                    <div class="password-icon">
                        <input class="form-control" :type="showConfirmPassword ? 'text' : 'password'"
                            placeholder="Enter your password" name="confirmed" value="@12345678"
                            onchange="errorReset(event)">
                        <i class="fa-solid fa-eye-slash" :class="{ 'fa-eye': showConfirmPassword }"
                            @click="showConfirmPassword = !showConfirmPassword"></i>
                    </div>

                    <p class="alert-danger" id="password"></p>
                </div>

                <button class="my-4 btn btn-outline-success" type="submit" id="spiner">
                    <span v-if="!loading">Submit</span>
                    <template v-if="loading">
                        <span class="spinner-border spinner-border-sm  mx-2" role="status" aria-hidden="true"></span>
                        <span class="">Loading...</span>
                    </template>
                </button>

                <a href="/" class="font-size-12 text-primary">Goto home page</a> <br>

            </form>
        </div>

    </div>

</template>
<script>
import Layout from "../Layout/Layout.vue";
export default {
    components: { Layout },
    props: ['email'],
    data: () => ({
        showPassword: false,
        showConfirmPassword: false,
        loading: false
    }),
    methods: {
        ResetPasswordSubmitHandler: async function () {
            try {
                this.loading = true
                let formData = new FormData(event.target);
                formData.append('email', this.email);
                let response = await axios.post('/reset-password', formData);
                if (response.data?.status === 'success') {
                    window.s_alert(response.data?.message);
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 500)
                }
            } catch (error) {
                console.error("Login error", error);
            } finally {
                this.loading = false
            }
        },


    }
}
</script>
