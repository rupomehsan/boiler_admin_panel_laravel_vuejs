import axios from "axios";
import setup from "../../setup";
import { mapWritableState } from "pinia";
import { store } from "..";

async function execute(id){
    let state = mapWritableState(store, [
        'item',
    ]);

    let url = `${setup.api_host}/${setup.api_version}/${setup.api_end_point}/${id}`;
    try {
        let response = await axios.get(url);
        state.item.set(response.data.data);
    } catch (error) {
        (window as any).s_alert('something is wrong.','error');
        return error.response;
    }
}

export default execute;
