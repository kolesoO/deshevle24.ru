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

$rootSectionKey = 0;
$sectionKeyIdRelations = [];

foreach ($arResult["SECTIONS"] as $key => $arSection) {
    $arResult["SECTIONS"][$key]["NAME"] = $arSection["UF_SECTION_LABEL"] ? $arSection["UF_SECTION_LABEL"] : $arSection["NAME"];
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
    $sectionKeyIdRelations[$arSection["ID"]] = $key;
}

//подразделы
$rsSection = CIBlockSection::GetList(
    [],
    [
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ACTIVE" => "Y",
        "SECTION_ID" => array_column($arResult["SECTIONS"], "ID")
    ],
    false,
    ["ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "UF_*", "NAME", "SECTION_PAGE_URL"]
);
while ($section = $rsSection->fetch()) {
    $section["NAME"] = $section["UF_SECTION_LABEL"] ? $section["UF_SECTION_LABEL"] : $section["NAME"];
    $arResult["SECTIONS"][] = $section;
    if (isset($sectionKeyIdRelations[$section["IBLOCK_SECTION_ID"]])) {
        $arResult["SECTIONS"][$sectionKeyIdRelations[$section["IBLOCK_SECTION_ID"]]]["CHILD_SECTIONS"][] = count($arResult["SECTIONS"]) - 1;
    }
}
//end

$cp = $this->__component;
if (is_object($cp)) {
    $cp->SetResultCacheKeys(["SECTIONS"]);
}
