import CsvBuilder from "./filify";
import setup from "../setup";

let store_prefix = setup.store_prefix;

function export_selected_csv(data) {
    let col = Object.keys(data[0]);
    let values = data.map((i) => Object.values(i));

    new CsvBuilder(`${store_prefix}_list.csv`)
        .setColumns(col)
        // .addRow(["Eve", "Holt"])
        .addRows(values)
        .exportFile();
}

export default export_selected_csv;
