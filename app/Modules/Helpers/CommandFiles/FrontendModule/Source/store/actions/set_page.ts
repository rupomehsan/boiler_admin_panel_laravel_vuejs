import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function set_page (page=1){
    let state = mapWritableState(store, [
        'page'
    ]);

    state.page.set(page);
}

export default set_page;
