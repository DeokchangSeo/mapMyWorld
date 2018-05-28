/**
 * Created by Jane on 2017/3/19.
 */

function getCookie(cookieName) {
    var cookieString = document.cookie;
    var start = cookieString.indexOf(cookieName + '=');
    if (start == -1)
        return null;
    start += cookieName.length + 1;
    var end = cookieString.indexOf(';', start);
    if (end == -1) return cookieString.substring(start);
    return cookieString.substring(start, end);
}

function checkcookie() {
    var username=getCookie("username");
    console.log(email);
    if(username!=null) {
        document.getElementById("cookie-panel").innerHTML = "NAME: " + username;
    }
else {
        console.log("no cookie.")
    }
}
