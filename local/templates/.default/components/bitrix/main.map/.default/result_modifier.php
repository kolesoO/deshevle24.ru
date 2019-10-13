<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$newItems = [];
foreach ($arResult["arMap"] as $index => $arItem) {
    $newItems[] = $arItem;
    if ($arItem["FULL_PATH"] == "/catalog/") {
        $rsSections = \CIBlockSection::GetTreeList(
            ["IBLOCK_ID" => IBLOCK_CATALOG_CATALOG, "ACTIVE" => "Y"],
            ["ID", "NAME", "SECTION_PAGE_URL", "DEPTH_LEVEL"]
        );
        while ($section = $rsSections->GetNext()) {
            $newItems[] = [
                "FULL_PATH" => $section["SECTION_PAGE_URL"],
                "NAME" => $section["NAME"],
                "LEVEL" => $section["DEPTH_LEVEL"] + 1
            ];
        }
    }
}
$arResult["arMap"] = $newItems;