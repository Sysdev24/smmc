;(function($) {

    $.fn.waffler = function (options) {
        var $waffles = $('.waffle'),
            $items = $waffles.find('li span'),
            dragging = false,
            $waffle,
            $item;


        $items.mousedown(function () {
            $item = $(this).closest('li');
            $waffle = $item.parent();
            $items.closest('li').addClass('transparent');
            $item.addClass('moving blue');
            dragging = true;
        });

        $items.mousemove(function (e) {
            var $hoverItem = $(this).closest('li'),
                overTop = false,
                overBottom = false,
                hoverItemHeight = $hoverItem.outerHeight(),
                yPos = e.offsetY;

            yPos < (hoverItemHeight / 2) ? overTop = true : overBottom = true;

            if ($item && $hoverItem.parent().get(0) === $item.parent().get(0)) {
                if (dragging && overTop) {
                    $item.insertBefore($hoverItem);
                }

                if (dragging && overBottom) {
                    $item.insertAfter($hoverItem);
                }
            }
        });

        $(document).mouseup(function () {
            if($item){
                $items.closest('li').removeClass('transparent');
                $item.removeClass('moving blue');
                dragging = false;
            }
        });

    };

})(jQuery);
