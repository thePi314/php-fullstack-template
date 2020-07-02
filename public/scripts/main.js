const HOST = 'http://' + window.location.host;

function jsonToQueryString(json) {
    return '?' + 
        Object.keys(json).map(function(key) {
            return encodeURIComponent(key) + '=' +
                encodeURIComponent(json[key]);
        }).join('&');
}

let preload_execution = [];
let afterload_execution = [];


window.onload = () => {
    afterload_execution.forEach(funct => funct());
}