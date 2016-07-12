var url           = window.location.href;
var homeland      = $('#index-homeland').attr('value');
var getUrl        = window.location.href.split(homeland + '/');
var contentPlural = getUrl[1];

switch(contentPlural)
{
    case 'posts':
        var contentNoPlural = 'post';
        var contentRelation = ['tag', 'category'];
        var divPlus         = 'task-post';
        break;

    case 'pages':
        var contentNoPlural = 'page';
        var contentRelation = ['tag', 'category'];
        var divPlus         = 'task-page';
        break;

    case 'tags':
        var contentNoPlural = 'tag';
        var contentRelation = ['post'];
        var divPlus         = 'task-tag';
        break;

    case 'categories':
        var contentNoPlural = 'category';
        var contentRelation = ['post'];
        var divPlus         = 'task-category';
        break;

    case 'theme/yours':
        var contentPlural   = 'themes';
        var contentNoPlural = 'theme';
        var divPlus         = 'task-theme';
        break;

    case 'media':
        var contentNoPlural = 'media';
        var divPlus         = 'task-media';
        break;

    case 'setting/profile':
        var contentNoPlural = 'media';
        var divPlus         = 'task-media';
        break;

    default:
        break;
}

if(typeof $path !== 'undefined')
{
    var path          = $path.split('?');
    var pathGET       = path[1].split('&');
    var splitStatus   = pathGET[0].split('=');
    var splitSortedBy = pathGET[1].split('=');
    var splitPaginate = pathGET[2].split('=');
    var splitPage     = pathGET[3].split('=');
    var splitSearch   = pathGET[4].split('=');
    $status           = splitStatus[1];
    $sortedBy         = splitSortedBy[1];
    $paginate         = splitPaginate[1];
    $page             = splitPage[1];
    $search           = splitSearch[1];
}
else
{
    path      = 'n';
    $status   = 1;
    $sortedBy = 'newer';
    $paginate = 12;
    $page     = 1;
    $search   = '';

    if(contentPlural == 'tags')
    {
        $paginate = 20;
    }
}

$('#loading-content').fadeIn(function()
{
    $('#content').load(homeland + '/all/' + contentPlural + '?status=' + $status + '&sortedBy=' + $sortedBy + '&paginate=' + $paginate + '&page=' + $page + '&search=' + $search, function()
    {
        $('#loading-content').hide();
    });
});

$('#loading-trash').fadeIn(function()
{
    $('#trash').load(homeland + '/trash/' + contentNoPlural, function()
    {
        $('#loading-trash').hide();
    });
});

$('#schedule-action').click(function()
{
    $('#schedule-date-action').fadeIn();
});

$('.main-action').click(function()
{
    $('#schedule-date-action').fadeOut();
});

