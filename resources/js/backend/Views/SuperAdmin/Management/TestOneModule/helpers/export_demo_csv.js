import CsvBuilder from "./filify";
import setup from "../setup";

let store_prefix = setup.store_prefix;

function export_demo_csv() {
    const columns = setup.select_fields;
    const excludedColumns = ['id', 'created_at','slug','deleted_at','updated_at'];  // List of columns to exclude

    // Filter out excluded columns from the columns array
    const filteredColumns = columns.filter(column => !excludedColumns.includes(column));
    console.log("ddd", filteredColumns);

    // Generate values row where excluded columns are omitted (this is just a placeholder example)
    const values = [Array(filteredColumns.length).fill("-")];

    new CsvBuilder(`${store_prefix}_demo_list.csv`)
        .setColumns(filteredColumns) // Use the filtered columns
        .addRows(values)
        .exportFile();
}

export default export_demo_csv;
