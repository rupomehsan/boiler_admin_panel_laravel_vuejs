import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function set_item (data={}){
    let state = mapWritableState(store, [
        'item'
    ]);

    state.item.set(data);
}

export default set_item;
