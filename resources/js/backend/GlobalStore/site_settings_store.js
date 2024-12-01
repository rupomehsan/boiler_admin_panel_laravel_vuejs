import axios from "axios";
import { defineStore } from "pinia";
export const site_settings_store = defineStore("site_settings_store", {
    state: () => ({
        website_settings_data: [],
    }),

    actions: {
        async get_all_website_settings() {
            try {
                const response = await axios.get(
                    "/website-settings?get_all=1&limit=100"
                );
                this.website_settings_data = Array.isArray(response.data?.data)
                    ? response.data.data
                    : Object.values(response.data.data); // Ensure it's an array
            } catch (error) {
                console.error("Error fetching website settings:", error);
                this.website_settings_data = [];
            }
        },

        /**
         * Get a setting value by key from website_settings_data.
         * @param {string} key - The key to search for in the settings.
         * @param {boolean} multiple - Whether to return multiple values or a single value.
         * @returns {Array|string} - Returns an array of values if `multiple` is true; otherwise, returns a single value or an empty string.
         */
        get_setting_value(key, multiple = false) {
            if (!Array.isArray(this.website_settings_data)) {
                console.warn("Website settings data is not an array.");
                return multiple ? [] : "";
            }

            try {
                if (multiple) {
                    const values = this.website_settings_data.filter(
                        (item) => item.title === key
                    );
                    return values.length > 0 ? values[0].setting_values : [];
                } else {
                    const value = this.website_settings_data.find(
                        (item) => item.title === key
                    );
                    return value?.setting_values?.[0]?.value || "";
                }
            } catch (error) {
                console.error("Error fetching setting value:", error);
                return multiple ? [] : "";
            }
        },
    },
});
