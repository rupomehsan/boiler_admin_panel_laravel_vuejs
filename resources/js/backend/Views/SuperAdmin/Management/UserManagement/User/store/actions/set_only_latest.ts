import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function set_only_latest_data (value=true){
    let state = mapWritableState(store, [
        'only_latest_data'
    ]);

    state.only_latest_data.set(value);
}

export default set_only_latest_data;
