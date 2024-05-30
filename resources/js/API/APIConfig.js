const APIConfig = {
    baseURL: 'https://prestamos.com/api/v1/',
    defaultHeaders: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    requestOptions : {
        Credentials : 'include'
    }
}
function getConfig(){
    return APIConfig;
}
function getConfigValue(key){
    return APIConfig[key];
}
export { getConfig, getConfigValue };
