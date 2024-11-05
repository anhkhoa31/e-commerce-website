let img = document.querySelector("#profile_img");

let label = document.querySelector("#select_img_label");

label.style = "visibility: hidden";

img.addEventListener("mouseover", () => {
    label.style = "visibility: visible";
})

img.addEventListener("mouseout", () => {
    label.style = "visibility: hidden";
})