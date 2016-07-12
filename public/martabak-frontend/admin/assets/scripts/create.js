$homeland         = $('#index-homeland').attr('value');
$tiny             = 'active';
var url           = window.location.href;
var getUrl        = window.location.href.split($homeland + '/');
var contentPlural = getUrl[1];

$(window).load(function()
{
    if(contentPlural == 'create/post')
    {
        $plural = 'posts';

        $('#loading-media').fadeIn(function()
        {
            $('#div-media').load($homeland + '/' + contentPlural + '/all/media', function()
            {
                $('#loading-media').hide();
            });
        });

        $('#loading-tag').fadeIn(function()
        {
            $('#div-tag').load($homeland + '/' + contentPlural + '/all/tags', function()
            {
                $('#loading-tag').hide();
            });
        });

        $('#loading-category').fadeIn(function()
        {
            $('#div-category').load($homeland + '/' + contentPlural + '/all/categories', function()
            {
                $('#loading-category').hide();
            });
        });
    }
    else
    {
        $plural = 'pages';

        $('#loading-media').fadeIn(function()
        {
            $('#div-media').load($homeland + '/' + contentPlural + '/all/media', function()
            {
                $('#loading-media').hide();
            });
        });
    }

    $('.input-create-title').keyup(function()
    {
        var slug = $(this).val().toLowerCase().replace(/ /g, '-');

        $('.input-create-slug').attr('value', slug);
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

    $(document).on('click', '.createClick', function()
    {
        var value   = $(this).attr('id').split('-');
        var url     = $homeland + '/process/create';
        var status  = $(this).attr('value');
        var cStatus = $('#button-layout').attr('value');
        var content = $('#textarea-content').attr('value');

        if($tiny == 'active')
        {
            var tinyData = tinyMCE.activeEditor.getContent();
        }
        else
        {
            var tinyData = $('.textarea-custom-content').val();
        }

        switch(value[0])
        {
            case 'create':
                var data = $('#form-create').serialize();

                if(value[1] == 'createPublish')
                {
                    var element = 'publish';
                }
                else if(value[1] == 'createDraft')
                {
                    var element = 'draft';
                }

                if(value[2] == 'post')
                {
                    var data = cStatus + '=' + status + '&' + data + '&' + content + '=' + tinyData;
                }
                else if(value[2] == 'page')
                {
                    if($tiny == 'active')
                    {
                        var typePage     = $('#input-type-page-default').attr('name');
                        var typePageData = $('#input-type-page-default').val();
                    }
                    else
                    {
                        var typePage     = $('#input-type-page-default').attr('name');
                        var typePageData = $('#input-type-page-default').val();
                    }

                    var data = cStatus + '=' + status + '&' + data + '&' + content + '=' + tinyData + '&' + typePage + '=' + typePageData;
                }

                $(this).text('Loading...').animate({opacity: 0.3});
                $('#button-layout').addClass('disable-pointer-events');

                ajaxCreate(url, data, element);
                break;

            case 'default':
                $tiny = 'active';

                $('#custom-page').removeClass('page-active').addClass('page-unactive');
                $(this).removeClass('page-unactive').addClass('page-active');
                $('#default-content').fadeIn();
                $('#custom-content').fadeOut();
                break;

            case 'custom':
                $tiny = 'unactive';

                $('#default-page').removeClass('page-active').addClass('page-unactive');
                $(this).removeClass('page-unactive').addClass('page-active');
                $('#default-content').fadeOut();
                $('#custom-content').fadeIn();
                break;

            case 'addMedia':
                var dataMedia = $(this).attr('value');
                var dataAfter = tinyData + dataMedia;

                tinyMCE.activeEditor.setContent(dataAfter);
                break;

            case 'createOut':
                $(this).text('Loading...').animate({opacity: 0.3});
                $('#button-layout').addClass('disable-pointer-events');
                $('.main-content').fadeOut(function()
                {
                    window.location = $homeland + '/' + $plural;
                });
                break;
        }
    });
});

function ajaxCreate(url, data, element)
{
    $.ajax(
    {
        url: url,
        type: 'POST',
        data: data,
        success: function(report)
        {
            if(report == 'success')
            {
                $('.main-content').fadeOut(function()
                {
                    window.location.href = $homeland + '/' + $plural;
                });
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
