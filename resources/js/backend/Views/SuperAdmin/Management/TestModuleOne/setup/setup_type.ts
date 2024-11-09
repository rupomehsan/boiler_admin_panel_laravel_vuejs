    export default interface RouteConfig {
    permission: string[];

    prefix: string;
    module_name: string;
    route_prefix: string;
    store_prefix: string;
    route_path: string;

    api_host: string;
    api_version: string;
    api_end_point: string;

    select_fields: string[];
    sort_by_cols: string[];


    layout_title: string;

    page_title: string,
    all_page_title: string;
    details_page_title: string;
    create_page_title: string;
    edit_page_title: string;
}

