let close_btn = document.querySelector("#close");
let open_btn = document.querySelector(".menu_btn");
let nav_header = document.querySelector("#nav_header.mobile");
let nav_footer = document.querySelector("#nav_footer");
let main_content = document.querySelector(".main_content");

close_btn.addEventListener("click", function () {
    nav_header.style.marginLeft = "-100vw";
    nav_footer.style.display = "flex";
    open_btn.style.marginTop = "0%";
    main_content.style.minHeight = "80vh";

    nav_header.style.transition = "0.5s";
    nav_footer.style.transition = "0.5s";
    open_btn.style.transition = "0.5s";
});

open_btn.addEventListener("click", function () {
    open_btn.style.marginTop = "-10vh";
    nav_header.style.marginLeft = "0vw";
    nav_footer.style.display = "none";
    main_content.style.minHeight = "120vh";
    
    nav_header.style.transition = "0.5s";
    nav_footer.style.transition = "0.5s";
    open_btn.style.transition = "0.5s";
});