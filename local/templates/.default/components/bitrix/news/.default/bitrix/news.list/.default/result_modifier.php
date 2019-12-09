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

$arResult["ITEMS_COUNT"] = count($arResult["ITEMS"]);
$arResult["PICTURE"] = CFile::GetFileArray($arResult["PICTURE"]);
if (!is_array($arResult["PICTURE"])) {
    $arResult["PICTURE"] = [
        "SRC" => SITE_TEMPLATE_PATH . "/images/no-image.png"
    ];
}

if (is_array($arParams["IMAGE_SIZE"])) {
    //кеширование изображений
    foreach ($arResult["ITEMS"] as &$arItem) {
        if (is_array($arItem["PREVIEW_PICTURE"])) {
            $thumb = \CFile::ResizeImageGet(
                $arItem["PREVIEW_PICTURE"],
                ["width" => $arParams["IMAGE_SIZE"]["WIDTH"], "height" => $arParams["IMAGE_SIZE"]["HEIGHT"]],
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );
            if ($thumb["src"]) {
                $arItem["PREVIEW_PICTURE"]["SRC"] = $thumb["src"];
            }
        }
    }
    unset($arItem);
    //end
}

foreach ($arResult["ITEMS"] as &$arItem) {
    if (strlen($arItem["PREVIEW_TEXT"]) <= 70) continue;
    $arItem["PREVIEW_TEXT"] = mb_substr($arItem["PREVIEW_TEXT"], 0, 70, 'UTF-8') . '...';
}
unset($arItem);

$cp = $this->__component;
if (is_object($cp)) {
    $cp->SetResultCacheKeys(["ITEMS_COUNT"]);
}
