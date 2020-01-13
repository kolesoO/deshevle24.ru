<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 */
?>

<div class="basket-steps col-lg-24">
    <? if (!empty($arResult["ORDER"])): ?>
        <div class="title-2 light">
            <?=Loc::getMessage("SOA_ORDER_SUC", array(
                "#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"]->toUserTime()->format('d.m.Y H:i'),
                "#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]
            ))?>
        </div>
        <? if ($arParams['NO_PERSONAL'] !== 'Y'): ?>
            <div><?=Loc::getMessage('SOA_ORDER_SUC1', ['#LINK#' => $arParams['PATH_TO_PERSONAL']])?></div>
        <? endif; ?>
    <? else: ?>
        <div class="title-2 light"><?=Loc::getMessage("SOA_ERROR_ORDER")?></div>
        <p><?=Loc::getMessage("SOA_ERROR_ORDER_LOST", ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])])?></p>
        <div><?=Loc::getMessage("SOA_ERROR_ORDER_LOST1")?></div>
    <? endif ?>
</div>
