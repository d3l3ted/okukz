$('#summernote1').summernote({
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['misc',['codeview']]
    ],
    minHeight:460,
    placeholder:'Введите текст'
  });
$('#summernote1').summernote('lineHeight', 1);
$('#summernote2').summernote({
    minHeight:460,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['misc',['codeview']]
    ],
    placeholder:'Введите текст'
});
let isChanged=true;
$('#summernote2').summernote('lineHeight', 1);
$('#changebutton').click(function(){
    if(isChanged){
        $('#summernote-div-1').fadeOut(400);
        setTimeout(`$('#summernote-div-1').addClass('d-none');
        $('#summernote-div-2').removeClass('d-none').fadeIn(400);`,400);
        $('#summernote1').summernote('disabled');
        $('#summernote2').summernote('enabled');
        isChanged=false;
        $('#changebutton').text('Перейти на русский язык <<');
    }
    else{
        $('#summernote-div-2').fadeOut(400);
        setTimeout(`$('#summernote-div-2').addClass('d-none');
        $('#summernote-div-1').removeClass('d-none').fadeIn(400);`,400);
        $('#summernote2').summernote('disabled');
        $('#summernote1').summernote('enabled');
        isChanged=true;
        $('#changebutton').text('Перейти на казахский язык >>');
    }
});
$('#write-article').mousedown(function(){
    if ($('#summernote2').summernote('isEmpty')){
    $('input[name=iskz]').val('off');}
    else{$('input[name=iskz]').val('on')}
});