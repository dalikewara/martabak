$url      = window.location.href;
$host     = window.location.host;
$homeland = $('#index-homeland').attr('value');

$(window).load(function()
{
    $(document).on('change', '.media-upload', function()
    {
        var dataName   = $(this).attr('name');
        var id         = $(this).attr('id').split('-');
        var element    = id[1];
        var thisFiles  = this.files;
        var totalFiles = thisFiles.length;

        $('#uploading-progress-main').fadeIn(function()
        {
            var mainDiv = document.getElementById('uploading-progress-layout');
            var getUrl  = window.URL || window.webkitURL;

            for(i = 0; i < totalFiles; i++)
            {
                var objectUrl       = getUrl.createObjectURL(thisFiles[i]);
                var parentDiv       = document.createElement('div');
                var innerDivImg     = document.createElement('div');
                var innerDivProgLay = document.createElement('div');
                var innerDivProgIn  = document.createElement('div');
                var innerImg        = document.createElement('img');
                var data            = new FormData();

                parentDiv.id = 'uploading-parent-div-' + i;
                parentDiv.className = 'col-sm-3 media-inner-layout';
                innerDivImg.className = 'shadow bg-white pointer media-img-layout';
                innerDivProgLay.id = 'progress-layout-' + i;
                innerDivProgLay.className = 'progress-layout progress-parent-profile-picture bg-smoke';
                innerDivProgIn.id = 'progress-inner-' + i;
                innerDivProgIn.className = 'progress-inner progress-child-profile-child bg-black';
                innerImg.id = 'img-preview-' + i;
                innerImg.className = 'media-img-thumbnail';
                innerImg.src = objectUrl;

                innerDivImg.appendChild(innerImg);
                innerDivProgLay.appendChild(innerDivProgIn);
                parentDiv.appendChild(innerDivImg);
                parentDiv.appendChild(innerDivProgLay);
                mainDiv.appendChild(parentDiv);

                window.URL.revokeObjectURL(thisFiles[i]);

                data.append(dataName, thisFiles[i]);

                $.each($('#form-upload-' + id[1] + '-' + id[2]).serializeArray(), function(a, b)
                {
                    data.append(b.name, b.value);
                });

                mediaUpload(data, element, id, i);
            }
        });
    });

    $(document).on('click', '.media-click', function()
    {
        var value = $(this).attr('value').split('-');
        var title = $('#h3-media-menu-title').attr('value');

        switch(value[0])
        {
            case 'close':
                $('.dark-div').fadeOut();
                $(this).parent().parent().parent().fadeOut();
                $('#uploading-progress-main').fadeOut();
                break;

            case 'update':
                var url     = $homeland + '/process/edit';
                var data    = $('#form-media-update').serialize();
                var element = 'update';

                $(this).text('loading...').animate({opacity: 0.3}).addClass('disable-pointer-events');

                ajaxMedia(url, data, element);
                break;

            case 'open':
                $('#load-media').load($homeland + '/media', function()
                {
                    $('#dark-div-profile').fadeOut();
                    $('.dark-div').fadeOut();
                    $('#media-menu-profile').fadeOut();
                    $('#media-menu').fadeOut();
                    $('#media-menu-detail').fadeOut();
                    $('.dark-div').fadeIn(function()
                    {
                        $('#media-menu').fadeIn(function()
                        {
                            $('#loading-media-content').fadeIn(function()
                            {
                                switch(value[1])
                                {
                                    case 'picture':
                                        $('#load-media-content').load($homeland + '/all/pictures', function()
                                        {
                                            $('#loading-media-content').hide();
                                        });
                                        break;
                                }
                            });
                        });
                    });
                });
                break;

            case 'choose':
                $('#dark-div-profile').fadeIn(function()
                {
                    $('#media-menu-profile').fadeIn(function()
                    {
                        $('#loading-profile-picture').fadeIn(function()
                        {
                            $('#load-profile-picture').load($homeland + '/show/profile-pictures', function()
                            {
                                $('#loading-profile-picture').hide();
                            });
                        });
                    });
                });
                break;

            case 'detail':
                var imgSrc       = $(this).attr('src');
                var imgIndexName = $(this).parent('div.div-media-img').children('input.img-meta-index').attr('name');
                var imgIndexVal  = $(this).parent('div.div-media-img').children('input.img-meta-index').attr('value');
                var imgTitle     = $(this).parent('div.div-media-img').children('input.img-meta-title').attr('value');
                var imgCaption   = $(this).parent('div.div-media-img').children('input.img-meta-caption').attr('value');
                var imgAlt       = $(this).parent('div.div-media-img').children('input.img-meta-alt').attr('value');
                var imgDesc      = $(this).parent('div.div-media-img').children('input.img-meta-desc').attr('value');
                var imgContent   = $(this).parent('div.div-media-img').children('input.img-meta-content').attr('value');
                var imgFileName  = $(this).parent('div.div-media-img').children('input.img-meta-filename').attr('value');
                var imgType      = $(this).parent('div.div-media-img').children('input.img-meta-type').attr('value');
                var imgSize      = $(this).parent('div.div-media-img').children('input.img-meta-size').attr('value');
                var imgCreated   = $(this).parent('div.div-media-img').children('input.img-meta-created').attr('value');

                $('#img-detail').attr('src', imgSrc);
                $('#media-meta-type').text(imgType);
                $('#media-meta-size').text(imgSize);
                $('#media-meta-created').text(imgCreated);
                $('#media-meta-content').text(imgContent + '/' + imgFileName);
                $('#media-meta-filename').text(imgFileName);
                $('#media-meta-index').attr('name', imgIndexName).attr('value', imgIndexVal);
                $('#media-meta-title').attr('value', imgTitle);
                $('#media-meta-caption').attr('value', imgCaption);
                $('#media-meta-alt').attr('value', imgAlt);
                $('#media-meta-desc').val(imgDesc);
                $('.media-menu-panel-top, #main-media-layout, #uploading-progress-main').hide();
                $('#media-detail-menu, #media-button-update').fadeIn();
                $('#h3-media-menu-title').text('Detail');
                $('#media-button-close').attr('value', 'closeDetail').text('Close Detail');
                break;

            case 'closeDetail':
                $('#media-detail-menu, #media-button-update').hide();
                $('.media-menu-panel-top, #main-media-layout, #uploading-progress-main').fadeIn();
                $('#h3-media-menu-title').text(title);
                $('#media-button-close').attr('value', 'close').text('Close');
                $('#load-media-content').load($homeland + '/all/pictures');
                break;

            case 'select':
                var themeColor = $(this).attr('value').split('-');
                var themeColor = themeColor[1];
                var bg         = $(this).parent('div.bg-' + themeColor).attr('value');
                var imgName    = $(this).attr('value').split('-choose:[YourProfilePicture];-');
                var imgSrc     = $(this).attr('src');
                var defaultSrc = $('#default-src-of-profile-picture').attr('value');

                $('.media-img-layout').removeClass('bg-' + themeColor).addClass('bg-white');

                if(typeof bg !== 'undefined')
                {
                    $(this).parent('div.media-img-layout').removeClass('bg-' + themeColor).addClass('bg-white');
                    $('#profile-picture').attr('src', defaultSrc);
                    $('#input-profile-picture').attr('value', '');
                }
                else
                {
                    $(this).parent('div.media-img-layout').removeClass('bg-white').addClass('bg-' + themeColor);
                    $('#profile-picture').attr('src', imgSrc);
                    $('#input-profile-picture').attr('value', imgName[1]);
                }
                break;
        }
    });

    function ajaxMedia(url, data, element)
    {
        $.ajax
        ({
            url: url,
            type: 'POST',
            data: data,
            success: function(report)
            {
                if(report == 'success')
                {
                    $('#media-button-update').text('Update').animate({opacity: 1}).removeClass('disable-pointer-events');
                }
                else
                {
                    //
                }
            },
            error: function()
            {
                //
            }
        });
    }

    function mediaUpload(data, element, id, index)
    {
        $.ajax
        ({
            url: $homeland + '/process/upload',
            type: 'POST',
            data: data,
            processData: false,
            cache: false,
            contentType: false,
            multiple: true,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();

                xhr.upload.addEventListener("progress", function(evt) {
                  if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    console.log(percentComplete);

                    if (percentComplete === 100) {

                    }

                  }
                }, false);

                return xhr;
            },
            success: function(report)
            {
                if(report == 'success')
                {
                    if(element == 'profile')
                    {
                        var newUrl = $homeland + '/show/profile-pictures';
                    }
                    else
                    {
                        var newUrl = $homeland + '/all/pictures';
                    }

                    $('#alert').removeClass('alert-danger').addClass('alert-success').fadeIn(function()
                    {
                        $('#uploading-parent-div-' + index).remove();
                        $('#main-media-layout').animate({opacity: 0.3}).addClass('disable-pointer-events').load(newUrl).animate({opacity: 1}).removeClass('disable-pointer-events');
                    }).fadeOut();
                }
                else
                {
                    $('#alert').removeClass('alert-success alert-danger').addClass('alert-danger').fadeIn();
                    document.getElementById('alert').innerHTML = report;
                }
            },
            error: function()
            {
                // Do some stuff
            },
            resetForm: true
        });
    }
});
