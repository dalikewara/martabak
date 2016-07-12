$(document).ready(function()
{
    checkboxSelect();

    accordion('#nav-dash', '#in-dash', '#in-post', '#in-page', '#in-tag', '#in-theme', '#in-set', '#in-comment', '#in-media', '#nav-post', '#nav-page', '#nav-tag', '#nav-theme', '#nav-set', '#nav-comment', '#nav-media');
    accordion('#nav-post', '#in-post', '#in-dash', '#in-page', '#in-tag', '#in-theme', '#in-set', '#in-comment', '#in-media', '#nav-dash', '#nav-page', '#nav-tag', '#nav-theme', '#nav-set', '#nav-comment', '#nav-media');
    accordion('#nav-page', '#in-page', '#in-dash', '#in-post', '#in-tag', '#in-theme', '#in-set', '#in-comment', '#in-media', '#nav-dash', '#nav-post', '#nav-tag', '#nav-theme', '#nav-set', '#nav-comment', '#nav-media');
    accordion('#nav-tag', '#in-tag', '#in-dash', '#in-page', '#in-post', '#in-theme', '#in-set', '#in-comment', '#in-media', '#nav-dash', '#nav-page', '#nav-post', '#nav-theme', '#nav-set', '#nav-comment', '#nav-media');
    accordion('#nav-theme', '#in-theme', '#in-dash', '#in-page', '#in-tag', '#in-post', '#in-set', '#in-comment', '#in-media', '#nav-dash', '#nav-page', '#nav-tag', '#nav-post', '#nav-set', '#nav-comment', '#nav-media');
    accordion('#nav-set', '#in-set', '#in-dash', '#in-page', '#in-tag', '#in-theme', '#in-post', '#in-comment', '#in-media', '#nav-dash', '#nav-page', '#nav-tag', '#nav-theme', '#nav-post', '#nav-comment', '#nav-media');
    accordion('#nav-comment', '#in-comment', '#in-set', '#in-dash', '#in-page', '#in-tag', '#in-theme', '#in-post', '#in-media', '#nav-set', '#nav-dash', '#nav-page', '#nav-tag', '#nav-theme', '#nav-post', '#nav-media');
    accordion('#nav-media', '#in-media', '#in-set', '#in-dash', '#in-page', '#in-tag', '#in-theme', '#in-post', '#in-comment', '#nav-set', '#nav-dash', '#nav-page', '#nav-tag', '#nav-theme', '#nav-post', '#nav-comment');

    function accordion(parent, parentIn, x1, x2, x3, x4, x5, x6, x7, y1, y2, y3, y4, y5, y6, y7)
    {
        var themeColor = $('#theme-color').val();

        $(parent).click(function()
        {
            $(this).toggleClass(themeColor + '-navigation-active');
            $(parentIn).slideToggle(300);
            $(x1).slideUp(300);
            $(y1).removeClass(themeColor + '-navigation-active');
            $(x2).slideUp(300);
            $(y2).removeClass(themeColor + '-navigation-active');
            $(x3).slideUp(300);
            $(y3).removeClass(themeColor + '-navigation-active');
            $(x4).slideUp(300);
            $(y4).removeClass(themeColor + '-navigation-active');
            $(x5).slideUp(300);
            $(y5).removeClass(themeColor + '-navigation-active');
            $(x6).slideUp(300);
            $(y6).removeClass(themeColor + '-navigation-active');
            $(x7).slideUp(300);
            $(y7).removeClass(themeColor + '-navigation-active');
        });
    }

    function checkboxSelect()
    {
        $('html').click(function()
        {
            var inputChecked = $('.content-checkbox:checkbox:checked').length;

            if(inputChecked > 1)
            {
                var con = ' items selected';
            }
            else
            {
                var con = ' item selected';
            }

            $('.total-selected').text(inputChecked + con);

            if(inputChecked > 0)
            {
                $('.action-selected').animate({opacity: '1'}).removeClass('disable-pointer-events');
            }
            else
            {
                $('.action-selected').animate({opacity: '0.5'}).addClass('disable-pointer-events');
            }
        });
    }
});
