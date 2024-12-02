
import app_config from "../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "TestOneModule";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "test-one-modules",

    module_name: "test-one-module",
    store_prefix: "test_one_module",
    route_prefix: "TestOneModule",
    route_path: "test-one-module",

    select_fields: [
        "id",
        "name",
            "email",
            "phone",
        "status",
        "slug",
        "created_at",
        "deleted_at",
    ],

    sort_by_cols: [
        "id",
        "name",
            "email",
            "phone",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "name",
            "email",
            "phone",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "name",
            "email",
            "phone",
        "status",
        "created_at",
    ],

    layout_title: prefix + " Management",
    page_title: `${prefix} Management`,

    all_page_title: "All " + prefix,
    details_page_title: "Details " + prefix,
    create_page_title: "Create " + prefix,
    edit_page_title: "Edit " + prefix,
};

export default setup;
