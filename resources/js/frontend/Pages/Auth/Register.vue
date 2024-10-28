<template>
    <Layout>
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-md-6 ">
                <form @submit.prevent="LoginSubmitHandler">
                    <h3>Register Here</h3>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" placeholder="Enter your name" name="name" onchange="errorReset(event)">
                        <p class="alert-danger" id="name"></p>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="phone" placeholder="Enter your phone" name="phone" onchange="errorReset(event)">
                        <p class="alert-danger" id="phone"></p>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" placeholder="Enter your email" name="email" onchange="errorReset(event)">
                        <p class="alert-danger" id="email"></p>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-icon">
                            <input class="" :type="showPassword ? 'text' : 'password'" placeholder="Enter your password"
                                name="password" value="@12345678" onchange="errorReset(event)">
                            <i class="fa-solid fa-eye-slash" :class="{ 'fa-eye': showPassword }"
                                @click="showPassword = !showPassword"></i>
                        </div>

                        <p class="alert-danger" id="password"></p>
                    </div>

                    <button class="my-4 btn btn-outline-success" type="submit" id="spiner">
                        <span>Log In</span>
                        <span class="spinner-border spinner-border-sm d-none mx-2" role="status"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Loading...</span>
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
            showPassword: false
        }
    },

}
</script>

