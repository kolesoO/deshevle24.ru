<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

$arResult["OFFERS_COUNT"] = count($arResult["OFFERS_LIST"]);

if ($arResult["OFFERS_COUNT"] > 0) {
    foreach ($arResult["OFFERS_LIST"] as &$arOffer) {
        $arOffer["DETAIL_PAGE_URL"] = $arResult["ITEM"]["DETAIL_PAGE_URL"].\kDevelop\Help\Tools::getOfferPrefixInUrl().$arOffer["CODE"]."/";
    }
    unset($arOffer);
    $arResult["OFFER"] = $arResult["OFFERS_LIST"][$arResult["OFFER_KEY"]];
    if (!is_array($arResult["OFFER"]["PREVIEW_PICTURE"]) && is_array($arResult["ITEM"]["PREVIEW_PICTURE"])) {
        $arResult["OFFER"]["PREVIEW_PICTURE"] = $arResult["ITEM"]["PREVIEW_PICTURE"];
    }
} else {
    $arResult["OFFER"] = $arResult["ITEM"];
}
if (!isset($arResult["AREA_ID"]) && strlen($arResult["AREA_ID"]) == 0) {
    unset($arResult["AREA_ID"]);
}

//родительский раздел
if (intval($arResult["ITEM"]["IBLOCK_SECTION_ID"]) > 0) {
    $arResult["ITEM"]["PARENT_SECTION"] = \CIBlockSection::GetByID($arResult["ITEM"]["IBLOCK_SECTION_ID"])->fetch();
}
//end

$cp = $this->__component;
if (is_object($cp)) {
    $cp->SetResultCacheKeys(["OFFERS_COUNT", "OFFER", "AREA_ID", "ITEM"]);
}
