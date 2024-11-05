function close() {
    let dialog = document.querySelector(".dialog");
    dialog.classList.add("dialog_close");
}
let dialog_btn = document.querySelector(".dialog_btn");
dialog_btn.addEventListener("click", close);