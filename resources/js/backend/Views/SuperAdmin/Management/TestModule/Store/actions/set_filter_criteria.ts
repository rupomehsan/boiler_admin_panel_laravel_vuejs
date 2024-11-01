import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function set_filter_criteria (data={}){
    let state = mapWritableState(store, [
        'filter_criteria'
    ]);

    state.filter_criteria.set(data);
}

export default set_filter_criteria;
