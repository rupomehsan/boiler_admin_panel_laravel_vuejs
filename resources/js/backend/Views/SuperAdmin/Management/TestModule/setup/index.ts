
import app_config from "../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "TestModule";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "test-modules",

    module_name: "test-module",
    store_prefix: "test_module",
    route_prefix: "TestModule",
    route_path: "test-module",

    select_fields: [
        "id",
        "name",
            "email",
            "address",
        "status",
        "slug",
        "created_at",
    ],

    sort_by_cols: [
        "id",
        "name",
            "email",
            "address",
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