$(window).load(function()
{
    $(document).on('keyup', '.input-name', function()
    {
        var mainValue = $(this).val();
        var nameValue = $(this).val().toLowerCase().replace(/[ ]/g, '-').replace(/[&]/g, '');

        $('.input-slug').attr('value', nameValue);

        if(mainValue != '' && mainValue != ' ')
        {
            $('.button-create').removeClass('disable-pointer-events').animate({opacity: 1});
        }
        else
        {
            $('.button-create').addClass('disable-pointer-events').animate({opacity: 0.3});
        }
    });

    $(document).on('click', '.click', function()
    {
        var div = document.createElement('div');
        var smallText = document.createElement('small');
        var smallYes = document.createElement('small');
        var smallNo = document.createElement('small');
        var textYes = document.createTextNode('Yes');
        var textNo = document.createTextNode('No');
        var value   = $(this).attr('value').split('-');
        var id      = $(this).attr('id');
        var plus    = '';
        var all     = '';
        var loading = 'Loading...';
        var approve = document.getElementById('continue-process-approve-' + value[0]);
        var dontApprove = document.getElementById('continue-process-dontapprove-' + value[0]);
        var spam = document.getElementById('continue-process-spam-' + value[0]);
        var blacklist = document.getElementById('continue-process-blacklist-' + value[0]);
        var remove = document.getElementById('continue-process-remove-' + value[0]);
        var trash = document.getElementById('continue-process-trash-' + value[0]);
        var restore = document.getElementById('continue-process-restore-' + value[0]);

        smallText.className = 'continue-process-text';

        if(value[1] == 'remove')
        {
            smallYes.className = 'btn btn-danger btn-sm yes-continue-process';
        }
        else if(value[1] == 'trash')
        {
            smallYes.className = 'btn btn-warning btn-sm yes-continue-process';
        }
        else if(value[1] == 'restore')
        {
            smallYes.className = 'btn bg-green btn-sm yes-continue-process';
        }
        else if(value[1] == 'comment')
        {
            // if(value[2])
            smallYes.className = 'btn bg-' + value[3] + ' btn-sm yes-continue-process';
        }

        smallNo.className = 'btn btn-no btn-sm no-continue-process';
        smallYes.appendChild(textYes);
        smallNo.appendChild(textNo);

        if(value[1] == 'action')
        {
            var idAct     = $('#id-action').attr('class');
            var statusAct = $('#status-action').attr('class');
            var trashAct  = $('#trash-action').attr('class');
            var removeAct = $('#remove-action').attr('class');
            var act       = $('#process-action').val();
            var statPro   = $('#process-action').val();

            if(act != trashAct && act != removeAct)
            {
                var act = 'statPro';
            }

            if(act == trashAct)
            {
                var act = 'trash';
            }

            if(act == removeAct)
            {
                var act = 'remove';
            }

            var value      = value[1] + '-' + act;
            var value      = value.split('-');
            var contentPro = $('.content-checkbox:checked').map(function(){return this.value;}).get();
            var dataPro    = $('#form-process-action').serialize();
        }

        if(value[2] != '' && value[2] == 'trash')
        {
            var plus = 'trash-';
        }
        else if(value[2] != '' && value[2] == 'media')
        {
            var plus = 'media-';
        }

        if((value[2] != '' && value[2] == 'all') || (value[3] != '' && value[3] == 'all'))
        {
            var all = 'all-';
        }

        switch(value[1])
        {
            case 'update':
                $(this).text(loading).animate({opacity: 0.3}).addClass('disable-pointer-events');

                var url   = homeland + '/process/edit';
                var data1 = $('#form-quick-edit-main-' + value[0]).serialize();

                switch(contentPlural)
                {
                    case 'posts':
                        var data2 = $('#form-tag-' + value[0]).serialize();
                        var data3 = $('#form-category-' + value[0]).serialize();
                        var data4 = $('#form-date-' + value[0]).serialize();
                        var data  = data1 + '&' + data2 + '&' + data3 + '&' + data4;
                        break;

                    case 'categories':
                        var data2 = $('#form-description-' + value[0]).serialize();
                        var data3 = $('#form-post-' + value[0]).serialize();
                        var data  = data1 + '&' + data2 + '&' + data3;
                        break;

                    case 'tags':
                        var data2 = $('#form-post-' + value[0]).serialize();
                        var data  = data1 + '&' + data2;
                        break;

                    default:
                        break;
                }
                var element = 'update';

                ajax(url, data, element);
                break;

            case 'cancel':
                if(contentPlural == 'tags')
                {
                    $(this).parent('div').fadeOut();
                }
                else if(contentPlural == 'pages')
                {
                    $(this).parent('div').parent('div').fadeOut();
                }
                else
                {
                    $(this).parent('td').parent('tr').fadeOut();
                }
                break;

            case 'quickedit':
                var id = id.split('-');
                var id = id[1];

                $('#tr-edit-' + value[0]).fadeToggle();

                $('#loading-' + contentRelation[0] + '-' + value[0]).fadeIn(function()
                {
                    $('#form-' + contentRelation[0] + '-' + value[0]).load(homeland + '/relation/' + contentRelation[0] + '?relation=' + contentNoPlural + '&id=' + id, function()
                    {
                        $('#loading-' + contentRelation[0] + '-' + value[0]).hide();
                    });
                });

                if(contentNoPlural == 'post' || contentNoPlural == 'page')
                {
                    $('#loading-' + contentRelation[1] + '-' + value[0]).fadeIn(function()
                    {
                        $('#form-' + contentRelation[1] + '-' + value[0]).load(homeland + '/relation/' + contentRelation[1] + '?relation=' + contentNoPlural + '&id=' + id, function()
                        {
                            $('#loading-' + contentRelation[1] + '-' + value[0]).hide();
                        });
                    });
                }
                break;

            case 'remove':
                var old     = document.getElementById('continue-process-remove-' + plus + all + value[0]);
                var url     = homeland + '/process/remove';
                var element = 'remove' + '-' + value[2];

                if(value[0] == 'action')
                {
                    $(this).text(loading).animate({opacity: 0.3}).addClass('disable-pointer-events');

                    var data    = dataPro + '&' + idAct + '=' + contentPro;

                    ajax(url, data, element);
                }
                else
                {
                    if(all != '')
                    {
                        var text = document.createTextNode('Are you sure to remove all ' + contentPlural + ' permanently? ');
                    }
                    else
                    {
                        var text = document.createTextNode('Remove permanently? ');
                    }

                    if(old == null)
                    {
                      div.className = 'continue-remove none ' + divPlus;
                      div.id = 'continue-process-remove-' + plus + all + value[0];
                      smallText.appendChild(text);
                      div.appendChild(smallText);
                      div.appendChild(smallYes);
                      div.appendChild(smallNo);

                      $('#child-content-tasks-' + plus + all + value[0]).append(div).children('div').fadeIn();

                      $('#continue-process-remove-' + plus + all + value[0]).children('small.yes-continue-process').click(function()
                      {
                          $(this).text(loading).animate({opacity: 0.3}).addClass('disable-pointer-events');

                          var data = $('#form-remove-' + plus + all + value[0]).serialize();

                          ajax(url, data, element);
                      });

                      $('#continue-process-remove-' + plus + all + value[0]).children('small.no-continue-process').click(function()
                      {
                          $(this).parent(div).fadeOut(function(){$(this).remove()});
                      });
                    }
                    else
                    {
                        $('#continue-process-remove-' + plus + all + value[0]).fadeOut(function(){$(this).remove()});
                    }
                }
                break;

            case 'trash':
                var old     = document.getElementById('continue-process-trash-' + plus + all + value[0]);
                var url     = homeland + '/process/trash';
                var element = 'trash';

                if(value[0] == 'action')
                {
                    $(this).text(loading).animate({opacity: 0.3}).addClass('disable-pointer-events');

                    var data = dataPro + '&' + idAct + '=' + contentPro;

                    ajax(url, data, element);
                }
                else
                {
                    if(all != '')
                    {
                        var text = document.createTextNode('Are you sure to move all ' + contentPlural + ' into the trash? ');
                    }
                    else
                    {
                        var text = document.createTextNode('Move to trash? ');
                    }

                    if(old == null)
                    {
                      div.className = 'continue-trash none ' + divPlus;
                      div.id = 'continue-process-trash-' + plus + all + value[0];
                      smallText.appendChild(text);
                      div.appendChild(smallText);
                      div.appendChild(smallYes);
                      div.appendChild(smallNo);

                      $('#child-content-tasks-' + plus + all + value[0]).append(div).children('div').fadeIn();

                      $('#continue-process-trash-' + plus + all + value[0]).children('small.yes-continue-process').click(function()
                      {
                          $(this).text(loading).animate({opacity: 0.3}).addClass('disable-pointer-events');

                          var data = $('#form-trash-' + plus + all + value[0]).serialize();

                          ajax(url, data, element);
                      });

                      $('#continue-process-trash-' + plus + all + value[0]).children('small.no-continue-process').click(function()
                      {
                          $(this).parent(div).fadeOut(function(){$(this).remove()});
                      });
                    }
                    else
                    {
                        $('#continue-process-trash-' + plus + all + value[0]).fadeOut(function(){$(this).remove()});
                    }
                }
                break;

            case 'restore':
                var old     = document.getElementById('continue-process-restore-' + plus + all + value[0]);
                var url     = homeland + '/process/restore';
                var element = 'restore';

                if(value[0] == 'action')
                {
                    $(this).text(loading).animate({opacity: 0.3}).addClass('disable-pointer-events');

                    var data = dataPro + '&' + idAct + '=' + contentPro;

                    ajax(url, data, element);
                }
                else
                {
                    if(all != '')
                    {
                        var text = document.createTextNode('Are you sure to restore all ' + contentPlural + '? ');
                    }
                    else
                    {
                        var text = document.createTextNode('Restore ' + contentNoPlural + '? ');
                    }

                    if(old == null)
                    {
                      div.className = 'continue-restore none ' + divPlus;
                      div.id = 'continue-process-restore-' + plus + all + value[0];
                      smallText.appendChild(text);
                      div.appendChild(smallText);
                      div.appendChild(smallYes);
                      div.appendChild(smallNo);

                      $('#child-content-tasks-' + plus + all + value[0]).append(div).children('div').fadeIn();

                      $('#continue-process-restore-' + plus + all + value[0]).children('small.yes-continue-process').click(function()
                      {
                          $(this).text(loading).animate({opacity: 0.3}).addClass('disable-pointer-events');

                          var data = $('#form-restore-' + plus + all + value[0]).serialize();

                          ajax(url, data, element);
                      });

                      $('#continue-process-restore-' + plus + all + value[0]).children('small.no-continue-process').click(function()
                      {
                          $(this).parent(div).fadeOut(function(){$(this).remove()});
                      });
                    }
                    else
                    {
                        $('#continue-process-restore-' + plus + all + value[0]).fadeOut(function(){$(this).remove()});
                    }
                }
                break;

            case 'statPro':
                $(this).text(loading).animate({opacity: 0.3}).addClass('disable-pointer-events');

                var url     = homeland + '/process/status';
                var schName = $('#input-schedule-date-action').attr('name');
                var schVal  = $('#input-schedule-date-action').val();
                var data    = dataPro + '&' + idAct + '=' + contentPro + '&' + statusAct + '=' + statPro + '&' + schName + '=' + schVal;
                var element = 'status';

                ajax(url, data, element);
                break;

            case 'checkbox':
                $('.checkbox-all').prop('checked', this.checked);
                break;

            case 'create':
                $(this).text(loading).animate({opacity: 0.3}).addClass('disable-pointer-events');

                var url     = homeland + '/process/create';
                var data    = $('#form-create').serialize();
                var element = 'create';

                ajax(url, data, element);
                break;

            case 'active':
                $(this).text(loading).animate({opacity: 0.3}).addClass('disable-pointer-events');

                var url     = homeland + '/process/status';
                var data    =  $('#form-active-' + value[0]).serialize();
                var element = 'theme-active';

                ajax(url, data, element);
                break;

            case 'deactive':
                $(this).text(loading).animate({opacity: 0.3}).addClass('disable-pointer-events');

                var url     = homeland + '/process/status';
                var data    =  $('#form-deactive-' + value[0]).serialize();
                var element = 'theme-deactive';

                ajax(url, data, element);
                break;

            case 'comment':
                var old = document.getElementById('continue-process-' + value[2] + '-' + value[0]);

                switch(value[2])
                {
                    case 'approve':
                        var text = document.createTextNode('Approve this comment?');

                        if(dontApprove != null)
                        {
                            dontApprove.parentNode.removeChild(dontApprove);
                        }

                        if(spam != null)
                        {
                            spam.parentNode.removeChild(spam);
                        }

                        if(blacklist != null)
                        {
                            blacklist.parentNode.removeChild(blacklist);
                        }

                        if(remove != null)
                        {
                            remove.parentNode.removeChild(remove);
                        }
                        break;

                    case 'dontapprove':
                        var text = document.createTextNode("Don't approve this comment?");

                        if(approve != null)
                        {
                            approve.parentNode.removeChild(approve);
                        }

                        if(spam != null)
                        {
                            spam.parentNode.removeChild(spam);
                        }

                        if(blacklist != null)
                        {
                            blacklist.parentNode.removeChild(blacklist);
                        }

                        if(remove != null)
                        {
                            remove.parentNode.removeChild(remove);
                        }
                        break;

                    case 'spam':
                        var text = document.createTextNode('Mark to spam?');

                        if(dontApprove != null)
                        {
                            dontApprove.parentNode.removeChild(dontApprove);
                        }

                        if(approve != null)
                        {
                            approve.parentNode.removeChild(approve);
                        }

                        if(blacklist != null)
                        {
                            blacklist.parentNode.removeChild(blacklist);
                        }

                        if(remove != null)
                        {
                            remove.parentNode.removeChild(remove);
                        }
                        break;

                    case 'blacklist':
                        var text = document.createTextNode('Blacklist this comment?');

                        if(dontApprove != null)
                        {
                            dontApprove.parentNode.removeChild(dontApprove);
                        }

                        if(spam != null)
                        {
                            spam.parentNode.removeChild(spam);
                        }

                        if(approve != null)
                        {
                            approve.parentNode.removeChild(approve);
                        }

                        if(remove != null)
                        {
                            remove.parentNode.removeChild(remove);
                        }
                        break;
                }

                if(old == null)
                {
                  div.className = 'continue-' + value[2] + ' none';
                  div.id = 'continue-process-' + value[2] + '-' + value[0];
                  smallText.appendChild(text);
                  div.appendChild(smallText);
                  div.appendChild(smallYes);
                  div.appendChild(smallNo);

                  $('#child-content-tasks-' + value[0]).append(div).children('div').fadeIn();

                  $('#continue-process-' + value[2] + '-' + value[0]).children('small.yes-continue-process').click(function()
                  {

                  });

                  $('#continue-process-' + value[2] + '-' + value[0]).children('small.no-continue-process').click(function()
                  {
                      $(this).parent(div).fadeOut(function(){$(this).remove()});
                  });
                }
                else
                {
                    $('#continue-process-' + value[2] + '-' + value[0]).fadeOut(function(){$(this).remove()});
                }

                break;

            case 'notification':
                var url     = homeland + '/process/status';
                var data    = $('#form-status-' + value[0]).serialize();
                var element = 'notif-status';

                ajax(url, data, element);
                break;
        }
    });

    $(document).on('click', '.sort', function()
    {
        var value = $(this).attr('value').split('-');

        switch(value[0])
        {
            case 'status':

                if(value[1] == 'comment')
                {
                    $(this).removeClass('unactive').addClass('active bg-' + value[3]);

                    switch(value[2])
                    {
                        case '2':
                            $('#sort-latest, #sort-notapproved, #sort-spam, #sort-blacklist').removeClass('active').addClass('unactive');
                            $('.main-action-approve').addClass('none');
                            $('.main-action-dontapprove').removeClass('none');
                            $('.main-action-spam').removeClass('none');
                            $('.main-action-blacklist').removeClass('none');
                            break;

                        case '3':
                            $('#sort-latest, #sort-approved, #sort-spam, #sort-blacklist').removeClass('active').addClass('unactive');
                            $('.main-action-dontapprove').addClass('none');
                            $('.main-action-approve').removeClass('none');
                            $('.main-action-spam').removeClass('none');
                            $('.main-action-blacklist').removeClass('none');
                            break;

                        case '4':
                            $('#sort-latest, #sort-notapproved, #sort-approved, #sort-blacklist').removeClass('active').addClass('unactive');
                            $('.main-action-spam').addClass('none');
                            $('.main-action-dontapprove').addClass('none');
                            $('.main-action-approve').removeClass('none');
                            $('.main-action-blacklist').removeClass('none');
                            break;

                        case '5':
                            $('#sort-latest, #sort-notapproved, #sort-spam, #sort-approved').removeClass('active').addClass('unactive');
                            $('.main-action-blacklist').addClass('none');
                            $('.main-action-dontapprove').addClass('none');
                            $('.main-action-approve').removeClass('none');
                            $('.main-action-spam').removeClass('none');
                            break;

                        default:
                            $('#sort-approved, #sort-notapproved, #sort-spam, #sort-blacklist').removeClass('active').addClass('unactive');
                            $('.main-action-approve').addClass('none');
                            $('.main-action-dontapprove').addClass('none');
                            $('.main-action-spam').removeClass('none');
                            $('.main-action-blacklist').removeClass('none');
                            break;
                    }

                    $status = value[2];
                    $page   = 1;
                }
                else if(value[1] == 'notification')
                {
                    $(this).removeClass('unactive').addClass('active bg-' + value[3]);

                    switch(value[2])
                    {
                        case '2':
                            $('#sort-latest, #sort-notwatched, #sort-comment, #sort-favourite').removeClass('active bg-' + value[3]).addClass('unactive');
                            break;

                        case '3':
                            $('#sort-latest, #sort-watched, #sort-comment, #sort-favourite').removeClass('active bg-' + value[3]).addClass('unactive');
                            break;

                        case '4':
                            $('#sort-latest, #sort-watched, #sort-notwatched, #sort-favourite').removeClass('active bg-' + value[3]).addClass('unactive');
                            break;

                        case '5':
                            $('#sort-latest, #sort-watched, #sort-comment, #sort-notwatched').removeClass('active bg-' + value[3]).addClass('unactive');
                            break;

                        default:
                            $('#sort-watched, #sort-notwatched, #sort-comment, #sort-favourite').removeClass('active bg-' + value[3]).addClass('unactive');
                            break;
                    }

                    $status = value[2];
                    $page   = 1;
                }
                else
                {
                    $(this).removeClass('unactive').addClass('active bg-' + value[2]);

                    switch(value[1])
                    {
                        case '2':
                            $('#sort-published, #sort-scheduled').removeClass('active bg-' + value[2]).addClass('unactive');
                            $('.main-action-draft').addClass('none');
                            $('.main-action-publish').removeClass('none');
                            $('.main-action-schedule').removeClass('none');
                            break;

                        case '3':
                            $('#sort-published, #sort-drafted').removeClass('active bg-' + value[2]).addClass('unactive');
                            $('.main-action-schedule').addClass('none');
                            $('.main-action-draft').removeClass('none');
                            $('.main-action-publish').removeClass('none');
                            break;

                        default:
                            $('#sort-drafted, #sort-scheduled').removeClass('active bg-' + value[2]).addClass('unactive');
                            $('.main-action-publish').addClass('none');
                            $('.main-action-draft').removeClass('none');
                            $('.main-action-schedule').removeClass('none');
                            break;
                    }

                    $status = value[1];
                    $page   = 1;
                }
                break;

            case 'sortedBy':
                $sortedBy = value[1];
                break;

            case 'paginate':
                $paginate = value[1];
                break;

            case 'page':
                $page = value[1];
                break;

            case 'next':
                $page = value[1];
                break;

            case 'prev':
                $page = value[1];
                break;

            case 'nexttop':
                $page = value[1];
                break;

            case 'prevtop':
                $page = value[1];
                break;

            case 'search':
                var data = $('#search').val().replace(/[ ]/g, '-');
                $search  = data;
                $page = 1;
                break;

            case 'clearsearch':
                $('#search').val('');
                $search = '';
                $page = 1;
                break;

            default:
                break;
        }

        $path = location.href + '?status=' + $status + '&sortedBy=' + $sortedBy + '&paginate=' + $paginate + '&page=' + $page + '&search=' + $search;
        $('#content').animate({opacity: 0.3}).addClass('disable-pointer-events').load(homeland + '/all/' + contentPlural + '?status=' + $status + '&sortedBy=' + $sortedBy + '&paginate=' + $paginate + '&page=' + $page + '&search=' + $search).animate({opacity: 1}).removeClass('disable-pointer-events');
    });
});

