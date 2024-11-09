import app_config from "../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "TestModuleOne";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "test-module-ones",

    module_name: "test-module-one",
    store_prefix: "test_module_one",
    route_prefix: "TestModuleOne",
    route_path: "test-module-one",

    select_fields: [
        "id",
        "title",
        "description",
        "phone",
        "gender",
        "tags",
        "price",
        "is_show",
        "content",
        "slug",
        "created_at",
    ],

    sort_by_cols: [
        "id",
        "title",
        "description",
        "phone",
        "gender",
        "tags",
        "price",
        "is_show",
        "content",
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
