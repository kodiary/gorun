$(function(){
$('.fil').click(function(){
    //alert('test');
    
   $(this).parent().find('.option').toggle('slow'); 
});
$('.option a').click(function(){
   $(this).closest('.fil-group').find('.fil').text($(this).text()); 
   $('.option').hide('slow');
   
});
})