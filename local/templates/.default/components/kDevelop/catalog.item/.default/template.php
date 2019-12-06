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
?>
<div class="catalog_item-block">&nbsp;</div>
<a
        href="<?=$arResult["OFFER"]["DETAIL_PAGE_URL"]?>"
        class="catalog_item-block catalog_item-img"
        style="background-image: url('<?=(is_array($arResult["OFFER"]["PREVIEW_PICTURE"]) ? $arResult["OFFER"]["PREVIEW_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH."/images/no-image.png")?>')"
>
    <?if (strlen($arResult["OFFER"]["PROPERTIES"]["label"]["VALUE"]) > 0) :?>
        <div class="sale_label">-<?=$arResult["OFFER"]["PROPERTIES"]["label"]["VALUE"]?></div>
    <?endif?>
</a>
<div class="catalog_item-block">
    <?if (isset($arResult["ITEM"]["PARENT_SECTION"])) :?>
        <small><?=$arResult["ITEM"]["PARENT_SECTION"]["NAME"]?></small>
    <?endif?>
    <a href="<?=$arResult["OFFER"]["DETAIL_PAGE_URL"]?>"><?=$arResult["OFFER"]["NAME"]?></a>
</div>
<?if ($arPrice["PRICE"] > 0) :?>
    <div class="catalog_item-block">
        <div>Цена</div>
        <div class="catalog_item-price"><?=$arPrice["PRINT_RATIO_PRICE"]?></div>
    </div>
<?endif?>

<div class="catalog_item-hover">
    <div class="catalog_item-block" flex-align="center" flex-text_align="space-between">
        <?if ($arParams["HIDE_FAST_PRODUCT"] != "Y") :?>
            <a
                    href="#"
                    data-popup-open="#fast-product"
                    onclick="obAjax.getFastProduct('<?=$arResult["ITEM"]["ID"]?>')"
                    flex-align="center"
                    class="icon_text"
            >
                <i class="icon icon-search"></i>
                <span>Быстрый просмотр</span>
            </a>
        <?else:?>
            <span>&nbsp;</span>
        <?endif?>
        <a href="#" class="pseudo_link">
            <i class="icon icon-like"></i>
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
        <a href="<?=$arResult["OFFER"]["DETAIL_PAGE_URL"]?>"><?=$arResult["OFFER"]["NAME"]?></a>
    </div>
    <?if ($arPrice["PRICE"] > 0) :?>
        <div class="catalog_item-block">
            <div>Цена</div>
            <div flex-align="center" flex-wrap="wrap">
                <?if ($arPrice["PERCENT"] > 0) :?>
                    <div class="catalog_item-price old_price">
                        <s><?=number_format($arPrice["DISCOUNT"], 0, '.', ' ')?></s>
                    </div>
                    <div class="sale_label upper">-<?=$arPrice['PERCENT']?>%</div>
                <?endif?>
                <div class="catalog_item-price"><?=$arPrice["PRINT_RATIO_PRICE"]?></div>
            </div>
        </div>
    <?endif?>
    <?if (
        (isset($arResult["OFFER"]["PROPERTIES"]["size_length"]) && strlen($arResult["OFFER"]["PROPERTIES"]["size_length"]["VALUE"]) > 0) &&
        (isset($arResult["OFFER"]["PROPERTIES"]["size_width"]) && strlen($arResult["OFFER"]["PROPERTIES"]["size_width"]["VALUE"]) > 0) &&
        (isset($arResult["OFFER"]["PROPERTIES"]["size_height"]) && strlen($arResult["OFFER"]["PROPERTIES"]["size_height"]["VALUE"]) > 0)
    ) :?>
        <div class="catalog_item-block">
            <div>Размеры</div>
            <div flex-align="start" flex-wrap="wrap">
                <div class="catalog_item-footer-part">
                    <small>длина</small>
                    <span><?=$arResult["OFFER"]["PROPERTIES"]["size_length"]["VALUE"]?> см</span>
                </div>
                <div class="catalog_item-footer-part">
                    <small>ширина</small>
                    <span><?=$arResult["OFFER"]["PROPERTIES"]["size_width"]["VALUE"]?> см</span>
                </div>
                <div class="catalog_item-footer-part">
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
            <div flex-align="start" flex-wrap="wrap">
                <div class="catalog_item-footer-part">
                    <small>длина</small>
                    <span><?=$arResult["OFFER"]["PROPERTIES"]["sleep_size_length"]["VALUE"]?> см</span>
                </div>
                <div class="catalog_item-footer-part">
                    <small>ширина</small>
                    <span><?=$arResult["OFFER"]["PROPERTIES"]["sleep_size_width"]["VALUE"]?> см</span>
                </div>
                <div class="catalog_item-footer-part">
                    <small>высота</small>
                    <span><?=$arResult["OFFER"]["PROPERTIES"]["sleep_size_height"]["VALUE"]?> см</span>
                </div>
            </div>
        </div>
    <?endif?>
    <?if ($arResult["OFFER"]["CAN_BUY"]) :?>
        <a
                href="#"
                class="btn color btn-arrow col-lg-24"
                align="center"
                onclick="obAjax.addToBasket('<?=$arResult["OFFER"]["ID"]?>', '<?=$arPrice["PRICE_TYPE_ID"]?>', event)"
        >
            <span><?=$arParams["MESS_BTN_ADD_TO_BASKET"]?></span>
            <i class="icon icon-arrow"></i>
        </a>
    <?endif?>
</div>
