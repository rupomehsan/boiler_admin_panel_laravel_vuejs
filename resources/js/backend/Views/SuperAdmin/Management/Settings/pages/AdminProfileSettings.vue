<template>
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title"> Profile Settings</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card profile-card-2">
                    <div class="card-img-block">
                        <img class="img-fluid bg-dark" src="avatar.png" alt="Card image cap">
                    </div>
                    <div class="card-body pt-5">
                        <img :src="`${auth_info.image ?? 'avatar.png'}`" alt="profile-image" class="profile">
                        <h5 class="card-title text-capitalize">Name : {{ auth_info.name }}</h5>
                        <p class="card-text">Eamil : {{ auth_info.email }}</p>
                        <p class="card-text">Phone : {{ auth_info.phone ?? 'N/A' }}</p>
                        <p class="card-text">Address : {{ auth_info.address ?? 'N/A' }}</p>
                    </div>
                    <div class="card-body  border-light">
                        <div class="media align-items-center">
                            <div class="icon-block">
                                <a href="javascript:void();"><i class="fa fa-facebook bg-facebook text-white"></i></a>
                                <a href="javascript:void();"> <i class="fa fa-twitter bg-twitter text-white"></i></a>
                                <a href="javascript:void();"> <i
                                        class="fa fa-google-plus bg-google-plus text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                            <li class="nav-item" @click="tab = 'edit'">
                                <a :class="tab == 'edit' ? ' active' : ''" href="javascript:void();" data-target="#edit"
                                    data-toggle="pill" class="nav-link "><i class="icon-note"></i> <span
                                        class="hidden-xs">Edit</span></a>
                            </li>
                            <li class="nav-item" @click="tab = 'change_password'">
                                <a :class="tab == 'change_password' ? 'active' : ''" href="javascript:void();"
                                    data-target="#profile" data-toggle="pill" class="nav-link "><i
                                        class="icon-user"></i> <span class="hidden-xs">Change
                                        password</span></a>
                            </li>
                        </ul>
                        <div class="tab-content p-3">
                            <div v-if="tab == 'edit'" :class="tab == 'edit' ? ' active' : ''" class="tab-pane active"
                                id="profile">
                                <form @submit.prevent="UpdateProfileHandler" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                        <div class="col-lg-9">
                                            <input v-model="auth_info.name" name="name" class="form-control" type="text"
                                                value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input v-model="auth_info.email" name="email" class="form-control"
                                                type="email" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Phone</label>
                                        <div class="col-lg-9">
                                            <input v-model="auth_info.phone_number" name="phone_number"
                                                class="form-control" type="number" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                        <div class="col-lg-9">
                                            <input v-model="auth_info.address" name="address" class="form-control"
                                                type="text" value="" placeholder="Street">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Change image</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="image" type="file">
                                            <img v-if="auth_info.image" class="mt-2" :src="auth_info.image" height="100"
                                                width="100" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <input type="submit" class="btn btn-primary" value="Save Changes">
                                        </div>
                                    </div>

                                </form>

                            </div>
                            <div v-if="tab == 'change_password'" :class="tab == 'change_password' ? ' active' : ''"
                                class="tab-pane" id="change_password">
                                <form @submit.prevent="ChangePasswordHandler">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Current
                                            password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="current_password" type="password"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">New password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="new_password" type="password" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Confirm New
                                            password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="confirm_new_password" type="password"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <input type="submit" class="btn btn-primary" value="Save Changes">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div v-if="tab == 'message'" :class="tab == 'message' ? ' active' : ''" class="tab-pane"
                                id="message">
                                <table class="table table-striped table-active table-bordered">
                                    <tr v-for="i in 5" :key="i">
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End container-fluid-->
</template>

<script>
import { auth_store } from "../../../../../GlobalStore/auth_store";
import { settings_store } from "../store/store";
import { mapState, mapActions } from 'pinia';
export default {
    data: () => ({
        tab: 'edit',
    }),
    methods: {
        ...mapActions(auth_store, {
            check_is_auth: 'check_is_auth',
        }),
        UpdateProfileHandler: async function () {
            let formData = new FormData(event.target);
            let response = await axios.post('user-profile-update', formData);
            if (response.data.status == 'success') {
                window.s_alert(response.data.message)
                this.check_is_auth()
            }
        },
        ChangePasswordHandler: async function () {
            let formData = new FormData(event.target);
            let response = await axios.post('user-change-password', formData);
            if (response.data.status == 'success') {
                window.s_alert(response.data.message)
                this.check_is_auth()
            }
        }
    },
    computed: {
        ...mapState(auth_store, {
            auth_info: 'auth_info',
        }),
    },
}
</script>

<style></style>
