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
                $arSection["PICTURE"]["SRC"] = $thumb["src"];
            }
        }
    }
    unset($arSection);
    //end
}

//пользовательские свойства
if (is_array($arResult["SECTION"])){
    $arFields = $USER_FIELD_MANAGER->GetUserFields("IBLOCK_" . $arParams["IBLOCK_ID"] . "_SECTION", $arResult["SECTION"]["ID"]);
    if (is_array($arFields)) {
        $arResult["SECTION"] = array_merge($arResult["SECTION"], $arFields);
    }
}
foreach ($arResult["SECTIONS"] as &$section) {
    $arFields = $USER_FIELD_MANAGER->GetUserFields("IBLOCK_" . $arParams["IBLOCK_ID"] . "_SECTION", $section["ID"]);
    if (is_array($arFields)) {
        $section = array_merge($section, $arFields);
    }
}
unset($section);
//end
