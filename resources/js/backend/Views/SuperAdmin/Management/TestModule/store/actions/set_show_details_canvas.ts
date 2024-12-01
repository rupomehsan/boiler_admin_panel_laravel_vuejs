import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function set_show_details_canvas (value=true){
    let state = mapWritableState(store, [
        'show_details_canvas'
    ]);
    state.show_details_canvas.set(value);
}

export default set_show_details_canvas;
