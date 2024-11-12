<template>
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title"> Profile Settings</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javaScript:void();">Dashtreme</a></li>
                    <li class="breadcrumb-item"><a href="javaScript:void();">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
            </div>
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <button type="button" class="btn btn-light waves-effect waves-light"><i class="fa fa-cog mr-1"></i>
                        Setting</button>
                    <button type="button"
                        class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                        data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="javaScript:void();" class="dropdown-item">Action</a>
                        <a href="javaScript:void();" class="dropdown-item">Another action</a>
                        <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a href="javaScript:void();" class="dropdown-item">Separated link</a>
                    </div>
                </div>
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

                    <div class="card-body border-top border-light">
                        <div class="media align-items-center">
                            <div class="icon-block">
                            <a href="javascript:void();"><i class="fa fa-facebook bg-facebook text-white"></i></a>
                            <a href="javascript:void();"> <i class="fa fa-twitter bg-twitter text-white"></i></a>
                            <a href="javascript:void();"> <i
                                    class="fa fa-google-plus bg-google-plus text-white"></i></a>
                        </div>
                        </div>
                        <hr>


                    </div>
                </div>

            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                            <li class="nav-item">
                                <a href="javascript:void();" data-target="#profile" data-toggle="pill"
                                    class="nav-link active"><i class="icon-user"></i> <span
                                        class="hidden-xs">Profile</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void();" data-target="#messages" data-toggle="pill"
                                    class="nav-link"><i class="icon-envelope-open"></i> <span
                                        class="hidden-xs">Messages</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i
                                        class="icon-note"></i> <span class="hidden-xs">Edit</span></a>
                            </li>
                        </ul>
                        <div class="tab-content p-3">
                            <div class="tab-pane active" id="profile">
                                <h5 class="mb-3">User Profile</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>About</h6>
                                        <p>
                                            Web Designer, UI/UX Engineer
                                        </p>
                                        <h6>Hobbies</h6>
                                        <p>
                                            Indie music, skiing and hiking. I love the great outdoors.
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Recent badges</h6>
                                        <a href="javascript:void();" class="badge badge-dark badge-pill">html5</a>
                                        <a href="javascript:void();" class="badge badge-dark badge-pill">react</a>
                                        <a href="javascript:void();" class="badge badge-dark badge-pill">codeply</a>
                                        <a href="javascript:void();" class="badge badge-dark badge-pill">angularjs</a>
                                        <a href="javascript:void();" class="badge badge-dark badge-pill">css3</a>
                                        <a href="javascript:void();" class="badge badge-dark badge-pill">jquery</a>
                                        <a href="javascript:void();" class="badge badge-dark badge-pill">bootstrap</a>
                                        <a href="javascript:void();"
                                            class="badge badge-dark badge-pill">responsive-design</a>
                                        <hr>
                                        <span class="badge badge-primary"><i class="fa fa-user"></i> 900
                                            Followers</span>
                                        <span class="badge badge-success"><i class="fa fa-cog"></i> 43 Forks</span>
                                        <span class="badge badge-danger"><i class="fa fa-eye"></i> 245 Views</span>
                                    </div>
                                    <div class="col-md-12">
                                        <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span>
                                            Recent Activity</h5>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <strong>Abby</strong> joined ACME Project Team in
                                                            <strong>`Collaboration`</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Gary</strong> deleted My Board1 in
                                                            <strong>`Discussions`</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Kensington</strong> deleted MyBoard3 in
                                                            <strong>`Discussions`</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>John</strong> deleted My Board1 in
                                                            <strong>`Discussions`</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Skell</strong> deleted his post Look at Why this
                                                            is.. in <strong>`Discussions`</strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                            </div>
                            <div class="tab-pane" id="messages">
                                <div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <div class="alert-icon">
                                        <i class="icon-info"></i>
                                    </div>
                                    <div class="alert-message">
                                        <span><strong>Info!</strong> Lorem Ipsum is simply dummy text.</span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span class="float-right font-weight-bold">3 hrs ago</span> Here is
                                                    your a link to the latest summary report from the..
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="float-right font-weight-bold">Yesterday</span> There
                                                    has been a request on your account since that was..
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="float-right font-weight-bold">9/10</span> Porttitor
                                                    vitae ultrices quis, dapibus id dolor. Morbi venenatis lacinia
                                                    rhoncus.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="float-right font-weight-bold">9/4</span> Vestibulum
                                                    tincidunt ullamcorper eros eget luctus.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="float-right font-weight-bold">9/4</span> Maxamillion
                                                    ais the fix for tibulum tincidunt ullamcorper eros.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="edit">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">First name</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="Mark">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="Jhonsan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="email" value="mark@example.com">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Change profile</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="file">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Website</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="url" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="" placeholder="Street">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" value="" placeholder="City">
                                        </div>
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" value="" placeholder="State">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="jhonsanmark">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="password" value="11111122333">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Confirm
                                            password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="password" value="11111122333">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <input type="reset" class="btn btn-secondary" value="Cancel">
                                            <input type="button" class="btn btn-primary" value="Save Changes">
                                        </div>
                                    </div>
                                </form>
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
import { auth_store } from "../../../../GlobalStore/auth_store";
import { mapState } from 'pinia';
export default {
    computed: {
        ...mapState(auth_store, {
            auth_info: 'auth_info',
        }),
    },
}
</script>

<style></style>
