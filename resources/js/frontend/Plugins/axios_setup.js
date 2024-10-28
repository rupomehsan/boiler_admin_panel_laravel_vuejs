import moment from "moment";
import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common["X-CSRF-TOKEN"] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
axios.defaults.baseURL = location.origin + "/api/v1/";

window.publicAxios = async function (apiEndPoint = null, type = 'get', payload = {}) {
    delete window.axios.defaults.headers.common["Authorization"];
    try {
        let response;
        if (type == 'get') {
            response = await window.axios.get(apiEndPoint);
        } else if (type == 'post') {
            response = await window.axios.post(apiEndPoint, payload);
        }
        return response.data;
    } catch (error) {
        return error.response;
    }
}

export const privateAxios = async function (apiEndPoint = null, type = 'get', payload = {}) {
    window.axios.defaults.headers.common["Authorization"] = `Bearer ${localStorage.getItem('token')}`;
    // try {
    //     await axios.get("/auth-check");

    // } catch (error) {
    //     localStorage.removeItem("token");
    //     let myaccount = document.getElementById("myAccount");
    //     if (myaccount) {
    //         // myaccount.classList.add('open-side');
    //     }
    //     return false;
    // }

    try {
        let response;
        if (type == 'get') {
            response = await window.axios.get(apiEndPoint);
        } else if (type == 'post') {
            response = await window.axios.post(apiEndPoint, payload);
        } else if (type == 'delete') {
            response = await window.axios.delete(apiEndPoint, payload);
        }
        return response.data;
    } catch (error) {
        return error.response;
    }

}

window.privateAxios = privateAxios;

axios.interceptors.request.use(
    async function (config) {
        $(".loader_body").addClass("active");
        $(".loader_body").css({ top: $(".main_content").scrollTop() });
        $("#backend_body .main_content").css({ overflowY: "hidden !mportant" });
        $("form button").prop("disabled", true);
        // Pace?.restart();
        window.count_left_time_sec = 1;
        sessionStorage.setItem(
            "last_time",
            moment().format("DD/MM/YYYY HH:mm:ss")
        );
        localStorage.setItem("last_time", new moment());
        return {
            ...config,
            // onUploadProgress,
            // onDownloadProgress,
        };
    },
    function (error) {
        // Do something with request error
        console.log("request error");
        return Promise.reject(error);
    }
);

window.remove_form_action_classes = function () {
    $(".loader_body").removeClass("active");
    $("input,select,textarea").removeClass("border-danger");
    $("form button").prop("disabled", false);
    $(`.error.text-danger`).remove();
};


window.render_form_errors = function (object, selector = "name") {
    for (const key in object) {
        if (Object.hasOwnProperty.call(object, key)) {
            const element = object[key];
            let el = document.querySelector(`input[${selector}="${key}`);
            if (!el) {
                el = document.getElementById(`${key}`);
            }
            /**
             *  if html element found then take action
             */
            if (el) {
                $(`<div class="error text-danger py-1">${element[0]}</div>`).insertAfter(el);
                el.classList.add("border-danger");
            }
        }
    }
};

window.axios.interceptors.response.use(
    (response) => {
        remove_form_action_classes();
        return response;
    },
    (error) => {
        remove_form_action_classes();
        let object = error.response?.data?.errors;
        render_form_errors(object);

        if (typeof error?.response?.data === "string") {
            console.log(
                "error",
                error?.response?.data ? error?.response?.data : error.response
            );
        } else {
            // console.log(error.response || error);
            if (error.response?.data?.status == "server_error") {
                window.s_warning(error.response?.data?.message);
            }
            if (error.response?.data?.status == "error") {
                window.s_error(error.response?.data?.message);
            }
        }
        // console.log(error);
        // if(error.response.status == 401){
        //     window.clear_session();
        // }
        // let status = error.response.status;
        // window.s_alert('error '+status+': '+error.response?.statusText,'error')
        throw error;
    }
);

// axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('[name="csrf-token"]').content;
