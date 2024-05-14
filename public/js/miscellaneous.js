function getAuthToken() {
    console.log(Cookies.get('auth_cookie'))
    return Cookies.get('auth_cookie');
}

function setAuthToken(token) {
    Cookies.set('auth_cookie', token, {expires: 1});
}

function attachAuthToken(request) {
    if (!request.url.includes('tiny.cloud') && !request.url.includes('pubhtml5')) {
        const token = getAuthToken();
        if (token) {
            request.headers.set('Authorization', `Bearer ${token}`);
        }
    }
    return request;
}

function deleteCookie(){
    Cookies.remove('auth_cookie')
}

const originalFetch = window.fetch;
window.fetch = async (...args) => {
    const request = attachAuthToken(new Request(...args));
    return originalFetch(request);
};
