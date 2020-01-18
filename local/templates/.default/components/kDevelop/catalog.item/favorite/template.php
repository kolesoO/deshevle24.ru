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

$arPrice = $arResult["OFFER"]["ITEM_PRICES"][$arResult["OFFER"]["ITEM_PRICE_SELECTED"]];

//параметры для js
$jsParams = [
    "OFFER_ID" => $arResult["OFFER"]["ID"],
    "ITEM_ID" => $arResult["ITEM"]["ID"]
];
if ($arParams['DISPLAY_COMPARE']) {
    $jsParams['compare'] = [
        'COMPARE_PATH' => $arParams['COMPARE_PATH']
    ];
}
//end
?>

<div class="catalog_item-block">&nbsp;</div>
<a
        href="<?=$arResult["OFFER"]["DETAIL_PAGE_URL"]?>"
        class="catalog_item-block catalog_item-img"
        style="background-image: url('<?=(is_array($arResult["OFFER"]["PREVIEW_PICTURE"]) ? $arResult["OFFER"]["PREVIEW_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH."/images/no-image.png")?>')"
>
    <?if (strlen($arResult["OFFER"]["PROPERTIES"]["label"]["VALUE"]) > 0) :?>
        <div class="sale_label upper"><?=$arResult["OFFER"]["PROPERTIES"]["label"]["VALUE"]?></div>
    <?endif?>
</a>
<div class="catalog_item-block">
    <?if (isset($arResult["ITEM"]["PARENT_SECTION"])) :?>
        <small><?=$arResult["ITEM"]["PARENT_SECTION"]["NAME"]?></small>
    <?endif?>
    <div class="title-5 light">
        <a href="<?=$arResult["OFFER"]["DETAIL_PAGE_URL"]?>"><?=$arResult["OFFER"]["NAME"]?></a>
    </div>
</div>
<?if ($arPrice["PRICE"] > 0) :?>
    <div class="catalog_item-block">
        <div>Цена</div>
        <div flex-align="center" flex-wrap="wrap">
            <?if ($arPrice["PERCENT"] > 0) :?>
                <div class="catalog_item-price old_price">
                    <s><?=number_format($arPrice["DISCOUNT"], 0, '.', ' ')?></s>
                </div>
                <div class="sale_label inline">-<?=$arPrice['PERCENT']?>%</div>
            <?endif?>
            <div class="catalog_item-price"><?=$arPrice["PRINT_RATIO_PRICE"]?></div>
        </div>
    </div>
<?endif?>
<div class="catalog_item-hover">
    <div class="catalog_item-block" flex-align="center" flex-text_align="space-between">
        <?if ($arParams["HIDE_FAST_PRODUCT"] != "Y") :?>
            <a
                href="#"
                data-popup-open="#fast-product"
                onclick="obAjax.getFastProduct('<?=$arResult["ITEM"]["ID"]?>', '<?=$arResult["OFFER"]['ID']?>')"
                flex-align="center"
                class="icon_text"
            >
                <i class="icon icon-search"></i>
                <span>Быстрый просмотр</span>
            </a>
        <?else:?>
            <span>&nbsp;</span>
        <?endif?>
        <a
                href="#"
                class="grey_link"
                onclick="obAjax.deleteFromFavorite('<?=$arResult["OFFER"]["ID"]?>', '<?=$arResult['WRAP_ID']?>', event)">
            <i class="icon icon-close"></i>
        </a>
    </div>
    <a
        href="<?=$arResult["OFFER"]["DETAIL_PAGE_URL"]?>"
        class="catalog_item-block catalog_item-img"
        style="background-image: url('<?=(is_array($arResult["OFFER"]["PREVIEW_PICTURE"]) ? $arResult["OFFER"]["PREVIEW_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH."/images/no-image.png")?>')"
    >
        <?if (strlen($arResult["OFFER"]["PROPERTIES"]["label"]["VALUE"]) > 0) :?>
            <div class="sale_label upper"><?=$arResult["OFFER"]["PROPERTIES"]["label"]["VALUE"]?></div>
        <?endif?>
    </a>
    <div class="catalog_item-block">
        <?if (isset($arResult["ITEM"]["PARENT_SECTION"])) :?>
            <small><?=$arResult["ITEM"]["PARENT_SECTION"]["NAME"]?></small>
        <?endif?>
        <div class="title-5 light">
            <a href="<?=$arResult["OFFER"]["DETAIL_PAGE_URL"]?>"><?=$arResult["OFFER"]["NAME"]?></a>
        </div>
    </div>
    <?if ($arPrice["PRICE"] > 0) :?>
        <div class="catalog_item-block">
            <div>Цена</div>
            <div flex-align="center" flex-wrap="wrap">
                <?if ($arPrice["PERCENT"] > 0) :?>
                    <div class="catalog_item-price old_price">
                        <s><?=number_format($arPrice["DISCOUNT"], 0, '.', ' ')?></s>
                    </div>
                    <div class="sale_label inline">-<?=$arPrice['PERCENT']?>%</div>
                <?endif?>
                <div class="catalog_item-price"><?=$arPrice["PRINT_RATIO_PRICE"]?></div>
            </div>
        </div>
    <?endif?>
</div>
