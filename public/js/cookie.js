function setCookie(cookieName, cookieValue, expirationYears) {
    const expirationDate = new Date();
    expirationDate.setFullYear(expirationDate.getFullYear() + expirationYears);

    const cookieString =
        cookieName + '=' + encodeURIComponent(cookieValue) +
        '; expires=' + expirationDate.toUTCString() +
        '; path=/';

    document.cookie = cookieString;
}

function getCookie(cookieName) {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if (cookie.startsWith(cookieName + '=')) {
            const cookieValue = decodeURIComponent(cookie.substring(cookieName.length + 1));
            return cookieValue;
        }
    }
    return null;
}
