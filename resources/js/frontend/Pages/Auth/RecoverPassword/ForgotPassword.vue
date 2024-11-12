<template>
    <Layout>
        <div v-if="step_one" class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 ">
                <form @submit.prevent="ForgotPasswordSubmitHandler">
                    <h3>Forgot Password</h3>

                    <div class="form-group">
                        <label for="email">Enter your email</label>
                        <input class="form-control" type="email" placeholder="Enter your email" name="email">

                    </div>

                    <button class="my-4 btn btn-outline-success" type="submit" id="spiner">
                        <span v-if="!loading">Send</span>
                        <template v-if="loading">
                            <span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span>
                            <span class="">Loading...</span>
                        </template>
                    </button>
                    <!-- <Link href="/" class="text-primary">Go to home page</Link> <br>
                    <Link href="/verify-code" class="text-info">Go to verify page</Link> <br> -->
                </form>
            </div>
        </div>
        <template v-if="step_two">
            <verify-code :email="email"></verify-code>
        </template>
    </Layout>
</template>
<script>
import Layout from "../Layout/Layout.vue";
import VerifyCode from './VerifyCode.vue';


export default {
    components: { Layout, VerifyCode },
    data() {


        return {
            loading: false,
            step_one: true,
            step_two: false,
            step_three: false,
            email: '',

        }
    },

    methods: {
        ForgotPasswordSubmitHandler: async function () {
            try {
                this.loading = true
                let formData = new FormData(event.target);
                let response = await axios.post('/send-otp', formData);
                if (response.data?.status === 'success') {
                    window.s_alert(response.data?.message);
                    this.step_one = false;
                    this.step_two = true;
                    this.email = response.data?.data?.email;
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
