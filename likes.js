$('.likecont button').click(function(){
    let query=$(this).attr('id'),id=$('#likediv').attr('data-id');
    let dis=$(this);
    $.ajax('rating.php',{
        method:"POST",
        data:{'query':query,'id':id},
        success:function(result){
            let rtrn=result.slice(0,result.indexOf(';'));
            let i=result.slice(result.indexOf(';')+1,result.length);
            $('#likediv').text(i);
            if (rtrn=='on'){
                $(dis).addClass('btn-primary');
                $(dis).removeClass('btn-outline-primary');
            }
            if (rtrn=='off'){
                $(dis).addClass('btn-outline-primary');
                $(dis).removeClass('btn-primary');
            }
        }
    })
});




/*$.ajax("login.php",{
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
})*/