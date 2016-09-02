<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/* @var array $arParams */

//var_dump($arResult);
?>

<div class="clients-list">
<table class="clients-table" id="report-result-table">
	<!-- head -->
	<thead>
		<tr>
			<?foreach ($arParams['DISPLAY_FIELDS'] as $col) {
			// title
			$arUserField = $arResult['fields'][$col];
			$title = $arUserField["LIST_COLUMN_LABEL"] ? $arUserField["LIST_COLUMN_LABEL"] : $col;

			// sorting
			$defaultSort = 'DESC';
			//$defaultSort = $col['defaultSort'];

			if ($col === $arResult['sort_id'])
			{
				$th_class .= ' reports-selected-column';

				if($arResult['sort_type'] == 'ASC')
				{
					$th_class .= ' reports-head-cell-top';
				}
			}
			else
			{
				if ($defaultSort == 'ASC')
				{
					$th_class .= ' reports-head-cell-top';
				}
			}

			?>
			<th class="<?=$th_class?>" colId="<?=htmlspecialcharsbx($col)?>" defaultSort="<?=$defaultSort?>">
				<div class="reports-head-cell"><?if($defaultSort):
					?><span class="reports-table-arrow"></span><?
				endif?><span class="reports-head-cell-title"><?=htmlspecialcharsex($title)?></span></div>
			</th>
			<?}?>
		</tr>
	</thead>

	<!-- data -->
	<? foreach ($arResult['rows'] as $row) {?>
	<tr>
		<?foreach($arParams['DISPLAY_FIELDS'] as $col) {

			$finalValue = $row[$col];

		// todo перенести формирование detail_url в result_modifier
		if ($col === $arParams['DETAIL_LINK_FIELD'] && !empty($arParams['DETAIL_URL']))
		{
			$url = str_replace('#ID#', $row['ID'], $arParams['DETAIL_URL']);

			$finalValue = '<a href="'.htmlspecialcharsbx($url).'">'.$finalValue.'</a>';
		} elseif ('hlblock' === $arResult['fields'][$col]['USER_TYPE_ID'] && isset($arResult['companies'][$row['ID']]) && $arResult['companies'][$row['ID']] > 0) {
			$url = str_replace('#ID#', $arResult['companies'][$row['ID']], $arParams['EDIT_URL']);
			$finalValue = '<a href="'.$url.'" class="edit-button">'.$finalValue.'</a>';
		}

		?>
		<td><?=$finalValue?></td>
		<?}?>
	</tr>
	<?}?>

</table>
<?// todo по какой-то неясной причине пагинация не работает для D7 ?>
<div class="pager">
	<?=$arResult["NAV_STRING"]?>
</div>

<?// сортировка - взято из штатного компонента ?>
<form id="hlblock-table-form" action="" method="get">
	<input type="hidden" name="sort_id" value="">
	<input type="hidden" name="sort_type" value="">
</form>

</div>

<?// блок для всплывающего окна ?>
<div id="ajax-edit-company"></div>