function ajax(url, data, element)
{
    $.ajax(
    {
        url: url,
        type: 'POST',
        data: data,
        success: function(report)
        {
            var plus       = '';
            var urlPlus    = '';
            var selector   = '#content';
            var urlContent = homeland + '/all/' + contentPlural + '?status=' + $status + '&sortedBy=' + $sortedBy + '&paginate=' + $paginate + '&page=' + $page + '&search=' + $search;
            var urlTrash   = homeland + '/trash/' + contentNoPlural;
            var urlLoad    = urlContent;

            if(report == 'success')
            {
                switch(element)
                {
                    case 'trash':
                        var plus     = '#trash';
                        var urlPlus  = urlTrash;

                        $('#alert').text('Trash: success.');
                        break;

                    case 'remove':
                        $('#alert').text('Remove: success.');
                        break;

                    case 'remove-profile':
                        $('#alert').text('Remove: success.');
                        break;

                    case 'remove-media':
                        $('#alert').text('Remove: success.');
                        break;

                    case 'removeTrash':
                        var selector = '#trash';
                        var urlLoad  = urlTrash;

                        $('#alert').text('Remove: success.');
                        break;

                    case 'restore':
                        var selector = '#trash';
                        var urlLoad  = urlTrash;
                        var plus     = '#content';
                        var urlPlus  = urlContent;

                        $('#alert').text('Restore: success.');
                        break;

                    case 'update':
                        $('#alert').text('Update: success.');
                        break;

                    case 'status':
                        $('#alert').text('Status: success.');
                        break;

                    case 'create':
                        $('#alert').text('Create: success.');
                        break;
                }

                if(element == 'remove-profile' || element == 'remove-media')
                {
                    if(element == 'remove-profile')
                    {
                        var newUrl = $homeland + '/show/profile-pictures';
                    }
                    else
                    {
                        var newUrl = $homeland + '/all/pictures';
                    }

                    $('#alert').removeClass('alert-danger').addClass('alert-success').fadeIn(function()
                    {
                        $('#main-media-layout').animate({opacity: 0.3}).addClass('disable-pointer-events').load(newUrl).animate({opacity: 1}).removeClass('disable-pointer-events');
                    }).fadeOut();
                }
                else
                {
                    $('#alert').removeClass('alert-danger').addClass('alert-success').fadeIn(function()
                    {
                        $(selector).animate({opacity: 0.3}).addClass('disable-pointer-events').load(urlLoad).animate({opacity: 1}).removeClass('disable-pointer-events');

                        if(plus != '')
                        {
                            $(plus).animate({opacity: 0.3}).addClass('disable-pointer-events').load(urlPlus).animate({opacity: 1}).removeClass('disable-pointer-events');
                        }
                    }).fadeOut();

                    $('.create-input ').val('');
                }
            }
            else
            {
                $('#alert').removeClass('alert-success alert-danger').addClass('alert-danger').fadeIn();
                document.getElementById('alert').innerHTML = report;
            }

            $('.button-process, .button-create').text('Process').animate({opacity: 1}).removeClass('disable-pointer-events');
        }
    });
}
