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

$arResult["SECTION_COUNT"] = count($arResult["SECTIONS"]);
$rootSectionKey = 0;

foreach ($arResult["SECTIONS"] as $key => $arSection) {
    //кеширование изображений
    if (is_array($arSection["PICTURE"])) {
        $thumb = \CFile::ResizeImageGet(
            $arSection["PICTURE"],
            ["width" => $arParams["IMAGE_SIZE"]["WIDTH"], "height" => $arParams["IMAGE_SIZE"]["HEIGHT"]],
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        if ($thumb["src"]) {
            $arResult["SECTIONS"][$key]["PICTURE"]["SRC"] = $thumb["src"];
        }
    }
    //end
    if ($arSection["DEPTH_LEVEL"] == 1) {
        $rootSectionKey = $key;
    }
    if ($arSection["DEPTH_LEVEL"] > $arResult["SECTIONS"][$rootSectionKey]["DEPTH_LEVEL"]) {
        $arResult["SECTIONS"][$rootSectionKey]["CHILD_SECTIONS"][] = $key;
    }
}

$cp = $this->__component;
if (is_object($cp)) {
    $cp->SetResultCacheKeys(["SECTION_COUNT", "SECTIONS"]);
}