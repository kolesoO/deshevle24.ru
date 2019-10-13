<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogProductsViewedComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
?>

<?if ($arResult["ITEMS_COUNT"] > 0) :?>
    <section class="section">
        <div class="container">
            <?if (strlen($arParams["SECTION_TITLE"]) > 0) :?>
                <div class="title-2"><?=$arParams["SECTION_TITLE"]?></div>
            <?endif?>
            <?if (strlen($arParams["INCLUDE_AREA_PATH"]) > 0) :?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    [
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . $arParams["INCLUDE_AREA_PATH"]
                    ],
                    false
                );?>
            <?endif?>
            <div
                    class="catalog_slider js-slider clearfix"
                    data-autoplay="false"
                    data-autoplaySpeed="5000"
                    data-infinite="false"
                    data-speed="1000"
                    data-arrows="true"
                    data-dots="false"
                    data-slidesToShow="<?=$arParams["LINE_ELEMENT_COUNT"]?>"
            >
                <?foreach ($arResult["ITEMS"] as $arItem) :
                    if ($arResult["SET_AREA"]) {
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    }
                    ?>
                    <div id="catalog-item-<?=$arItem["ID"]?>" class="catalog_item">
                        <?$APPLICATION->IncludeComponent(
                            "kDevelop:catalog.item",
                            $arResult["INNER_TEMPLATE"],
                            [
                                "RESULT" => [
                                    "ITEM" => $arItem,
                                    "OFFER_KEY" => $arItem["OFFER_ID_SELECTED"],
                                    "OFFERS_LIST" => $arItem["OFFERS"],
                                    "WRAP_ID" => "catalog-item-".$arItem["ID"],
                                    "AREA_ID" => ($arResult["SET_AREA"] ? $this->GetEditAreaId($arItem["ID"]) : null)
                                ],
                                "PARAMS" => $arParams,
                                "PRICES" => $arResult["PRICES"]
                            ],
                            null,
                            ['HIDE_ICONS' => 'Y']
                        );?>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </section>
<?endif?>