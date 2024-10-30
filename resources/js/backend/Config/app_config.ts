type app_config_type = {
    api_host: string;
    api_version: string;
    image_host: string;
}

let app_config : app_config_type = {
    api_host: location.origin,
    // api_host: "http://127.0.0.1:8000",
    image_host: "",
    api_version: 'api/v1'
}

export default app_config
