import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function set_status (value="active"){
    let state = mapWritableState(store, [
        'status'
    ]);
    state.status.set(value);
}

export default set_status;
