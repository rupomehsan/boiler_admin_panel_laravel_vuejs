<template>
    <Layout>
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 ">
                <form @submit.prevent="LoginSubmitHandler">
                    <h3>Forgot Password</h3>
                    <div class="form-group">
                        <label for="email">Enter your email</label>
                        <input type="email" placeholder="Enter your email" name="email" onchange="errorReset(event)">
                        <p class="alert-danger" id="email"></p>
                    </div>

                    <button class="my-4 btn btn-outline-success" type="submit" id="spiner">
                        <span>Send</span>
                        <span class="spinner-border spinner-border-sm d-none mx-2" role="status"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Loading...</span>
                    </button>
                    <Link href="/" class="text-primary">Go to home page</Link> <br>
                    <Link href="/verify-code" class="text-info">Go to verify page</Link> <br>
                </form>
            </div>
        </div>
    </Layout>
</template>
<script>
import Layout from "../Layout/Layout.vue";
export default {
    components: { Layout },

}
</script>
