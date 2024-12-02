<template lang="">
    <a href="/destroy" @click.prevent="destroy_data" class="border-danger">
        <i class="fa fa-trash text-danger"></i>
        Destroy
    </a>

</template>
<script>
import { mapActions } from 'pinia';
import { store } from '../../../store';

export default {
    props: {
        item: {
            slug: "",
        }
    },
    methods: {
        ...mapActions(store, [
            `restore`,
            `destroy`,
            `get_all`,
            `set_only_latest_data`,
            `set_item`,
        ]),
        destroy_data: async function(){
            let con = await window.s_confirm('Permanently delete');
            if(con){
                this.set_item(this.item);
                this.set_only_latest_data(true);

                let res = await this.destroy();
                await this.get_all();
                if(res.data.status == "success"){
                    window.s_alert('Permanently deleted.');
                }

                this.set_only_latest_data(false);
            }
        },
    }

}


</script>
<style lang="">

</style>

