let menu = document.querySelector('#slide_bar');
let navbar = document.querySelector('.navigation1');
let head = document.querySelector('.head-2');

menu.addEventListener('click',() =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
});

window.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
    if(window.scrollY > 150){
        Headers.classList.add('active');
    }else{
        head.classList.remove('active');    
    }
}