(function ($) {

    $.fn.rating = function (method, options) {
        method = method || 'create';
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            limit: 5,
            value: 0,
            glyph: "glyphicon-star",
            coloroff: "white",
            coloron: "gold",
            size: "3.5em",
            cursor: "pointer",
            onClick: function () {
            },
            endofarray: "idontmatter"
        }, options);
        var style = "";
        style = style + "font-size:" + settings.size + "; ";
        style = style + "color:" + settings.coloroff + "; ";
        style = style + "cursor:" + settings.cursor + "; ";


        if (method == 'create') {
            //this.html('');	//junk whatever was there

            //initialize the data-rating property
            var val_rate = settings.value;
            var val_int = Math.floor(val_rate);
            
            var val_decimal = val_rate-val_int;
            if(val_decimal>=0.5)
            {
                settings.value == settings.value+1;
            }
            this.each(function () {
                attr = $(this).attr('data-rating');
                if (attr === undefined || attr === false) {
                    
                    $(this).attr('data-rating', settings.value);
                }
            });
            
            
            //bolt in the glyphs
            for (var i = 0; i < settings.limit; i++) {
                if(i==(val_int) && val_decimal>=0.5)
                {
                    this.append('<span data-value="' + (i + 1) + '" class="ratingicon fa fa-star-half-empty" style="' + style + '" aria-hidden="true"></span>');
                }
                else
                this.append('<span data-value="' + (i + 1) + '" class="ratingicon fa fa-star" style="' + style + '" aria-hidden="true"></span>');
            }

            $('.ratingicon').mouseover(function () {
                var starValue = $(this).data('value');
                var ratingIcons = $('.ratingicon');
                for (var i = 0; i < starValue; i++) {
                    $(ratingIcons[i]).css('color', settings.coloron);
                }
            }).mouseout(function () {
                var currentRate = $(this).parent().attr('data-rating');
                var ratingIcons = $('.ratingicon');
                for (var i = ratingIcons.length; i >= currentRate; i--) {
                    $(ratingIcons[i]).css('color', settings.coloroff);
                }
            });

            //paint
            this.each(function () {
                paint($(this));
            });

        }
        if (method == 'set') {
            this.attr('data-rating', options);
            this.each(function () {
                paint($(this));
            });
        }
        if (method == 'get') {
            return this.attr('data-rating');
        }
        //register the click events
        this.find("span.ratingicon").click(function () {
            rating = $(this).attr('data-value');
            $(this).parent().attr('data-rating', rating);
            paint($(this).parent());
            settings.onClick.call($(this).parent());
        });
        function paint(div) {
            rating = parseFloat(div.attr('data-rating'));
            var dec = rating-Math.floor(rating);
            if(dec>=0.5)
            rating = parseInt(rating)+1;
            //alert(rating);
            div.find("input").val(rating);	//if there is an input in the div lets set it's value
            div.find("span.ratingicon").each(function () {	//now paint the stars

                var rating = parseFloat($(this).parent().attr('data-rating'));
                var dec = rating-Math.floor(rating);
                if(dec>=0.5)
                rating = parseInt(rating)+1;
                //alert(rating);
                var value = parseInt($(this).attr('data-value'));
                if (value > rating) {
                    $(this).css('color', settings.coloroff);
                }
                else {
                    $(this).css('color', settings.coloron);
                }
            })
        }
    };
}(jQuery));
