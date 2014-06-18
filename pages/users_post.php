<?
if(!defined("GOOSE")){exit();}

$user_srl = ($routePapameters['param0']) ? (int)$routePapameters['param0'] : null;
if ($paramAction !== "create" && $user_srl)
{
	$user = $spawn->getItem(array(
		'table' => $tablesName[users],
		'where' => 'srl='.$user_srl
	));
	if (($_SESSION['gooseEmail'] != $user['email']) && ($_SESSION['gooseLevel'] < 1))
	{
		$util->back('접근할 수 없습니다.');
	}
}

$titleType = ($paramAction == 'create') ? '등록' : '';
$titleType = ($paramAction == 'modify') ? '수정' : $titleType;
$titleType = ($paramAction == 'delete') ? '삭제' : $titleType;
?>

<section class="form">
	<div class="hgroup">
		<h1>사용자 <?=$titleType?></h1>
	</div>
	<form action="<?=ROOT?>/users/<?=$paramAction?>/" method="post" id="regsterForm">
		<input type="hidden" name="user_srl" value="<?=$user[srl]?>" />
		<?
		if ($paramAction == "delete")
		{
		?>
			<fieldset>
				<legend class="blind">사용자 <?=$titleType?></legend>
				<p class="message">"<?=$user[name]?>"사용자를 삭제하시겠습니까? 삭제된 사용자는 복구할 수 없습니다.</p>
			</fieldset>
		<?
		}
		else
		{
		?>
			<fieldset>
				<legend class="blind">사용자 <?=$titleType?></legend>
				<dl class="table">
					<dt><label for="name">이름</label></dt>
					<dd><input type="text" name="name" id="name" size="20" maxlength="20" placeholder="사용자 이름을 입력하세요." value="<?=$user['name']?>" /></dd>
				</dl>
				<?
				$attr = ($user['email']) ? ' readonly' : '';
				?>
				<dl class="table">
					<dt><label for="email">이메일 주소</label></dt>
					<dd><input type="email" name="email" id="email" size="30" maxlength="40" value="<?=$user['email']?>" <?=$attr?> /></dd>
				</dl>
				<dl class="table">
					<dt><label for="pw">비밀번호</label></dt>
					<dd><input type="password" name="pw" id="pw" size="15" maxlength="20" /></dd>
				</dl>
				<dl class="table">
					<dt><label for="pw2">비밀번호 확인</label></dt>
					<dd><input type="password" name="pw2" id="pw2" size="15" maxlength="20" /></dd>
				</dl>
				<dl class="table">
					<dt><label for="level">레벨</label></dt>
					<dd>
						<select name="level" id="level">
							<option value="">선택하세요.</option>
							<?
							for ($i=1; $i<10; $i++) {
								$selected = ($i == $user['level']) ? 'selected' : '';
								echo "<option value=\"$i\" $selected>$i</option>";
							}
							?>
						</select>
					</dd>
				</dl>
			</fieldset>
		<?
		}
		?>
		<nav class="btngroup">
			<span><button type="submit" class="ui-button btn-highlight"><?=$titleType?></button></span>
			<span><button type="button" class="ui-button" onclick="history.back(-1)">뒤로가기</button></span>
		</nav>
	</form>
</section>

<?
if ($paramAction != "delete")
{
?>
	<script src="<?=$jQueryAddress?>"></script>
	<script src="<?=ROOT?>/pages/src/pkg/validation/jquery.validate.min.js"></script>
	<script src="<?=ROOT?>/pages/src/pkg/validation/localization/messages_ko.js"></script>
	<script>
	jQuery(function($){
		$('#regsterForm').validate({
			rules : {
				name : { required: true, minlength: 2 }
				,email : { required: true }
				,pw : { required: <?=($paramAction == 'create') ? 'true' : 'false'?> }
				,pw2 : { equalTo: '#pw' }
				,level : { required: true }
			}
		});
	});
	</script>
<?
}
?>