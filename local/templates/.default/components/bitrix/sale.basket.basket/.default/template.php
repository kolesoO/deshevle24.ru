<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixBasketComponent $component */

global $rsAsset;

$rsAsset->addJs($templateFolder."/script.js");
$curPage = $APPLICATION->GetCurPage().'?'.$arParams["ACTION_VARIABLE"].'=';
$arUrls = array(
	"delete" => $curPage."delete&id=#ID#",
	"delay" => $curPage."delay&id=#ID#",
	"add" => $curPage."add&id=#ID#",
);
unset($curPage);

$arBasketJSParams = array(
	'SALE_DELETE' => GetMessage("SALE_DELETE"),
	'SALE_DELAY' => GetMessage("SALE_DELAY"),
	'SALE_TYPE' => GetMessage("SALE_TYPE"),
	'TEMPLATE_FOLDER' => $templateFolder,
	'DELETE_URL' => $arUrls["delete"],
	'DELAY_URL' => $arUrls["delay"],
	'ADD_URL' => $arUrls["add"],
	'EVENT_ONCHANGE_ON_START' => (!empty($arResult['EVENT_ONCHANGE_ON_START']) && $arResult['EVENT_ONCHANGE_ON_START'] === 'Y') ? 'Y' : 'N'
);
?>
<script type="text/javascript">
	var basketJSParams = <?=CUtil::PhpToJSObject($arBasketJSParams);?>
</script>

<div class="basket-info" flex-align="start" flex-text_align="space-between">
    <div>
        <div class="title-1"><?$APPLICATION->ShowTitle(false)?></div>
        <span>Проверьте пожалуйста выбранные параметры и правильность заказа.</span>
    </div>
    <div class="basket-txt">
        <span>Стоимость заказа указана без учета доставки</span>
    </div>
</div>

<?
if (strlen($arResult["ERROR_MESSAGE"]) <= 0)
{
	?>
    <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="basket_form" id="basket_form" class="basket-list col-lg-24">
        <div id="warning_message">
            <?if (!empty($arResult["WARNING_MESSAGE"]) && is_array($arResult["WARNING_MESSAGE"]))
            {
                foreach ($arResult["WARNING_MESSAGE"] as $v)
                    ShowError($v);
            }?>
        </div>
        <?
        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items.php");
        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_delayed.php");
        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_subscribed.php");
        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_not_available.php");
        ?>
        <input type="hidden" name="BasketOrder" value="BasketOrder" />
        <!-- <input type="hidden" name="ajax_post" id="ajax_post" value="Y"> -->
    </form>
	<?
}
else
{
	ShowError($arResult["ERROR_MESSAGE"]);
}