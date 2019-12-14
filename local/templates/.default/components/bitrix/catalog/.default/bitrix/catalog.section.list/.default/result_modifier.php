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

global $USER_FIELD_MANAGER;

if (is_array($arParams["IMAGE_SIZE"])) {
    //кеширование изображений
    foreach ($arResult["SECTIONS"] as &$arSection) {
        if (is_array($arSection["PICTURE"])) {
            $thumb = \CFile::ResizeImageGet(
                $arSection["PICTURE"],
                ["width" => $arParams["IMAGE_SIZE"]["WIDTH"], "height" => $arParams["IMAGE_SIZE"]["HEIGHT"]],
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );
            if ($thumb["src"]) {
                $arSection["PICTURE"]["SAFE_SRC"] = $thumb["src"];
            }
        }
    }
    unset($arSection);
    //end
}

//избавляемся от разделов 1ого уровня
$newSections = [];
foreach ($arResult["SECTIONS"] as $arSection) {
    if ($arSection["DEPTH_LEVEL"] > 1) continue;
    //пользовательские свойства
    $arFields = $USER_FIELD_MANAGER->GetUserFields("IBLOCK_" . $arParams["IBLOCK_ID"] . "_SECTION", $arSection["ID"]);
    if (is_array($arFields)) {
        $arSection = array_merge($arSection, $arFields);
    }
    //end
    $newSections[$arSection["ID"]] = $arSection;
}
foreach ($arResult["SECTIONS"] as $key => $arSection) {
    if ($arSection["DEPTH_LEVEL"] > 1 && $arSection["IBLOCK_SECTION_ID"]) {
        $newSections[$arSection["IBLOCK_SECTION_ID"]]["CHILD_SECTIONS"][] = $arSection;
    }
}
foreach ($newSections as $key => $section) {
    if (!is_array($section["CHILD_SECTIONS"])) {
        unset($newSections[$key]);
    }
}

$arResult["SECTIONS"] = $newSections;
$arResult["SECTIONS_COUNT"] = count($newSections);
//end

$cp = $this->__component;
if (is_object($cp)) {
    $cp->SetResultCacheKeys(["SECTIONS"]);
}
