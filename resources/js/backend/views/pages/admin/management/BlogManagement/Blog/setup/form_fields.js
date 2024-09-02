export default [
    {
        name: "title",
        label: "Enter your title",
        type: "text",
        colum: "col-md-6",
        value: "",
    },

    {
        name: "blog_type",
        label: "Select blog type",
        type: "select",
        colum: "col-md-6",
        value: "",
        multiple: false,
        data_list: [
            {
                label: "Youtube link",
                value: "Youtube_link",
            },
            {
                label: "M3u8 link",
                value: "m3u8_link",
            },
        ],
    },
    {
        name: "url",
        label: "Enter your url",
        type: "text",
        colum: "col-md-6",
        value: "",
    },
    {
        name: "tags",
        label: "Enter your  tag",
        type: "text",
        colum: "col-md-6",
        value: "",
    },
    {
        name: "publish_date",
        label: "Enter your publish date",
        type: "date",
        colum: "col-md-6",
        value: "",
    },
    {
        name: "writer",
        label: "Enter writer name",
        type: "text",
        colum: "col-md-6",
        value: "",
    },
    {
        name: "meta_title",
        label: "Enter your meta title",
        type: "text",
        colum: "col-md-6",
        value: "",
    },
    {
        name: "meta_description",
        label: "Enter your meta description",
        type: "text",
        colum: "col-md-6",
        value: "",
    },
    {
        name: "meta_keywords",
        label: "Enter your meta keywords",
        type: "text",
        colum: "col-md-6",
        value: "",
    },

    {
        name: "thumbnail_image",
        label: "Upload thumbnail image",
        type: "file",
        colum: "col-md-6",
        value: "",
        multiple: false,
    },
    {
        name: "images",
        label: "Upload multiple images",
        type: "file",
        colum: "col-md-6",
        images_list: [],
        multiple: true,
    },
    {
        name: "privecy_status",
        label: "Privecy status",
        type: "select",
        value: "public",
        colum: "col-md-6",
        multiple: false,
        data_list: [
            {
                label: "Private",
                value: "private",
            },
            {
                label: "Public",
                value: "public",
            },
        ],
    },
    {
        name: "description",
        label: "Enter your description",
        type: "textarea",
        value: "",
        colum: "col-md-12",
    },
];
