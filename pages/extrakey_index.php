<?php
if(!defined("GOOSE")){exit();}

$module_srl = (int)$routePapameters['param0'];
if ($module_srl)
{
	$module = $spawn->getItems(array(
		'table' => $tablesName[modules],
		'where' => 'srl='.$module_srl
	));
	$moduleName = ($module[name]) ? '['.$module[name].']' : '';
}
else
{
	$util->back('모듈값이 없습니다.');
}
?>

<section>
	<div class="hgroup">
		<h1><?=$tableName?> 확장변수 목록</h1>
	</div>
	<form action="<?=ROOT?>/extrakey/sort/" method="post" name="listForm" id="listForm">
		<input type="hidden" name="module_srl" value="<?=$module_srl?>" />
		<input type="hidden" name="srls" value=""/>
		<fieldset>
			<legend class="blind">확장변수 목록</legend>
			<ul id="index" class="index">
				<?
				$itemsIndex = $spawn->getItems(array(
					'table' => $tablesName[extraKey],
					'where' => 'module_srl='.$module_srl,
					'order' => 'turn',
					'sort' => 'asc'
				));
				foreach ($itemsIndex as $k=>$v)
				{
					$n = $v[formType];
				?>
					<li srl="<?=$v[srl]?>">
						<div class="body">
							<strong>[<?=$v[keyName]?>] <?=$v[name]?></strong>
							<div class="inf">
								<p>형식 : <?=$extraKeyTypeArray[$n]?></p>
								<p>기본값 : <?=$v[defaultValue]?></p>
								<p>설명 : <?=$v[info]?></p>
							</div>
							<nav>
								<a href="<?=ROOT?>/extrakey/modify/<?=$v[module_srl]?>/<?=$v[srl]?>/">수정</a>
								<a href="<?=ROOT?>/extrakey/delete/<?=$v[module_srl]?>/<?=$v[srl]?>/">삭제</a>
							</nav>
						</div>
					</li>
				<?
				}
				echo (count($itemsIndex) > 0) ? '' : "<li class=\"empty\">데이터가 없습니다.</li>";
				?>
			</ul>
		</fieldset>
		<div class="btngroup">
			<span><a href="<?=ROOT?>/extrakey/create/<?=$module_srl?>/" class="ui-button btn-highlight">확장변수추가</a></span>
			<span><a href="javascript:onSubmit(document.listForm);" class="ui-button">순서변경</a></span>
			<span><a href="<?=ROOT?>/module/index/<?=$module[group_srl]?>/" class="ui-button">모듈목록</a></span>
		</div>
	</form>
</section>

<script src="<?=$jQueryAddress?>" type="text/javascript"></script>
<script type="text/javascript" src="<?=ROOT?>/pages/src/pkg/dragsort/jquery.dragsort-0.5.1.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	var objs = new Object();
	objs.lst = $('#index');
	objs.form = $('#listForm');
	
	objs.lst.dragsort({
		dragSelector : 'li:not(".empty")'
		,dragBetween : false
		,dragSelectorExclude : 'a'
		,dragEnd : function()
		{
			var srls = objs.lst.children('li').map(function(){
				return $(this).attr('srl')
			}).get().join(',');
			objs.form.children('input[name=srls]').val(srls);
		}
		,placeHolderTemplate : '<li class="placeHolder"></li>'
	});
});

function onSubmit(frm)
{
	if (confirm('순서를 바꾸시겠습니까?'))
	{
		frm.submit();
	}
	else
	{
		return false;
	}
}
</script>