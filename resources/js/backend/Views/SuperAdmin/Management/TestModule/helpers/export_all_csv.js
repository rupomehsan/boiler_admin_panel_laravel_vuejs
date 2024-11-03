import CsvBuilder from "./filify";
import setup from "../setup";
import { mapActions, mapState, mapWritableState } from "pinia";
import { store } from "../setup/store";

let store_prefix = setup.store_prefix;

async function export_all_csv() {
    let cconfirm = await window.s_confirm("export all");
    let state = mapWritableState(store, [
        'all',
    ]);

    if (!cconfirm) return;

    let col = Object.keys(state.all.get().data[0]);
    var export_csv = new CsvBuilder(
        `${store_prefix}_list.csv`
    ).setColumns(col);
    window.start_loader();

    let last_page = 1;

    for (let index = 1; index <= last_page; index++) {
        let url = new URL(`${setup.api_host}/${setup.api_version}/${setup.api_end_point}`);
        url.searchParams.set('page', index);
        url.searchParams.set('paginate', 10);

        let response = await axios.get(url.href);
        last_page = response.data.data.last_page;

        let values = response.data.data.data.map((i) =>
            Object.values(i)
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
