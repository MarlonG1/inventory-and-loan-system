import {getConfigValue} from "./APIConfig.js";

const baseURL = getConfigValue('baseURL')

function buildRoute(endpointName, id = null, filters = '') {
    let route = `${baseURL + endpointName}`
    if (id !== null) {
        route += `/${id}`;
    }
    if (filters.trim() !== '') {
        route += `?${filters}`
    }
    console.log(route)
    return route.trim();
}

export {buildRoute};
