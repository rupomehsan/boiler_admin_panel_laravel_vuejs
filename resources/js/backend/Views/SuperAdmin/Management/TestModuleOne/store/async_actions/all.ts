import { mapState, mapWritableState } from "pinia";
import { anyObject } from "../../../../../../../../../common_types/object";
import { store } from "..";
import fetchDataAndUpdateCache from "../helpers/http";

import setup from "../../setup";
const { api_host, api_version, api_end_point } = setup;

let execute = async () => {
    let state = mapWritableState(store, [
        'url',
        'page',
        'paginate',
        'search_key',
        'sort_by_col',
        'sort_type',
        'status',
        'select_fields',
        'filter_criteria',

        'cached',
        'only_latest_data',
        'is_loading',
        'loading_text',

        'all',

        'all_data_count',
        'active_data_count',
        'inactive_data_count',
        'trased_data_count',
    ]);

    let qparams: anyObject = {
        params: {
            page: state.page.get(),
            paginate: state.paginate.get(),
            limit: state.paginate.get(),
            search_key: state.search_key.get(),
            search: state.search_key.get(),
            sort_by_col: state.sort_by_col.get(),
            sort_type: state.sort_type.get(),
            status: state.status.get(),
        },
    };

    // console.log(store, qparams);

    let response: anyObject = {};
    let url = `${api_host}/${api_version}/${api_end_point}`;
    let full_url: URL = new URL(url);
    let fetch_only_latest: boolean = state[`only_latest_data`].get();

    for (let param in qparams.params) {
        full_url.searchParams.set(param, qparams.params[param]);
    }

    state.select_fields.get().forEach(function (el, index) {
        full_url.searchParams.set(`selected_fields[${index}]`, el);
        full_url.searchParams.set(`fields[${index}]`, el);
    });

    let index = 0;


    for (let param in state.filter_criteria.get()) {
        let value = state.filter_criteria.get()[param];
        if (value) {
            full_url.searchParams.set(`filter_criterias[${index}][key]`, param);
            full_url.searchParams.set(`filter_criterias[${index}][value]`, value);
            index++;
            full_url.searchParams.set(param, value)
        }
    }

    state.is_loading.set(true);
    state.loading_text.set('loading..');

    if (
        state[`url`].get() &&
        state['search_key'].get().length === 0 &&
        Object.keys(state.filter_criteria.get()).length
    ) {
        url = state[`url`].get();
        // response = await axios.get(url, qparams);
        response = await fetchDataAndUpdateCache(url, fetch_only_latest);
    } else {
        // response = await axios.get(url, qparams);
        response = await fetchDataAndUpdateCache(
            full_url.href,
            fetch_only_latest,
        );
    }

    state.cached.set(response.totalStorage);

    state.all.set(response.data);
    state.all_data_count.set(response.data.total);
    state.active_data_count.set(response.data.active_data_count);
    state.inactive_data_count.set(response.data.inactive_data_count);
    state.trased_data_count.set(response.data.trased_data_count);

    state.is_loading.set(false);
    state.loading_text.set('');

    return response.data;
}

export default execute;
