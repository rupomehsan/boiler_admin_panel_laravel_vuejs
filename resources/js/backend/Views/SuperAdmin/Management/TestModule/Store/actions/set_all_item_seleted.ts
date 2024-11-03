import { mapWritableState } from "pinia";
import { store } from "..";

function set_all_item_selectd(event){
    console.log(event.target.checked);

    const state  = mapWritableState(store, [
        `selected`,
        `all`,
    ]);

    if(event.target.checked){
        let temp_selected = state.selected.get();
        state.all.get().data.forEach(item => {
            temp_selected = temp_selected.filter(i => i.id != item.id);
            temp_selected.push(item);
        });
        console.log(temp_selected);

        state.selected.set(temp_selected);
    }else{
        state.selected.set([]);
    }
}

export default set_all_item_selectd;
