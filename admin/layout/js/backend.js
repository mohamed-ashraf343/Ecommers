/// convert password field on hover
// var passfield = $('.password');
// $('.show-pass').hover(function (){

//     passfield.attr('type','text');

// }, function(){
//     passfield.attr('type','password');

// });

$('.show-pass').click(function(){
    if($('.password').attr("type") === "password"){
        $('.password').attr("type","text");
    }else{
        $('.password').attr("type","password");
    }

})






///  delete configration 

$('.confirm').click(function(){

    return confirm('Are You Sure?');
});



