function sppropAction(properties,indexForm='')
{$(document).on('click','body',function()
{properties.objectContent.totalChecked=$(properties.objectContent.childCheckbox+':checkbox:checked').length;if(properties.objectContent.totalChecked>1)
{$('#box-action-selected').removeClass('L-c-disabled').animate({opacity:1});$('#spprop-total-selected').text(properties.objectContent.totalChecked+' '+$('#spprop-index-plural-total-selected').attr('value'));}
else
{if(properties.objectContent.totalChecked!=0)
{$('#box-action-selected').removeClass('L-c-disabled').animate({opacity:1});}
else
{$('#box-action-selected').addClass('L-c-disabled').animate({opacity:0.5});}
$('#spprop-total-selected').text(properties.objectContent.totalChecked+' '+$('#spprop-index-total-selected').attr('value'));}});$(document).on('click','#spprop-search-target',function()
{properties.objectUri.search=$('#spprop-search-input').val().replace(/\s+/g,'+');loading(properties.dinamicAllContentsUrl(),properties.objectContent.mainLoading);});$(document).on('click','.spprop-sortby',function()
{properties.objectUri.sortedBy=$(this).attr('value');loading(properties.dinamicAllContentsUrl(),properties.objectContent.mainLoading);});$(document).on('click','.spprop-paginate',function()
{properties.objectUri.paginate=$(this).attr('value');loading(properties.dinamicAllContentsUrl(),properties.objectContent.mainLoading);});$(document).on('click','.spprop-status',function()
{properties.objectUri.statuses=$(this).attr('value');loading(properties.dinamicAllContentsUrl(),properties.objectContent.mainLoading);});$(document).on('click','#spprop-action-button',function()
{var index=$('#spprop-action-select').val();properties.objectContent.redirect='load';properties.objectContent.alert='#alert-bottom';properties.objectContent.mainLoading='.spprop-general-loading';properties.objectContent.innerLoading='.spprop-general-loading-inner';properties.objectContent.buttonCreateTarget=false;properties.objectContent.optionalData='&'+$('#spprop-optional-form').serialize();switch(index){case'delete':properties.objectContent.indexUrl=properties.dinamicDeleteContentUrl();properties.objectContent.notice=properties.indexLang.delete;break;default:return false;break;}
ajax(properties.objectAjaxProperties());});};
