/*<![CDATA[*/
$(document).ready(function() {
    $('#loading-more').click(function(){
        $('#loading-more').hide();
        var urlLocation = $('.urlLocation').attr('id');
        $("#timelineblock").append( "<p id='last'></p>" );
         
        $('div.loadMorePosts').show();
        var temp = $(".timeline-list:last").attr('id').split('-');
        var offSet = temp[1]; 
        $.ajax({
            type: 'get',
            dataType : "html",
            url: urlLocation+"/listRemaining?offset="+offSet,	
            success: function(data) {
                if(data){
                    $("#timelineblock").append(data);
                    $("#last").remove();
                    $("#timelineblock").append( "<p id='last'></p>" );
                    $('div.loadMorePosts').hide();
                    $('#loading-more').show();
                }else{		
                    $('div.loadMorePosts').html("No more post to list.");
                    $('#loading-more').hide();
                }
            }
        });
    });
});
/*]]>*/