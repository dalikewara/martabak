function realtimePreview(target,url,main)
{$(document).on('click',target,function()
{$('#realtime-preview-main').fadeToggle();var uri=$(this).attr('value');$(main).load(url+uri);});}
function autoFillReplace(index,target,replacePrefix='',indexTarget='value')
{$(document).on('keyup',index,function()
{var value=$(this).val().replace(/\s+/g,replacePrefix).toLowerCase().replace(/[:'"@!~`)(]/g,'');if(indexTarget=='value')
{$(target).val(value);}});}
function targetDisabled(indexActive,indexDeactive,target)
{$(indexActive).click(function()
{$(target).animate({opacity:1}).removeClass('L-i-disabled');});$(indexDeactive).click(function()
{$(target).animate({opacity:0.5}).addClass('L-i-disabled');});}
function hoverPopUp(index,target)
{$(index).hover(function()
{$(target).stop(true,false,true).slideToggle(100);});}
function displayTableEdit(indexObject,target)
{$(document).on('click',indexObject.classname,function()
{var indexSpot,indexSplit,indexValid;indexSpot=$(this).attr(indexObject.element);indexSplit=indexSpot.split(indexObject.splitOperator);indexValid=indexSplit[indexObject.elementSplit];$(target+indexValid).fadeToggle(100);});}
function checkAllTarget(index,target)
{$(document).on('click',index,function()
{var allTarget,targetChecked;allTarget=$(target+':checkbox').length;targetChecked=$(target+':checkbox:checked').length;if(allTarget==targetChecked)
{$(target+', '+index).prop('checked',false).removeAttr('chekced');}
else
{$(target+', '+index).prop('checked',true).attr('checked','checked');}})}
function dinamicPagination(object,properties)
{$(document).on('click',object.targetClassName,function()
{indexPage=$(this).attr(object.splitId);split=indexPage.split(object.splitOperator);value=split[object.splitIndex];properties.objectUri.page=value;loading(properties.dinamicAllContentsUrl(),object.mainLoading);return false;});}
function loading(url,main,inner='',beforeSend='false')
{if(inner=='')
{if(beforeSend=='false')
{$(main).css('pointer-events','none').animate({opacity:0.5},function()
{$(main).load(url,function()
{$(main).css('pointer-events','auto').animate({opacity:1});});});}
else
{$(main).css('pointer-events','none').animate({opacity:0.5});}}
else
{$(inner).fadeIn(function()
{$(main).load(url,function()
{$(inner).hide();});});}}
function showAndHideIndexes(index,target)
{$(document).on(target.actionEvent,index.classNameShow,function()
{var showSpot=$(this).attr(index.elementShow);var showSplit=showSpot.split(index.splitOperatorShow);var validShowIndex=showSplit[index.elementSplitShow];$(target.targetToShow+validShowIndex).fadeIn();$(target.targetToHide+validShowIndex).hide();});$(document).on(target.actionEvent,index.classNameHide,function()
{var hideSpot=$(this).attr(index.elementHide);var hideSplit=hideSpot.split(index.splitOperatorHide);var validHideIndex=hideSplit[index.elementSplitHide];$(target.targetToHide+validHideIndex).fadeIn();$(target.targetToShow+validHideIndex).hide();});}
function generateChecked(inputClassName,properties)
{$('body').click(function()
{properties.objectContent.totalChecked=$(inputClassName+':checkbox:checked').length;});}
function ajaxFromTarget(ajaxProperties,indexObject,optional='')
{$(document).on('click',indexObject.classname,function()
{var indexSpot,indexSplit,indexValid,data;indexSpot=$(this).attr(indexObject.element);indexSplit=indexSpot.split(indexObject.splitOperator);indexValid=indexSplit[indexObject.elementSplit];form=$(indexObject.indexForm+indexValid);value=$(this).attr('value');ajaxProperties.formElement=form;ajaxProperties.targetElement=false;if(optional!='')
{if(value=='draft')
{ajaxProperties.notice=optional.indexLang.draft;}
else if(value=='publish')
{ajaxProperties.notice=optional.indexLang.publish;}}
ajax(ajaxProperties);});}
function ajax(properties)
{target=properties.targetElement;if(target==false)
{getAjax();}
else
{$(document).on('click',target,function()
{if(properties.redirect=='content'||properties.redirect=='self-content')
{getAjax('&'+$(this).attr('value'));}
else
{getAjax();}});}
function getAjax(optionalData='')
{var url,data,alert,redirect,notice,loadMain,loadUrl;if(optionalData=='')
{optionalData=properties.optionalData;}
url=properties.url;data=$(properties.formElement).serialize()+optionalData;alert=properties.alert;redirect=properties.redirect;notice=properties.notice;if(redirect=='load'||redirect=='self-content')
{loadMain=properties.loadMain;loadUrl=properties.loadUrl;loadAjax(url,data,alert,redirect,notice,properties.formElement,loadUrl,loadMain);}
else
{loadAjax(url,data,alert,redirect,notice,properties.formElement);}}
function loadAjax(url,data,alert,redirect,notice,form='',loadUrl='',loadMain='')
{$.ajax({url:url,data:data,type:'POST',beforeSend:function()
{if(redirect=='load'||redirect=='self-content')
{loading(loadUrl,loadMain,'','true');}},success:function(report)
{if(report=='ok')
{$(alert).removeClass('L-n-style-1-danger').addClass('L-n-style-1-success').fadeIn().text(notice).animate({opacity:1},1500).fadeOut(function()
{switch(redirect)
{case'dashboard':$('body').fadeOut(function()
{window.location.href=$('#index-dashboard').val();});break;case'self':location.reload();break;case'self-content':loading(loadUrl,loadMain,'','false');break;case'load':loading(loadUrl,loadMain,'','false');break;case'content':$('body').fadeOut(function()
{window.location.href=$('#index-dashboard').val()+'/contents';});break;default:break;}});if(form!=''&&redirect!='self-content')
{$(form+' input[type="text"], '+form+' textarea').val('');}}
else
{$(alert).removeClass('L-n-style-1-success').addClass('L-n-style-1-danger').fadeIn().text(report).animate({opacity:1},1500).fadeOut();if(redirect=='load'||redirect=='self-content')
{loading(loadUrl,loadMain,'','false');}}},});}}
