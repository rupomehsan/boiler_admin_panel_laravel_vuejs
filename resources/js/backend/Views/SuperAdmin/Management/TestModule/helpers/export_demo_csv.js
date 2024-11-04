import CsvBuilder from "./filify";
import setup from "../setup";



let store_prefix = setup.store_prefix;

function export_demo_csv() {
    const columns = ["id", "name", "email", "phone"];
    const values = [
        [1, "name", "example@gmail.com", "019846232266"]
    ];

    new CsvBuilder(`${store_prefix}_demo_list.csv`)
        .setColumns(columns)
        .addRows(values)
        .exportFile();

}

export default export_demo_csv;
