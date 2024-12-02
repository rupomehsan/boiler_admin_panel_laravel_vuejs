<template>
    <div class="modal fade " :class="`${import_csv_modal_show ? 'show d-block' : 'd-none'}`" id="primarymodal"
        aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <form @submit.prevent="FileUploadHandler">
                <div class="modal-content border-primary">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white">Import {{ setup.prefix }} </h5>
                        <button @click="import_csv_modal_show = false" type="button" class="close text-white"
                            data-dismiss="modal" aria-label="Close">
                            <!-- <span aria-hidden="true">×</span> -->
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <label for="">Upload file</label>
                            <input type="file" name="file" class="form-control " required>
                        </div>
                        <p class="mt-3">Please check the sample CSV file below to ensure compatibility with the demo
                            data
                            import.</p>
                        <a href="" @click.prevent="export_demo_csv" class="btn btn-sm btn-primary">Download Demo
                            CSV</a>
                    </div>
                    <div class="modal-footer">
                        <button @click="import_csv_modal_show = false" type="button" class="btn btn-light"
                            data-dismiss="modal"><i class="fa fa-times"></i>
                            Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-download"></i> Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import setup from "../../setup";
import { mapActions, mapWritableState } from 'pinia';
import { store } from '../../store';
export default {

    data: () => ({
        setup,
    }),

    computed: {
        ...mapWritableState(store, [
            'import_csv_modal_show',
        ])
    }

}
</script>

<style></style>
