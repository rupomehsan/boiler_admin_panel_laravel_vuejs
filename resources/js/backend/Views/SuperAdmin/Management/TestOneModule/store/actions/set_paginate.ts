import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function set_paginate (paginate=10){
    let state = mapWritableState(store, [
        'paginate'
    ]);
    state.paginate.set(paginate);
}

export default set_paginate;
