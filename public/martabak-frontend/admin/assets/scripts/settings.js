$url      = window.location.href;
$host     = window.location.host;
$homeland = $('#index-homeland').attr('value');

$('.route-input').parent('div').children('small.route-url').children('span.host-url').text($host);

$('.route-input').keyup(function()
{
    var value = $(this).val().toLowerCase().replace(' ', '/');
    var pathUrl = $(this).parent('div').children('small.route-url').children('span.path-url');

    $(this).val(value);
    pathUrl.text(value);
});

$(document).on('click', '.click', function()
{
    var value = $(this).attr('value').split('-');

    switch(value[0])
    {
        case 'save':
            $(this).text('loading').animate({opacity: 0.3}).addClass('disable-pointer-events');

            var url     = $homeland + '/process/setting';
            var data    = $('.main-setting-form').serialize();
            var element = value[1];

            if(element == 'routes')
            {
                $newHomeland = $('.route-input-homeland').val();
            }

            ajaxSetting(url, data, element);
            break;

        case 'out':
            $('.main-content').fadeOut(800, function()
            {
                window.location = $homeland + '/dashboard';
            });
            break;

        default:
            break;
    }
});

function ajaxSetting(url, data, element)
{
    $.ajax(
    {
        url: url,
        type: 'POST',
        data: data,
        success: function(report)
        {
            if(element == 'routes')
            {
                var newUrl = $url.replace($homeland, $newHomeland);

                window.history.pushState('', '', newUrl);
            }
            else
            {
                var newUrl = $url;
            }

            $('#alert').text(element + ' has been saved.');

            if(report == 'success')
            {
                $('#alert').removeClass('alert-danger').addClass('alert-success').fadeIn(function()
                {
                    $('body').animate({opacity: 0.3}).addClass('disable-pointer-events').load(newUrl).animate({opacity: 1}).removeClass('disable-pointer-events');
                }).fadeOut();
            }
            else
            {
                $('#alert').removeClass('alert-success alert-danger').addClass('alert-danger').fadeIn();
                document.getElementById('alert').innerHTML = report;
            }

            $(this).text('save').animate({opacity: 1}).removeClass('disable-pointer-events');
        }
    });
}
