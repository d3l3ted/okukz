$('.show_popup').click(function() {
        var popup_id = $('#' + $(this).attr("rel"));
        $(popup_id).show();
        var overlay_id =$('.'+$(this).attr("href"));
        $(overlay_id).show();
    });
    $('.overlay_popup1').click(function() {
        $('.overlay_popup1, .popup').hide();
    })
	
var check = function() {
  if (document.getElementById('parol').value ==
    document.getElementById('parol1').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Пароль совпадает';
	document.getElementById('submit1').disabled = false;
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Пароль не совпадает';
	document.getElementById('submit1').disabled = true;
  }
}

$(document).ready(function() {
$('#summernote').summernote({
        height:300
    });
    $('#summernote').summernote('code','<h1> Введите текст </h1>');
    $('.note-statusbar').css("display","none");
    $('.note-editor,.note-frame,.panel,.panel-default').css({
        'border':'none',
        'width':'90%',
        'height':'400px',
        'margin':'0 5%'
    });
});
$('.checkkz').on("click",function () {
if ($('.checkkz').is(":checked")) {
$('#summernote1').summernote({
        height:300
    });
    if(($('#summernote1').summernote('code') == '<h1>Введите текст</h1>') || ($('#summernote1').summernote('code') == "") || ($('#summernote1').summernote('code') == "<p><br></p>")){
    $('#summernote1').summernote('code', '<h1> Введите текст </h1>');
    }
    $('.note-statusbar').css("display","none");
    $('#zagKZ').css("display","inline-block");
    $('.note-editor,.note-frame,.panel,.panel-default').css({
        'border': 'none',
        'width': '90%',
        'height': '400px',
        'margin': '0 5%'
    });
}
else{
    $('#summernote1').summernote('destroy');
    $('#summernote1').attr("style",' ');
    $('#zagKZ').css("display",'none');
	
}
})
$('.artrad').on("click",function () {
    $('#artsubmit').attr('disabled',false).css('background-color','#fff800');
})


let prevScrollpos = window.pageYOffset;
$(window).on("scroll",function () {
    let currentScrollPos = window.pageYOffset;
    if(prevScrollpos < currentScrollPos){
        if(hdr!=1){
        $('header').addClass('toleft');}
    }
    else{
        $('header').removeClass('toleft');
    }
    prevScrollpos = currentScrollPos;
})
$('header').on({
    mouseenter: function () {
        $('header').removeClass('toleft');
        hdr=1;
    },
    mouseleave: function () {
        $('header').addClass('toleft');
        hdr=0;
    }
})

$(document).ready(function () { 
var body = $("body"); 
body.fadeIn(400); 
$(document).on("click", "a not([href^='#']):not([href^='tel']):not([href^='mailto'])", function (e) { 
e.preventDefault(); 
$("body").fadeOut(400); 
var self = this; 
setTimeout(function () { 
window.location.href = $(self).attr("href"); 
},400); 
}); 
}); 


        function Calendar3(id, year, month) {
            var Dlast = new Date(year,month+1,0).getDate(),
                D = new Date(year,month,Dlast),
                DNlast = D.getDay(),
                DNfirst = new Date(D.getFullYear(),D.getMonth(),1).getDay(),
                calendar = '<tr>',
                m = document.querySelector('#'+id+' option[value="' + D.getMonth() + '"]'),
                g = document.querySelector('#'+id+' input');
            if (DNfirst != 0) {
                for(var  i = 1; i < DNfirst; i++) calendar += '<td>';
            }else{
                for(var  i = 0; i < 6; i++) calendar += '<td>';
            }
            for(var  i = 1; i <= Dlast; i++) {
                if (i == new Date().getDate() && D.getFullYear() == new Date().getFullYear() && D.getMonth() == new Date().getMonth()) {
                    calendar += '<td class="today">' + i;
                }else{
                    if (  // список официальных праздников
                        (i == 1 && D.getMonth() == 0 && ((D.getFullYear() > 1897 && D.getFullYear() < 1930) || D.getFullYear() > 1947)) || // Новый год
                        (i == 2 && D.getMonth() == 0 && D.getFullYear() > 1992) || // Новый год
                        ((i == 3 || i == 4 || i == 5 || i == 6 || i == 8) && D.getMonth() == 0 && D.getFullYear() > 2004) || // Новый год
                        (i == 7 && D.getMonth() == 0 && D.getFullYear() > 1990) || // Рождество Христово
                        (i == 23 && D.getMonth() == 1 && D.getFullYear() > 2001) || // День защитника Отечества
                        (i == 8 && D.getMonth() == 2 && D.getFullYear() > 1965) || // Международный женский день
                        (i == 1 && D.getMonth() == 4 && D.getFullYear() > 1917) || // Праздник Весны и Труда
                        (i == 9 && D.getMonth() == 4 && D.getFullYear() > 1964) || // День Победы
                        (i == 12 && D.getMonth() == 5 && D.getFullYear() > 1990) || // День России (декларации о государственном суверенитете Российской Федерации ознаменовала окончательный Распад СССР)
                        (i == 7 && D.getMonth() == 10 && (D.getFullYear() > 1926 && D.getFullYear() < 2005)) || // Октябрьская революция 1917 года
                        (i == 8 && D.getMonth() == 10 && (D.getFullYear() > 1926 && D.getFullYear() < 1992)) || // Октябрьская революция 1917 года
                        (i == 4 && D.getMonth() == 10 && D.getFullYear() > 2004) // День народного единства, который заменил Октябрьскую революцию 1917 года
                    ) {
                        calendar += '<td class="holiday">' + i;
                    }else{
                        calendar += '<td>' + i;
                    }
                }
                if (new Date(D.getFullYear(),D.getMonth(),i).getDay() == 0) {
                    calendar += '<tr>';
                }
            }
            for(var  i = DNlast; i < 7; i++) calendar += '<td>&nbsp;';
            document.querySelector('#'+id+' tbody').innerHTML = calendar;
            g.value = D.getFullYear();
            m.selected = true;
            if (document.querySelectorAll('#'+id+' tbody tr').length < 6) {
                document.querySelector('#'+id+' tbody').innerHTML += '<tr><td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;';
            }
            document.querySelector('#'+id+' option[value="' + new Date().getMonth() + '"]').style.color = 'rgb(220, 0, 0)'; // в выпадающем списке выделен текущий месяц
        }
        Calendar3("calendar3",new Date().getFullYear(),new Date().getMonth());
        document.querySelector('#calendar3').onchange = function Kalendar3() {
            Calendar3("calendar3",document.querySelector('#calendar3 input').value,parseFloat(document.querySelector('#calendar3 select').options[document.querySelector('#calendar3 select').selectedIndex].value));
        }
		
		
		 $(document).ready(function() {
    $("#like").bind("click", function(event) {
      $.ajax({
        url: "DB/like.php",
        type: "POST",
        data: ("id=" + $("#like").attr("data-id")),
        dataType: "text",
        success: function(result) {
          if (result) {
            $("#like").text(Number($("#like").text()) + 1);
          }
          else alert("Error");
        }
      });
    });
  });
  
  
  $("#slideshow > div:gt(0)").hide(); 

setInterval(function() { 
$('#slideshow > div:first') 
.fadeOut(2000) 
.next() 
.fadeIn(2000) 
.end() 
.appendTo('#slideshow'); 
}, 4500);
