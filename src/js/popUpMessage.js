let message = document.getElementById('message')
function closeMessage() {
    message.style.display = "none";
}

if (message !== null) {
    setTimeout(closeMessage, 10000)
}