import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function set_filter_criteria(data = {}) {
    let data_store = store()
    data_store.filter_criteria = {
        ...data_store.filter_criteria,
        ...data
    }
}

export default set_filter_criteria;
