import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function set_show_filter_canvas (value=true){
    let state = mapWritableState(store, [
        'show_filter_canvas'
    ]);
    state.show_filter_canvas.set(value);
}

export default set_show_filter_canvas;
