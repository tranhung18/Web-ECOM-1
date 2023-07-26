// form sign-in sign-up
$(document).ready(function (){
    $(".navbar_signUp").click(function (){
        $(".form__sign-in").hide(),
        $(".form__sign-up").show(),
        $(".form__user").css({
            'display':'flex',
        });
    });
});
$(document).ready(function (){
    $(".navbar_signIn").click(function (){
        $(".form__sign-in").show(),
        $(".form__sign-up").hide(),
        $(".form__user").css({
            'display':'flex',
        });
    });
});
$(document).ready(function (){
    $("#click_sign-up").click(function (){
        $(".form__sign-in").hide();
        $(".form__sign-up").show();
    });
});
$(document).ready(function (){
    $("#click_sign-in").click(function (){
        $(".form__sign-up").hide();
        $(".form__sign-in").show();
    });
});
$(document).ready(function (){
    $(".fa-times").click(function (){
        $(".form__user").hide();
        $(".form__sign-in").show();
        $(".form__sign-up").show();
    });
});
