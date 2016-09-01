<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>

<div class="client-detail">
	<h4>Клиент</h4>
	<table class="client-detail-table">
		<tbody>
			<?foreach($arResult['fields'] as $field) {?>
				<tr>
					<td class="detail-title">
						<?=$field['displayTitle']?>
					</td>
					<td class="detail-value">
						<?=$field['displayValue']?>
					</td>
				</tr>
			<?}?>
		</tbody>
	</table>
	<?if (isset($arResult['company']) && is_array($arResult['company'])) {?>
		<h4>Компания</h4>
		<table class="client-detail-table">
			<tbody>
			<?foreach($arResult['company'] as $field) {?>
				<tr>
					<td class="detail-title">
						<?=$field['displayTitle']?>
					</td>
					<td class="detail-value">
						<?=$field['displayValue']?>
					</td>
				</tr>
			<?}?>
			</tbody>
		</table>
	<?}?>
</div>
<p>
	<a href="<?=$arParams['LIST_URL']?>"><?=GetMessage('HLBLOCK_ROW_VIEW_BACK_TO_LIST')?></a>
</p>