<template lang="">
    <router-link
        :to="{name: `Create${setup.route_prefix}`}"
        class="btn action_btn mr-2 btn-sm btn-info d-flex align-content-center align-items-center">
        <i class="fa fa-edit mr-2"></i>
        Create
    </router-link>
</template>
<script>
import setup from "../../../setup"
export default {
    data: ()=>({
        setup,
    })
}
</script>
<style lang="">

</style>
