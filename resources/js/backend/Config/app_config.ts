type app_config_type = {
    api_host: string;
    api_version: string;
    image_host: string;
};

let app_config: app_config_type = {
    api_host: location.origin,
    api_version: "api/v1",
    image_host: "",
};

export default app_config;
