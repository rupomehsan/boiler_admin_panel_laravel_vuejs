import axios from "axios";
import setup from "../../setup";
import { mapState } from "pinia";
import { store } from "..";

async function execute(action, ids) {



    let url = `${setup.api_host}/${setup.api_version}/${setup.api_end_point}/bulk-action`;

    try {
        let response = await axios.post(url, { action, ids });
        return response;
    } catch (error) {
        if (error.response.status == 422) {
            (window as any).s_alert('Fill the required input fields.', 'error');
        }
        return error.response;
    }
}

export default execute;
