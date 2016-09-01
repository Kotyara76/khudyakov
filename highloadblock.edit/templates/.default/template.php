<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/* @var array $arParams */
/* @var array $arResult */

global $USER_FIELD_MANAGER;

//var_dump($arResult);
?>
<?if ($arResult['update']) { // Обновление записи ?>
	<?if ($arResult['success']) { // успешно обновились ?>
		<?if ($arResult['isAjax']) {?>
			<p>Данные записаны</p>
			<script type="text/javascript">
				window.top.location.href='<?=CUtil::JSEscape($arParams['LIST_URL'])?>';
			</script>
		<?} else {
			LocalRedirect($arParams['LIST_URL']);
		}?>
	<?} else { // есть ошибки ?>
		<p>Ошибка при обновлении</p>
	<?}?>
<?} else { // Выводим поля для редактирования ?>
	<div class="edit-form">
		<form id="company-edit-form" action="<?=POST_FORM_ACTION_URI?>" method="post">
			<?=bitrix_sessid_post()?>
			<table>
				<tbody>
					<?foreach($arResult['fields'] as $field) {?>
						<tr>
							<td>
								<?=$USER_FIELD_MANAGER->GetEditFormHTML(true, $arResult['row'][$field['FIELD_NAME']], $field);?>
							</td>
						</tr>
					<?}?>
				</tbody>
			</table>
			<?if (!$arResult['isAjax']) {?>
				<button type="submit">Сохранить</button>
			<?}?>
		</form>
	</div>
<?}?>