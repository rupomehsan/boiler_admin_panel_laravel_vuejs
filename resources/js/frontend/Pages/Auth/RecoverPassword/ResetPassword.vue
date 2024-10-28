<template>
    <Layout>
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 ">
                <form @submit.prevent="LoginSubmitHandler">
                    <h3>Reset Password</h3>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <div class="password-icon">
                            <input class="" :type="showPassword ? 'text' : 'password'" placeholder="Enter your password"
                                name="password" value="@12345678" onchange="errorReset(event)">
                            <i class="fa-solid fa-eye-slash" :class="{ 'fa-eye': showPassword }"
                                @click="showPassword = !showPassword"></i>
                        </div>

                        <p class="alert-danger" id="password"></p>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm New Password</label>
                        <div class="password-icon">
                            <input class="" :type="showConfirmPassword ? 'text' : 'password'" placeholder="Enter your password"
                                name="password" value="@12345678" onchange="errorReset(event)">
                            <i class="fa-solid fa-eye-slash" :class="{ 'fa-eye': showConfirmPassword }"
                                @click="showConfirmPassword = !showConfirmPassword"></i>
                        </div>

                        <p class="alert-danger" id="password"></p>
                    </div>

                    <button class="my-4 btn btn-outline-success" type="submit" id="spiner">
                        <span>Submit</span>
                        <span class="spinner-border spinner-border-sm d-none mx-2" role="status"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Loading...</span>
                    </button>

                    <a href="/" class="font-size-12 text-primary">Goto home page</a> <br>

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
import Layout from "../Layout/Layout.vue";
export default {
    components: { Layout },
    data: () => ({
        showPassword: false,
        showConfirmPassword: false
    })
}
</script>
