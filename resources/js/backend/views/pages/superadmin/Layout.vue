<template>
    <div>
        <side-bar></side-bar>
        <div class="page-body">
            <!-- Container-fluid starts -->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3>super admin Page
                                <small>Universal Admin panel</small>
                            </h3>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active">Sample Page</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends -->
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import SideBar from './SideBar.vue'
export default {
    components: { SideBar },

}
</script>

<style></style>
