import CsvBuilder from "./filify";
import setup from "../setup";
import {store} from "../store";
import { mapActions, mapState, mapWritableState } from "pinia";


let store_prefix = setup.store_prefix;

function export_selected_csv(data) {
    let col = Object.keys(data[0]);
    let values = data.map((i) => Object.values(i));

    new CsvBuilder(`${store_prefix}_list.csv`)
        .setColumns(col)
        .addRows(values)
        .exportFile();

    let state = mapWritableState(store, [
        'selected',
    ]);
    state.selected.set([]);
}

export default export_selected_csv;
