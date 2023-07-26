document.addEventListener("DOMContentLoaded",function(){
    function checkPass(password){
        var count = 0;
        if(password.length > 6 ){
            count +=20;
        }
        if (password.match(/[a-z]+/)) {
            count +=20;
        }
        if (password.match(/[A-Z]+/)) {
            count +=20;
        }
        if (password.match(/[0-9]+/)) {
            count +=20;
        }
        if (password.match(/[$@%*#&!]+/)) {
            count +=20;
        }
        return count;
    }
    function checkChangePass(){
        document.querySelector('.btn_changePass').disabled = true;
        var meter_pass = document.querySelector('.meter');
        const inputPassOld = document.querySelector('.input-pass-old');
        const inputPassNew = document.querySelector('.input-pass-news');
        const inputRePassNews = document.querySelector('.input-repass-news');
        const notifyPassOld = document.querySelector('.span-check-pass');
        const notifyPassNews = document.querySelector('.span-pass-news');
        const notifyRePassNews = document.querySelector('.span-repass-news');
        
        function check_rePass(){
            if(inputRePassNews.value != inputPassNew.value){
                notifyRePassNews.innerHTML = 'Mật khẩu nhập vào không khớp';
            }else{
                notifyRePassNews.innerHTML = '';
            }
        }
        inputPassOld.onchange= function(){
            if(inputPassOld.value !=  passUser){
                notifyPassOld.innerHTML = "Mật khẩu nhập vào không đúng";
            }
            else{
                notifyPassOld.innerHTML = "";
            }
        }
        inputPassNew.onchange = function(){
            var meter = checkPass(inputPassNew.value);
            meter_pass.value = meter;
            if(meter != 100){
                notifyPassNews.innerHTML = 'Mật khẩu phải lớn hơn 6 kí tự, bao gồm chữ cái in hoa, in thường, số và kí tự đặc biệt';
            }
            else{
                check_rePass();
                notifyPassNews.innerHTML = '';
            }
        }
        inputRePassNews.onchange = check_rePass;
        if(meter_pass.value == 100 && inputPassOld.value ==  passUser && inputRePassNews.value == inputPassNew.value){
            document.querySelector('.btn_changePass').removeAttribute('disabled');
        }
    }
    document.querySelector('.form_changePass').onkeyup = checkChangePass;
});
