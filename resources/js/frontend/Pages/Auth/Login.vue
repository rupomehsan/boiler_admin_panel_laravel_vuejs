<template>
    <Layout>
        <div class="row justify-content-center align-items-center gap-2 py-5">
            <div class="col-md-5 ">
                <form @submit.prevent="LoginSubmitHandler">
                    <h3>Login Here</h3>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" placeholder="Enter your email" name="email">
                    </div>
                    <div class="form-group password-icon">
                        <label for="password">Password</label>
                        <div class="password-icon">
                            <input class="form-control" :type="showPassword ? 'text' : 'password'"
                                placeholder="Enter your password" name="password" value="@12345678">
                            <i class="fa-solid fa-eye-slash"
                                :class="[{ 'fa-eye': showPassword }, passwordError ? 'top-33' : '']"
                                @click="showPassword = !showPassword"></i>
                        </div>
                    </div>

                    <button class="my-3 btn btn-outline-success" type="submit" id="spiner">
                        <span v-if="!loading">Log In</span>
                        <template v-if="loading">
                            <span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span>
                            <span class="">Loading...</span>
                        </template>
                    </button>
                    <span>Dont have an account ?</span>
                    <Link href="/register" class="font-size-12 text-primary"> Register</Link> <br>
                    <Link href="/forgot-password" class="text-info">Forgot Password ?</Link>
                </form>
            </div>
            <div class="col-md-5">
                <div id="userList">
                    <table class="table table-dark table-striped table-hover  table-bordered">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Email</th>
                                <!-- <th scope="col">Password</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Super Admin</td>
                                <!-- <td>@12345678</td> -->
                                <td>
                                    <button @click="setPassword('superadmin@gmail.com')"
                                        class="btn btn-outline-info">Login</button>
                                </td>
                            </tr>

                            <tr>
                                <td>Admin</td>
                                <!-- <td>@12345678</td> -->
                                <td>
                                    <button @click="setPassword('admin@gmail.com')"
                                        class="btn btn-outline-info">Login</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script>

import Layout from "./Layout/Layout.vue";
export default {
    components: { Layout },

    data() {
        return {
            loading: false,
            showPassword: false,
            passwordError: false
        }
    },

    methods: {
        LoginSubmitHandler: async function () {
            try {
                this.loading = true
                let formData = new FormData(event.target);
                let response = await axios.post('/login', formData);
                if (response.data?.status === 'success') {
                    let data = response.data?.data;
                    if (data.access_token) {
                        window.s_alert("Login Successfully");
                        localStorage.setItem('admin_token', data.access_token);
                        localStorage.setItem('admin_role', data.user?.role_id);
                        if (data.user?.role_id == 1) {
                            window.location.href = 'super-admin#/dashboard';
                        } else if (data.user?.role_id == 2) {
                            window.location.href = 'admin#/dashboard';
                        }
                    }
                }
            } catch (error) {
                console.error("Login error", error);
            } finally {
                this.loading = false
            }
        },
        setPassword(email) {
            let target = document.querySelector('[name="email"]')
            target.value = email
        }

    }
}
</script>

<style scoped>
.top-33 {
    top: 33% !important;
}
</style>
