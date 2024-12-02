import { anyObject } from '../../../../../../../../common_types/object'
import setup from '../setup';
export const initialState = {
    /** loading status */
    is_loading: false,
    loading_text: 'loading..',

    /* data store */
    all: {} as anyObject,
    item: {} as anyObject,
    url: '',

    /*_______________*/
    /* data filters */

    select_fields: setup.select_fields,
    sort_by_cols: setup.sort_by_cols,
    sort_by_col: 'id',
    sort_type: 'DESC',
    start_date: '',
    end_date: '',

    filter_criteria: {} as anyObject,
    all_data_count: 0, // total data in database
    active_data_count: 0,
    inactive_data_count: 0,
    trased_data_count: 0,
    page: 1,
    paginate: 10,
    search_key: ``,

    orderByCol: 'id',
    orderByAsc: true,


    status: 'active', // active | inactive

    /*_______________*/

    /* selected data */
    selected: [] as Array<anyObject>, // selected data using checkbox

    /* trigger showing data modal */
    show_filter_canvas: false,
    show_quick_view_canvas: false,
    show_management_modal: false,
    modal_selected_qty: 1, // how much will checked from management modal

    /* trigger showing data form canvas */
    show_create_canvas: false,
    show_edit_canvas: false,
    show_details_canvas: false,

    /*_______________*/
    cached: 0,
    only_latest_data: false,
};



