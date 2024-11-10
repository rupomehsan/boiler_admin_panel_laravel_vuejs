<template>
    <Layout>
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-md-6 ">
                <form @submit.prevent="RegisterSubmitHandler">
                    <h3>Register Here</h3>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="name" placeholder="Enter your name" name="name"
                            onchange="errorReset(event)">
                        <p class="alert-danger" id="name"></p>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input class="form-control" type="phone" placeholder="Enter your phone" name="phone_number"
                            onchange="errorReset(event)">
                        <p class="alert-danger" id="phone"></p>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" placeholder="Enter your email" name="email"
                            onchange="errorReset(event)">
                        <p class="alert-danger" id="email"></p>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-icon">
                            <input class="form-control" :type="showPassword ? 'text' : 'password'"
                                placeholder="Enter your password" name="password" value="@12345678"
                                onchange="errorReset(event)">
                            <i class="fa-solid fa-eye-slash" :class="{ 'fa-eye': showPassword }"
                                @click="showPassword = !showPassword"></i>
                        </div>

                        <p class="alert-danger" id="password"></p>
                    </div>

                    <button class="my-4 btn btn-outline-success" type="submit" id="spiner">
                        <span v-if="!loading">Register</span>
                        <template v-if="loading">
                            <span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span>
                            <span class="">Loading...</span>
                        </template>
                    </button>
                    <span>Dont have an account ?</span>
                    <Link href="/login" class="font-size-12 text-primary"> Login</Link> <br>
                    <Link href="/forgot-password" class="text-info">Forgot Password ?</Link>
                </form>
            </div>
            <!-- <div class="col-md-6">
                    <div id="userList">
                        <table class="table table-dark table-striped table-hover  table-bordered">
                            <thead class="sticky-top">
                                <tr>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div> -->
        </div>
    </Layout>
</template>
<script>
import Layout from "./Layout/Layout.vue";
export default {
    components: { Layout },

    data() {
        return {
            showPassword: false,
            loading: false,
        }
    },
    methods: {

        RegisterSubmitHandler: async function () {
            try {
                this.loading = true
                let formData = new FormData(event.target);
                let response = await axios.post('/register', formData);
                console.log(response);

                if (response.data?.status === 'success') {
                    let data = response.data?.data;
                    if (data.access_token) {
                        localStorage.setItem('user_token', data.access_token);
                        window.location.href = '/';
                    }
                }
            } catch (error) {
                console.error("Login error", error);
            } finally {
                this.loading = false
            }
        }


    }

}
</script>
