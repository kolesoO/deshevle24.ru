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

$rs = CIBlockPropertyEnum::GetList(
    [],
    [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'CODE' => 'RECOMMEND'
    ]
);
while ($propValue = $rs->fetch()) {
    $arResult['RECOMMEND']['VALUE'][] = $propValue;
}

$cp = $this->__component;
if (is_object($cp)) {
    $cp->SetResultCacheKeys(['RECOMMEND']);
}
