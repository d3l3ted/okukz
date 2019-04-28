$("#logregbtn").on("click",function(){
    $("body").append(
        "<div class='modal-window' id=\"regmodal\">\n" +
        "    <div id='regmodal_inside' class='bg-light m-auto w-auto h-auto rounded'>\n" +
        "        <div class=\"row\">\n" +
        "            <div class=\"col-lg-6\">\n" +
        "                <p class=\"text-center mt-3 mb-n3\">Вход:</p>\n" +
        "                <div id='modal-left' class='p-5'>\n" +
        "                    <div class=''><label for='login-input'>Логин:</label>\n" +
        "                        <input id='login-input-log' type='email' placeholder='Введите логин' class='form-control my-2'></div>\n" +
        "                    <div><label for='password-input'>Пароль:</label>\n" +
        "                        <input id='password-input-log' type='password' placeholder='Введите пароль' class='form-control my-2'></div>\n" +
        "                    <button id='logbtn' class='btn btn-outline-primary mt-2'>Вход</button>\n" +
        "                </div>\n" +
        "            </div>\n" +
        "            <div class=\"col-lg-6\">\n" +
        "                <p class=\"text-center mt-3 mb-n3\">Регистрация:</p>\n" +
        "                <div id='modal-right' class='p-5'>\n" +
        "                    <div class=''><label for='name-input'>Имя:</label>\n" +
        "                        <input id='name-input' type='text' placeholder='Введите логин' class='form-control my-2'></div>\n" +
        "                    <div class=''><label for='mail-input'>E-Mail:</label>\n" +
        "                        <input id='mail-input' type='email' placeholder='Введите логин' class='form-control my-2'></div>\n" +
        "                    <div class=''><label for='login-input'>Логин:</label>\n" +
        "                        <input id='login-input-reg' type='text' placeholder='Введите логин' class='form-control my-2'></div>\n" +
        "                    <div><label for='password-input'>Пароль:</label>\n" +
        "                        <input max=20 id='password-input1' type='password' placeholder='Введите пароль' class='form-control my-2'></div>\n" +
        "                    <div><label for='password-input'>Повторите пароль:</label>\n" +
        "                        <input max=20 id='password-input2' type='password' placeholder='Введите пароль' class='form-control my-2'></div>\n" +
        "                    <button id='regbtn' class='btn btn-outline-success mt-2 mx-auto'>Зарегистрироваться</button>\n" +
        "                </div>\n" +
        "            </div>\n" +
        "        </div>\n" +
        "    </div>\n" +
        "</div>"
    );
let regmod=$("#regmodal");
    $(regmod).fadeIn(200);
$(regmod).click(function(){
    $(regmod).fadeOut(200);
});
$("#regmodal_inside").on("click",function (e) {
    e.stopPropagation();
});

$('#regbtn').click(function () {
    let pas1=$("#password-input1").val(), pas2=$("#password-input2").val(),permission=1;
    let name=$("#name-input").val(),email=$("#mail-input").val(),login=$("#login-input-reg").val();
    if (pas1.length<6 || pas1.length>24){
        $('#alert-log1').remove();
        $("#modal-right").append(`<div role="alert" id="alert-log1" class="alert alert-danger my-3">Пароль должен содержать от 6 до 24 символов</div>`);
        permission=0;
    }
        else{$('#alert-log1').remove()}
    if (pas1!==pas2){
        $('#alert-log2').remove();
        $("#modal-right").append(`<div role="alert" id="alert-log2" class="alert alert-danger my-3">Пароли не одинаковы</div>`);
        permission=0;
    }
        else{$('#alert-log2').remove()}
    if((pas1!== '') && (pas1===pas2) && (name !== '') && (login !== '') && (email !== '') && permission===1){
   $.ajax("regist.php",{
       method:"POST",
       data:{'name':name,'mail':email,'login':login,'parol':pas1},
       success:function (result) {
           $("#modal-right").append(` <div role="alert" id="alert-reg" class="alert alert-success my-3">${result}</div>`);
           setTimeout(function (){window.location.href='index.php';},1200);
       }
   })
    }
});
$('#logbtn').click(function(){
    let log=$("#login-input-log").val(),pas=$("#password-input-log").val();
    if ((log!=='') && (pas!=='')){
        $.ajax("login.php",{
            method:"POST",
            data:{'login':log,'passw':pas},
            success:function(result){
                if(result=='success'){
                    window.location.href='index.php';
                }
                else{
                    if($('#alert-reg')) $('#alert-reg').remove();
                    $("#modal-left").append(`<div role="alert" id="alert-reg" class="alert alert-danger my-3">${result}</div>`);
                }
            }
        })
    }
})

});
$(".slb").click(function(){
    let id= $(this).attr('id');
    if (id=='KZ'){
        $('#text1').addClass('d-none');
        $('#text2').removeClass('d-none');
        $('#ruz').addClass('d-none');
        $('#kzz').removeClass('d-none');
        $(this).removeClass('btn-outline-primary');
        $(this).addClass('btn-primary');
        $('#RU').addClass('btn-outline-primary');
        $('#RU').removeClass('btn-primary');
    }
    if(id=='RU'){
        $('#text2').addClass('d-none');
        $('#text1').removeClass('d-none');
        $('#kzz').addClass('d-none');
        $('#ruz').removeClass('d-none');
        $(this).removeClass('btn-outline-primary');
        $(this).addClass('btn-primary');
        $('#KZ').addClass('btn-outline-primary');
        $('#KZ').removeClass('btn-primary');
    }
});
let lastid=$('.bg-primary');
let i=2;
let stimer=null;
$('.s-show-thumbs').click(function () {
    let id=$(this).attr('data-id'),jpg=$(this).find('img').attr('src'),zag=$(this).attr('data-zag');
        $('.s-show-img-main').attr('src',jpg);
        $('.s-show a').attr('href',`article_blank.php?id=${id}`).text(zag);;
    $('.s-show .bg-primary').removeClass('bg-primary');
    $(this).removeClass('s-show-thumbs');
    $(this).addClass('bg-primary');
    lastid.addClass('s-show-thumbs');
    lastid=$(this);
    i=$(this).attr('id');
    i++;
    intervalManager(false);
    clearTimeout(stimer);
    stimer = setTimeout("intervalManager(true);",2000);
});
let s_timer = null;
function intervalManager(flag)
{
    if (flag){
        si=true;
        s_timer = setInterval(function (){
            let this_thumbs=$(`.s-show-thumbs:nth-of-type(${i})`);
            let id=this_thumbs.attr('data-id'),jpg=this_thumbs.find('img').attr('src'),zag=this_thumbs.attr('data-zag');
                $('.s-show-img-main').attr('src',jpg);
                $('.s-show a').attr('href',`article_blank.php?id=${id}`).text(zag);;
            $('.s-show .bg-primary').removeClass('bg-primary');
            this_thumbs.removeClass('s-show-thumbs');
            this_thumbs.addClass('bg-primary');
            lastid.addClass('s-show-thumbs');
            lastid=this_thumbs;
            if (i===6){i=1}else{i++;}
        },4800);
    }
    else{
        clearInterval(s_timer);
    }
}
intervalManager(true);

$('#srch-input').keyup(function(event){
    if (event.keyCode===13){
        $('#srch-button').click();
    }
});