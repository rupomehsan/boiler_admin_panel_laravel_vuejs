import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function clear_selected (){
    let state = mapWritableState(store, [
        'selected'
    ]);

    state.selected.set([]);
}

export default clear_selected;
