function superIf(obj, str){
    if(obj.classList.contains(str)){
        obj.classList.remove(str);
    }
}

function fadeInRegFrom(){
    let register_form = document.getElementById('register-form-wrapper');
    register_form.classList.toggle('hidden');
    register_form.classList.toggle('fadeIn');
    superIf(register_form, 'fadeOut');
}

function fadeInLogForm(){
    let login_form = document.getElementById('login-form-wrapper');
    login_form.classList.toggle('hidden');
    login_form.classList.toggle('fadeIn');
    superIf(login_form, 'fadeOut');
}

function fadeOutRegForm(){
    let register_form = document.getElementById('register-form-wrapper');
    register_form.classList.toggle('hidden');
    register_form.classList.toggle('fadeOut');
    superIf(register_form, 'fadeIn');
}

function fadeOutLogForm(){
    let login_form = document.getElementById('login-form-wrapper');
    login_form.classList.toggle('hidden');
    login_form.classList.toggle('fadeOut');
    superIf(login_form, 'fadeIn');
}

function loginAnimation() {
    let logbox = document.getElementById('login-box');
    if(window.innerWidth > 767){
        logbox.style.transform = "translateX(-116.5%)";
    }
    initAnimation(logbox);
    
    fadeInLogForm();
}

function signUpAnimation() {
    let logbox = document.getElementById('login-box');
    if(window.innerWidth > 861){
        logbox.style.transform = "translateX(116.5%)";
    }
    initAnimation(logbox);

    fadeInRegFrom();
}

function triggerRight(){
    let logbox = document.getElementById('login-box');
    if(window.innerWidth > 767){
        logbox.style.transform = "translateX(116.5%)";
    }

    fadeOutLogForm();
    fadeInRegFrom();
}

function triggerLeft(){
    let logbox = document.getElementById('login-box');
    if(window.innerWidth > 767){
        logbox.style.transform = "translateX(-116.5%)";
    }

    fadeOutRegForm();
    fadeInLogForm();
}

function initAnimation(logbox){
    //title
    let title = document.getElementById('title');
    title.classList.toggle('title-slideUp');

    //login-box
    // let logbox = document.getElementById('login-box');
    logbox.classList.toggle('login-box-expand');

    //buttons
    let login = document.getElementById('login-start-btn');
    let sign = document.getElementById('signup-start-btn');

    login.classList.toggle('fadeOut');
    sign.classList.toggle('fadeOut');
}