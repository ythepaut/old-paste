function auto_grow(element) {

    element.style.height = (window.innerHeight - 45)+"px";

    if (element.style.height > window.innerHeight) {
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }
}

function copyStringToClipboard(str) {
    var el = document.createElement('textarea');
    el.value = str;
    el.setAttribute('readonly', '');
    el.style = {position: 'absolute', left: '-9999px'};
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
 }