import CsvBuilder from "./filify";
import setup from "../setup";



let store_prefix = setup.store_prefix;

function export_demo_csv() {
    const columns = setup.select_fields;
    const values = [Array(columns.length).fill("-")];

    new CsvBuilder(`${store_prefix}_demo_list.csv`)
        .setColumns(columns)
        .addRows(values)
        .exportFile();

}

export default export_demo_csv;
