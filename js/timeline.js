$(document).ready(function() {
    $('#timelineblock').BlocksIt({
        numOfCol: 2,
        offsetX: 0,
        offsetY: 5,
        blockElement: 'div'
    });

// generate arrows according to the position generated bu BlocksIt.js
Arrows();

// This is a small hack to replace the arrows when the block is hovered

// function to place the arrows
function Arrows()
	{ 
		var all_blocks = $('#timelineblock').find('.block');
		
		$.each(all_blocks, function(i, obj){
			var posLeft = $(obj).css("left");

			if ( posLeft == "0px" ) {
				$(obj).css("margin", "0px 0px 20px 0px").css("width", "266px").css("float", "left");
				$(obj).children("span#edge").addClass("redge");			
			} else 	{
				$(obj).css("margin", "0px 0px 20px 18px").css("float","right").css("width", "266px").css("clear","both");
				$(obj).children("span#edge").addClass("ledge");			
			} 		
				
		});
	}
});