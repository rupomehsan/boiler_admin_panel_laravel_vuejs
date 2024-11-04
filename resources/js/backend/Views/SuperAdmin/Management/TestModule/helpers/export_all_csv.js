import CsvBuilder from "./filify";
import setup from "../setup";
import { mapActions, mapState, mapWritableState } from "pinia";
import { store } from "../store";

let store_prefix = setup.store_prefix;

async function export_all_csv() {

    let cconfirm = await window.s_confirm("export all");

    if (!cconfirm) return;

    window.start_loader();
    let export_csv;
    let last_page = 1;
    let url = new URL(`${setup.api_host}/${setup.api_version}/${setup.api_end_point}`);
    url.searchParams.set('page', 1);
    url.searchParams.set('paginate', 10);

    for (let index = 1; index <= last_page; index++) {

        let response = await axios.get(url.href);
        last_page = response.data.data.last_page;
        // Get columns from the keys of the first item in the data array
        const firstRow = response.data.data.data[0];
        let except_columns = ['deleted_at', 'created_at', 'updated_at'];
        const columns = firstRow
            ? Object.keys(firstRow).filter(key => !except_columns.includes(key))
            : [];

        export_csv = new CsvBuilder(`${store_prefix}_list.csv`).setColumns(columns);

        let values = response.data.data.data.map((item) =>
            Object.keys(item)
                .filter(key => !except_columns.includes(key))
                .map(key => item[key])
        );

        export_csv.addRows(values);
        let progress = Math.round((100 * index) / last_page);
        window.update_loader(progress);
    }

    await export_csv.exportFile();
    window.remove_loader();
}

window.start_loader = function () {
    $('.loader').addClass('active');
    $('.load_amount h4').html(5);
    $('.progress').width(5 + "%");
}

window.update_loader = function (progress) {
    $('.loader').addClass('active');
    $('.load_amount h4').html(progress);
    $('.progress').width(progress + "%");
}

window.remove_loader = function () {
    $('.loader').removeClass('active');
    $('.load_amount h4').html(5);
    $('.progress').width(5 + "%");
}

export default export_all_csv;
