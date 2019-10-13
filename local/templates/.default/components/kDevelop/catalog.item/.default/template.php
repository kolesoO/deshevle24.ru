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

$arPrice = $arResult["OFFER"]["PRICES"][$arParams["PRICE_CODE"][0]];
?>

<div class="catalog_item-block catalog_item-header" flex-align="center" flex-text_align="space-between">
    <?if ($arParams["HIDE_FAST_PRODUCT"] != "Y") :?>
        <a href="#" data-popup-open="#fast-product" onclick="obAjax.getFastProduct('<?=$arResult["OFFER"]["ID"]?>')">
            <i class="icon icon-search"></i>
            <span>Быстрый просмотр</span>
        </a>
    <?else:?>
        <span>&nbsp;</span>
    <?endif?>
    <a href="#">
        <i class="icon icon-favorite"></i>
    </a>
</div>
<a
        href="<?=$arResult["OFFER"]["DETAIL_PAGE_URL"]?>"
        class="catalog_item-block catalog_item-img"
        style="background-image: url('<?=(is_array($arResult["OFFER"]["PREVIEW_PICTURE"]) ? $arResult["OFFER"]["PREVIEW_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH."/images/no-image.png")?>')"
></a>
<div class="catalog_item-block">
    <?if (isset($arResult["ITEM"]["PARENT_SECTION"])) :?>
        <small><?=$arResult["ITEM"]["PARENT_SECTION"]["NAME"]?></small>
    <?endif?>
    <a href="#"><?=$arResult["OFFER"]["NAME"]?></a>
</div>
<?if ($arPrice["PRICE"] > 0) :?>
    <div class="catalog_item-block">
        <div>Цена</div>
        <div class="catalog_item-price"><?=$arPrice["PRINT_RATIO_PRICE"]?></div>
    </div>
<?endif?>
<div class="catalog_item-footer">
    <?if (
        (isset($arResult["OFFER"]["PROPERTIES"]["size_length"]) && strlen($arResult["OFFER"]["PROPERTIES"]["size_length"]["VALUE"]) > 0) &&
        (isset($arResult["OFFER"]["PROPERTIES"]["size_width"]) && strlen($arResult["OFFER"]["PROPERTIES"]["size_width"]["VALUE"]) > 0) &&
        (isset($arResult["OFFER"]["PROPERTIES"]["size_height"]) && strlen($arResult["OFFER"]["PROPERTIES"]["size_height"]["VALUE"]) > 0)
    ) :?>
        <div class="catalog_item-block">
            <div>Размеры</div>
            <div flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
                <div class="col-lg-8">
                    <small>длина</small>
                    <span><?=$arResult["OFFER"]["PROPERTIES"]["size_length"]["VALUE"]?> см</span>
                </div>
                <div class="col-lg-8">
                    <small>ширина</small>
                    <span><?=$arResult["OFFER"]["PROPERTIES"]["size_width"]["VALUE"]?> см</span>
                </div>
                <div class="col-lg-8">
                    <small>высота</small>
                    <span><?=$arResult["OFFER"]["PROPERTIES"]["size_height"]["VALUE"]?> см</span>
                </div>
            </div>
        </div>
    <?endif?>
    <?if (
        (isset($arResult["OFFER"]["PROPERTIES"]["sleep_size_length"]) && strlen($arResult["OFFER"]["PROPERTIES"]["sleep_size_length"]["VALUE"]) > 0) &&
        (isset($arResult["OFFER"]["PROPERTIES"]["sleep_size_width"]) && strlen($arResult["OFFER"]["PROPERTIES"]["sleep_size_width"]["VALUE"]) > 0) &&
        (isset($arResult["OFFER"]["PROPERTIES"]["sleep_size_height"]) && strlen($arResult["OFFER"]["PROPERTIES"]["sleep_size_height"]["VALUE"]) > 0)
    ) :?>
        <div class="catalog_item-block">
            <div>Спальное место</div>
            <div flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
                <div class="col-lg-8">
                    <small>длина</small>
                    <span><?=$arResult["OFFER"]["PROPERTIES"]["sleep_size_length"]["VALUE"]?> см</span>
                </div>
                <div class="col-lg-8">
                    <small>ширина</small>
                    <span><?=$arResult["OFFER"]["PROPERTIES"]["sleep_size_width"]["VALUE"]?> см</span>
                </div>
                <div class="col-lg-8">
                    <small>высота</small>
                    <span><?=$arResult["OFFER"]["PROPERTIES"]["sleep_size_height"]["VALUE"]?> см</span>
                </div>
            </div>
        </div>
    <?endif?>
    <?if ($arResult["OFFER"]["CAN_BUY"]) :?>
        <a
                href="#"
                class="btn color upper btn-arrow col-lg-24"
                align="center"
                onclick="obAjax.addToBasket('<?=$arResult["OFFER"]["ID"]?>', '<?=$arPrice["PRICE_ID"]?>', event)"
        >
            <span><?=$arParams["MESS_BTN_ADD_TO_BASKET"]?></span>
            <i class="icon icon-arrow"></i>
        </a>
    <?endif?>
</div>