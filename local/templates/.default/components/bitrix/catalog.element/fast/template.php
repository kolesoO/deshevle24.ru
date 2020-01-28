<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$offerSlidesToShow = 8;
$arOffer = $arResult["OFFERS"][$arResult["OFFER_ID_SELECTED"]];
if (!$arOffer) {
    $arOffer = $arResult;
}
$arPrice = $arOffer["PRICES"][$arParams["PRICE_CODE"][0]];

//параметры для js
$jsParams = [
    "OFFER_ID" => $arOffer["ID"]
];
if ($arParams['DISPLAY_COMPARE']) {
    $jsParams['compare'] = array(
        'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
        'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
        'COMPARE_PATH' => $arParams['COMPARE_PATH']
    );
}
//end
?>

<div class="product_preview" flex-align="stretch" flex-wrap="wrap">
    <div class="product_preview-img col-lg-14" flex-align="stretch" flex-wrap="wrap">
        <?if (is_array($arResult["PROPERTIES"]["img_gallery"]["VALUE"]) && count($arResult["PROPERTIES"]["img_gallery"]["VALUE"]) > 0) :?>
            <div
                    class="product_preview-img_big js-slider col-lg-24"
                    data-autoplay="false"
                    data-speed="1000"
                    data-arrows="false"
                    data-dots="false"
                    data-asNavFor=".product_preview-nav"
            >
                <?foreach ($arResult["PROPERTIES"]["img_gallery"]["VALUE"] as $arFileInfo) :?>
                    <div class="product_preview-img_big-item" style="background-image: url('<?=$arFileInfo["origin"]?>')"></div>
                <?endforeach?>
            </div>
            <div
                    class="product_preview-nav js-slider col-lg-24 hidden-xs"
                    data-slidesToShow="5"
                    data-autoplay="false"
                    data-speed="1000"
                    data-arrows="true"
                    data-dots="false"
                    data-asNavFor=".product_preview-img_big"
                    data-focusOnSelect="true"
                    data-centerMode="false"
            >
                <?foreach ($arResult["PROPERTIES"]["img_gallery"]["VALUE"] as $arFileInfo) :?>
                    <a href="#" class="product_preview-nav-item" style="background-image: url('<?=$arFileInfo["thumb"]?>')"></a>
                <?endforeach;?>
            </div>
        <?else:?>
            <div
                    class="product_preview-img_big-item col-lg-24"
                    style="background-image: url('<?=is_array($arOffer["DETAIL_PICTURE"]) ? $arOffer["DETAIL_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH."/images/no-image.png"?>')"
            ></div>
        <?endif?>
    </div>
    <div class="product_preview-description col-lg-10">
        <div class="catalog_item-block" flex-align="start" flex-text_align="space-between">
            <?if (isset($arParams['RATING_VALUE']) && strlen($arParams['RATING_VALUE']) > 0) :?>
                <div class="btn grey_white col-lg-11" align="center">
                    <?=htmlspecialcharsback($arParams['RATING_HTML'])?>
                    <?if (isset($arParams['RATING_VALUE']) && strlen($arParams['RATING_VALUE']) > 0) :?>
                        <span>(<?=$arParams['RATING_VALUE']?>)</span>
                    <?endif?>
                </div>
            <?endif?>
            <?if ($arParams['FAVORITE_STATUS']) :?>
                <a
                        href="#"
                        class="btn grey_white col-lg-11"
                        align="center"
                        data-popup-open="#favorite-list"
                        onclick="obAjax.getFavoriteList('favorites')"
                >
                    <i class="icon icon-favorite-full"></i>
                    <span>Мне нравится</span>
                </a>
            <?else:?>
                <a
                        href="#"
                        class="btn grey_white col-lg-11"
                        align="center"
                        data-entity="favorite"
                        data-id="<?=$arOffer["ID"]?>"
                        data-text
                >
                    <i class="icon icon-favorite opacity"></i>
                    <span>Мне нравится</span>
                </a>
            <?endif?>
        </div>
        <div class="catalog_item-block">
            <?if (isset($arResult["PARENT_SECTION"])) :?>
                <div flex-align="start" flex-wrap="wrap">
                    <div class="light_grey_link"><?=$arResult["PARENT_SECTION"]["NAME"]?></div>
                    <?if (strlen($arOffer['PROPERTIES']['label']['VALUE']) > 0) :?>
                        <div class="sale_label upper inline"><?=$arOffer['PROPERTIES']['label']['VALUE']?></div>
                    <?endif?>
                </div>
            <?endif?>
            <div class="title-2 light"><?=$arResult["NAME"]?></div>
        </div>
        <?if ($arOffer["CAN_BUY"]) :?>
            <div class="catalog_item-block">
                <div class="light_grey_link">Цена</div>
                <div flex-align="center" flex-wrap="wrap">
                    <?if ($arPrice["DISCOUNT_DIFF_PERCENT"] > 0) :?>
                        <div class="catalog_item-price old_price">
                            <s><?=number_format($arPrice["VALUE"], 0, '.', ' ')?></s>
                        </div>
                        <div class="sale_label inline">-<?=$arPrice['DISCOUNT_DIFF_PERCENT']?>%</div>
                    <?endif?>
                    <div class="catalog_item-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
                </div>
            </div>
        <?endif?>
        <!--div class="catalog_item-block">
            <div class="light_grey_link">Цвет</div>
            <div class="catalog_color" flex-align="start" flex-wrap="wrap">
                <a href="#" class="catalog_color-item" flex-align="center">
                    <span class="catalog_color-color" style="background-color: #ff9901"></span>
                    <span>Оранжевый</span>
                </a>
                <a href="#" class="catalog_color-item" flex-align="center">
                    <span class="catalog_color-color" style="background-color: blue"></span>
                    <span>Синий</span>
                </a>
            </div>
        </div-->
        <?if (
            (isset($arOffer["PROPERTIES"]["size_length"]) && strlen($arOffer["PROPERTIES"]["size_length"]["VALUE"]) > 0) &&
            (isset($arOffer["PROPERTIES"]["size_width"]) && strlen($arOffer["PROPERTIES"]["size_width"]["VALUE"]) > 0) &&
            (isset($arOffer["PROPERTIES"]["size_height"]) && strlen($arOffer["PROPERTIES"]["size_height"]["VALUE"]) > 0)
        ) :?>
            <div class="catalog_item-block">
                <div class="title-5 light">Размеры</div>
                <div flex-align="start" flex-wrap="wrap">
                    <div class="catalog_item-footer-part">
                        <small>длина</small>
                        <span><?=$arOffer["PROPERTIES"]["size_length"]["VALUE"]?> см</span>
                    </div>
                    <div class="catalog_item-footer-part">
                        <small>ширина</small>
                        <span><?=$arOffer["PROPERTIES"]["size_width"]["VALUE"]?> см</span>
                    </div>
                    <div class="catalog_item-footer-part">
                        <small>высота</small>
                        <span><?=$arOffer["PROPERTIES"]["size_height"]["VALUE"]?> см</span>
                    </div>
                </div>
            </div>
        <?endif?>
        <?if (
            (isset($arOffer["PROPERTIES"]["sleep_size_length"]) && strlen($arOffer["PROPERTIES"]["sleep_size_length"]["VALUE"]) > 0) &&
            (isset($arOffer["PROPERTIES"]["sleep_size_width"]) && strlen($arOffer["PROPERTIES"]["sleep_size_width"]["VALUE"]) > 0) &&
            (isset($arOffer["PROPERTIES"]["sleep_size_height"]) && strlen($arOffer["PROPERTIES"]["sleep_size_height"]["VALUE"]) > 0)
        ) :?>
            <div class="catalog_item-block">
                <div class="title-5 light">Спальное место</div>
                <div flex-align="start" flex-wrap="wrap">
                    <div class="catalog_item-footer-part">
                        <small>длина</small>
                        <span><?=$arOffer["PROPERTIES"]["sleep_size_length"]["VALUE"]?> см</span>
                    </div>
                    <div class="catalog_item-footer-part">
                        <small>ширина</small>
                        <span><?=$arOffer["PROPERTIES"]["sleep_size_width"]["VALUE"]?> см</span>
                    </div>
                    <div class="catalog_item-footer-part">
                        <small>высота</small>
                        <span><?=$arOffer["PROPERTIES"]["sleep_size_height"]["VALUE"]?> см</span>
                    </div>
                </div>
            </div>
        <?endif?>
        <div flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
            <a href="<?=$arOffer["DETAIL_PAGE_URL"]?>" class="btn col-lg-11" align="center">Узнать больше</a>
            <a
                    href="#"
                    class="btn color col-lg-11"
                    align="center"
                    onclick="obAjax.addToBasket('<?=$arOffer["ID"]?>', '<?=$arPrice["PRICE_ID"]?>', event)"
            ><?=$arParams["MESS_BTN_ADD_TO_BASKET"]?></a>
        </div>
    </div>
</div>
