$(document).ready(function() {
$("#submit").attr('disabled', 'disabled');
$("input[name='addit']").focus();

$("form").keyup(function() {
// To Disable Submit Button
//$("#submit").attr('disabled', 'disabled');
// Validating Fields

if ($(".mainformtcpk").val().length > 0) {
// To Enable Submit Button
$("#submit").removeAttr('disabled');
$("#submit").addClass('buttonready');

} 
if ($(".mainformtcpk").val().length < 1) {
	$("#submit").attr('disabled', 'disabled');
	$("#submit").removeClass('buttonready');
	}

});

$("formmmmmmmmmmmmmm").submit(function(){
$(".enter p").text('Please wait.');
$(".tcpkre").addClass("opac");
$("span.erronocodect").addClass("opac");
    });

// On Click Of Submit Button
$("#submittttttttt").click(function() {
$("#submit").css({"cursor": "default", "box-shadow": "none" });
$(".mainformtcpk").addClass( "buttonclicksubmit" );
$("#submit").addClass("buttonclicksubmit");
$(".enter p").text('Please wait.');
$(".tcpkre").addClass("opac");
$("span.erronocodect").addClass("opac");
});


//$(".tcpkre").submit(function () {

$("#submit").click(function () {
//alert("yea");
$(".enter p").text('Please wait.');
$("span.erronocodect").addClass("opac");
$(".tcpkre").addClass("opac");
$(".tcpkre").hide();
});


 $("#submittt").hover(
				
               function () {
                  $(this).fadeTo(1, 0.6);
               }, 
				
               function () {
                  $(this).fadeTo(1, 1);
               }
            );





});


