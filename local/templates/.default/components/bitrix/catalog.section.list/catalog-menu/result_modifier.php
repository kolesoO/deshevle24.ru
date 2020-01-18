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

$sectionKeyIdRelations = [];

foreach ($arResult["SECTIONS"] as $key => $arSection) {
    $sectionKeyIdRelations[$arSection["ID"]] = $key;
}

//подразделы
$sectionId = [];
$rsSection = CIBlockSection::GetList(
    [],
    [
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ACTIVE" => "Y",
        "SECTION_ID" => array_column($arResult["SECTIONS"], "ID")
    ],
    $arParams["COUNT_ELEMENTS"],
    ["ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "UF_*", "NAME", "CODE", "SECTION_PAGE_URL", "PICTURE"]
);
while ($section = $rsSection->GetNext()) {
    $sectionId[] = $section["ID"];
    $section["NAME"] = $section["UF_SECTION_LABEL"] ? $section["UF_SECTION_LABEL"] : $section["NAME"];
    $section["PICTURE"] = CFile::GetFileArray($section["PICTURE"]);
    $arResult["SECTIONS"][] = $section;
    if (isset($sectionKeyIdRelations[$section["IBLOCK_SECTION_ID"]])) {
        $arResult["SECTIONS"][$sectionKeyIdRelations[$section["IBLOCK_SECTION_ID"]]]["CHILD_SECTIONS"][] = count($arResult["SECTIONS"]) - 1;
        //TODO: убрать
        $rsSectionInner = CIBlockSection::GetList(
            [],
            [
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ACTIVE" => "Y",
                "SECTION_ID" => $section["ID"]
            ],
            $arParams["COUNT_ELEMENTS"],
            ["ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "UF_*", "NAME", "SECTION_PAGE_URL", "PICTURE"]
        );
        while ($sectionInner = $rsSectionInner->GetNext()) {
            $sectionInner["NAME"] = $sectionInner["UF_SECTION_LABEL"] ? $sectionInner["UF_SECTION_LABEL"] : $sectionInner["NAME"];
            $sectionInner["PICTURE"] = CFile::GetFileArray($sectionInner["PICTURE"]);
            $arResult["SECTIONS"][] = $sectionInner;
            if (isset($sectionKeyIdRelations[$section["IBLOCK_SECTION_ID"]])) {
                $arResult["SECTIONS"][$sectionKeyIdRelations[$section["IBLOCK_SECTION_ID"]]]["CHILD_SECTIONS"][] = count($arResult["SECTIONS"]) - 1;
            }
        }
        //end
    }
}
//end

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
}

$cp = $this->__component;
if (is_object($cp)) {
    $cp->SetResultCacheKeys(["SECTIONS"]);
}
