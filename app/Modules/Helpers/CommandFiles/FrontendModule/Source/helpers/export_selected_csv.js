import CsvBuilder from "./filify";
import setup from "../setup";
import { store } from "../store";
import { mapActions, mapState, mapWritableState } from "pinia";

let store_prefix = setup.store_prefix;

function export_selected_csv(data) {
    const excludedColumns = ["deleted_at", "created_at", "updated_at"];
    let col = Object.keys(data[0]).filter(
        (key) => !excludedColumns.includes(key)
    );
    let values = data.map(
        (row) => col.map((key) => row[key])
    );

    new CsvBuilder(`${store_prefix}_list.csv`)
        .setColumns(col)
        .addRows(values)
        .exportFile();

    let state = mapWritableState(store, ["selected"]);
    state.selected.set([]);
    document.querySelector('.select_all_checkbox').checked = false;
}

export default export_selected_csv;
