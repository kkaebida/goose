<?php
if(!defined("GOOSE")){exit();}

switch($paramAction)
{
	// create
	case 'create':
		if (!$_POST[name])
		{
			$util->back('[제목]항목이 비었습니다.');
			exit;
		}
		if (!$_POST[module_srl])
		{
			$util->back('module_srl값이 없습니다.');
			exit;
		}

		$regdate = date("YmdHis");
		$turn = $spawn->getCount(array(
			'table' => $tablesName[categories],
			'where' => 'module_srl='.$_POST[module_srl]
		));

		$spawn->insert(array(
			'table' => $tablesName[categories],
			'data' => array(
				'srl' => null,
				'module_srl' => $_POST[module_srl],
				'turn' => $turn,
				'name' => $_POST[name],
				'regdate' => $regdate
			)
		));
		$util->redirect(ROOT.'/category/index/'.$_POST[module_srl].'/', '등록완료');
		break;


	// modify
	case 'modify':
		if (!$_POST[name])
		{
			$util->back('[제목]항목이 비었습니다.');
			exit;
		}
		$spawn->update(array(
			'table' => $tablesName[categories],
			'where' => 'srl='.$_POST[category_srl],
			'data' => array("name='$_POST[name]'")
		));
		$util->redirect(ROOT.'/category/index/'.$_POST[module_srl].'/', '수정완료');
		break;


	// delete
	case 'delete':
		$spawn->delete(array(
			'table' => $tablesName[categories],
			'where' => 'srl='.$_POST[category_srl]
		));
		$spawn->update(array(
			'table' => $tablesName[articles],
			'where' => 'category_srl='.(int)$_POST[category_srl],
			'data' => array('category_srl=NULL')
		));
		$category = $spawn->getItems(array(
			'field' => 'srl,turn',
			'table' => $tablesName[categories],
			'where' => 'module_srl='.$_POST[module_srl],
			'order' => 'turn',
			'sort' => 'asc'
		));
		$n = 0;
		foreach ($category as $k=>$v)
		{
			$spawn->update(array(
				'table' => $tablesName[categories],
				'where' => 'srl='.$v[srl],
				'data' => array('turn='.$n)
			));
			$n++;
		}
		$util->redirect(ROOT.'/category/index/'.$_POST[module_srl].'/', '삭제완료');
		break;


	// sort
	case 'sort':
		if ($_POST[srls])
		{
			$srls = explode(',', $_POST[srls]);
			for ($i=0; $i<count($srls); $i++)
			{
				$spawn->update(array(
					'table' => $tablesName[categories],
					'where' => 'srl='.(int)$srls[$i],
					'data' => array('turn='.$i)
				));
			}
			$util->redirect(ROOT.'/category/index/'.$_POST[module_srl].'/');
		}
		else
		{
			$util->back('srls값이 없습니다.');
		}
		break;
}
?>