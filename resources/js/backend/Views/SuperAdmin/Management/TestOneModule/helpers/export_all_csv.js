import CsvBuilder from "./filify";
import setup from "../setup";
import axios from "axios";

let store_prefix = setup.store_prefix;

async function export_all_csv() {
    const confirmExport = await window.s_confirm("Export all");
    if (!confirmExport) return;

    window.start_loader();

    try {
        let last_page = 1;
        let url = new URL(`${setup.api_host}/${setup.api_version}/${setup.api_end_point}`);
        url.searchParams.set('paginate', 10);
        const excludedColumns = ['deleted_at', 'created_at', 'updated_at'];
        let export_csv;
        let allValues = []; // Array to accumulate data from all pages

        // Loop through all pages to gather data
        for (let page = 1; page <= last_page; page++) {
            url.searchParams.set('page', page); // Set the current page number

            console.log(`Fetching page ${page}`);  // Log current page number for debugging
            const response = await axios.get(url.href);

            if (page === 1) {
                // Only extract columns from the first page
                last_page = response.data.data.last_page; // Total number of pages from the API response
                const columns = extractColumns(response.data.data.data[0], excludedColumns);
                export_csv = new CsvBuilder(`${store_prefix}_list.csv`).setColumns(columns);
            }

            // Collect the data from the current page and add it to the allValues array
            const pageValues = response.data.data.data.map(item => filterData(item, excludedColumns));
            allValues = allValues.concat(pageValues); // Accumulate data from each page

            console.log(`Accumulated ${allValues.length} rows so far`);  // Log accumulated rows for debugging

            // Update the progress bar as pages are processed
            const progress = Math.round((100 * page) / last_page);
            window.update_loader(progress);
        }

        // Once all pages are processed, export all the accumulated data
        export_csv.addRows(allValues); // Add accumulated rows to the CSV
        await export_csv.exportFile(); // Export the full data to CSV

    } catch (error) {
        console.error("Error exporting CSV:", error);
        window.show_error("Failed to export data.");
    } finally {
        window.remove_loader();
    }
}

// Helper function to extract columns excluding unwanted keys
function extractColumns(dataObject, excludedKeys) {
    return dataObject
        ? Object.keys(dataObject).filter(key => !excludedKeys.includes(key))
        : [];
}

// Helper function to filter data and exclude unwanted keys
function filterData(dataObject, excludedKeys) {
    return Object.keys(dataObject)
        .filter(key => !excludedKeys.includes(key))
        .map(key => dataObject[key]);
}

// Loader functions to manage the progress UI
window.start_loader = function () {
    $('.loader').addClass('active');
    window.update_loader(5); // Set initial progress to 5%
};

window.update_loader = function (progress) {
    $('.load_amount h4').text(progress);
    $('.progress').css("width", progress + "%");
};

window.remove_loader = function () {
    $('.loader').removeClass('active');
    window.update_loader(5); // Reset progress to 5% when done
};

export default export_all_csv;
