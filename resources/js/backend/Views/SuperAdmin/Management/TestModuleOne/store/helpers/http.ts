import axios from 'axios';
import { anyObject } from '../../../../../../../../common_types/object';

interface EndpointInfo {
    href: string;
    status: number;
    duration: number;
    message?: string;
}

function storeLatestEndpoints(endpointInfo: EndpointInfo) {
    let latestEndpoints: EndpointInfo[] = JSON.parse(
        localStorage.getItem('latestEndpoints') || '[]',
    );
    latestEndpoints.push(endpointInfo);
    if (latestEndpoints.length > 10) {
        latestEndpoints = latestEndpoints.slice(-10);
    }
    localStorage.setItem('latestEndpoints', JSON.stringify(latestEndpoints));
}

async function fetch_and_save_to_cache(url, cache, startTime) {
    try {
        const response = await axios.get(url);
        await cache.put(url, new Response(JSON.stringify(response.data)));

        let endTime = performance.now();
        let duration = endTime - startTime;
        storeLatestEndpoints({
            href: url,
            duration,
            status: response.status,
        });

        return response;
    } catch (error) {
        console.error(error.response.data);

        let endTime = performance.now();
        let duration = endTime - startTime;
        storeLatestEndpoints({
            href: url,
            duration,
            status: error.response.status,
            message: error.response.data.message,
        });

        throw new Error(error.response.statusText);
    }
}

// function bytesToMB(bytes) {
//     return bytes / (1024 * 1024);
// }

function bytesToKB(bytes) {
    return bytes / 1024;
}

async function fetchDataAndUpdateCache(url, fetch_only_latest) {
    let responseData: anyObject = {
        data: {},
        status: 200,
    };
    let endTime: number = 0;
    let duration: number = 0;
    let usage: number = 0;

    try {
        const startTime = performance.now();
        const cacheName = new URL(url).pathname;
        const cache = await caches.open(cacheName);
        const cacheKeys = await cache.keys();

        const cacheSize = cacheKeys.length;
        if (cacheSize > 15) {
            for (let i = 0; i < cacheSize - 15; i++) {
                await cache.delete(cacheKeys[i]);
            }
        }

        const cacheData = await cache.match(url);
        if (cacheData && fetch_only_latest === false) {
            responseData.data = await cacheData.json();
            fetch_and_save_to_cache(url, cache, startTime);
        } else {
            responseData = await fetch_and_save_to_cache(url, cache, startTime);
        }

        endTime = performance.now();
        duration = endTime - startTime;
        const estimate = await navigator.storage.estimate();
        usage = estimate.usage as number;

        return {
            duration,
            data: responseData.data.data,
            totalStorage: bytesToKB(usage),
        };
    } catch (error) {
        console.error('error #%s', error);
        return {
            duration,
            data: responseData.data.data,
            totalStorage: 0,
        };
    }
}

export default fetchDataAndUpdateCache;
