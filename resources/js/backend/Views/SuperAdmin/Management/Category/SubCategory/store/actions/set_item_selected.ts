import { mapWritableState } from "pinia";
import { store } from "..";

function set_item_selectd(item, event){
    const state  = mapWritableState(store, [
        `selected`,
    ]);

    let temp_selected = state.selected.get();

    let isChecked = event.target.checked
    if (isChecked) {
        temp_selected.push(item);
    } else {
        temp_selected = temp_selected.filter(i => i.id != item.id);
    }

    state.selected.set(temp_selected);

    let select_all_checkbox = document.querySelector('.select_all_checkbox');
    if(select_all_checkbox){
        (select_all_checkbox as HTMLInputElement).checked = false;
    }
}

export default set_item_selectd;
