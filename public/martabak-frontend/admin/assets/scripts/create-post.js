$url = '/homeland/process/create';
$type = 'POST';
$redirect = '/homeland/posts';

$('#custom-date').addClass('disable-pointer-events');

$('#post-title').keyup(function()
{
    var slug = $(this).val().toLowerCase().replace(/ /g, '-');

    $('#post-slug').attr('value', slug);
});

$('#custom-date-click').click(function()
{
    $('#custom-date').removeClass('disable-pointer-events').animate({opacity: '1'});
});

$('#auto-date-click').click(function()
{
    $('#custom-date').addClass('disable-pointer-events').animate({opacity: '0.4'});
    $('#input-custom-date').val('');
    $('#input-custom-time').val('');
});

$('#draft').click(function()
{
  var data = $('#post-form').serialize();
  var tiny = tinyMCE.activeEditor.getContent();
  var status = $(this).attr('value');
  var content = $('#textarea-content').attr('value');
  var postStatus = $('#button-layout').attr('value');
  var draft = postStatus + '=' + status + '&' + data + '&' + content + '=' + tiny;

  ajaxCreate($url, $type, draft, $redirect);
});

$('#publish').click(function()
{
  var data = $('#post-form').serialize();
  var tiny = tinyMCE.activeEditor.getContent();
  var status = $(this).attr('value');
  var content = $('#textarea-content').attr('value');
  var postStatus = $('#button-layout').attr('value');
  var publish = postStatus + '=' + status + '&' + data + '&' + content + '=' + tiny;

  ajaxCreate($url, $type, publish, $redirect);
});

$('#out').click(function()
{
    $('.content').fadeOut(800, function()
    {
        window.location = '/homeland/posts';
    });
});

function ajaxCreate(url, type, data, redirect)
{
    $.ajax(
    {
        url: url,
        type: type,
        data: data,
        success: function(report)
        {
            if(report == 'success')
            {
                window.location.href = redirect;
            }
            else
            {
                $('#alert').removeClass('hide');
                document.getElementById('alert').innerHTML = report;
            }
        },
        error: function()
        {
            $('#alert').removeClass('hide');
        }
    });
}
