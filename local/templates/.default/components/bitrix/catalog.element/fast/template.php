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
    <div class="product_preview-img col-lg-13" flex-align="stretch" flex-wrap="wrap">
        <?if (is_array($arResult["PROPERTIES"]["img_gallery"]["VALUE"]) && count($arResult["PROPERTIES"]["img_gallery"]["VALUE"]) > 0) :?>
            <div class="product_preview-nav col-lg-4">
                <?foreach ($arResult["PROPERTIES"]["img_gallery"]["VALUE"] as $arFileInfo) :?>
                    <a href="#" class="product_preview-nav-item" style="background-image: url('<?=$arFileInfo["thumb"]?>')"></a>
                <?endforeach;?>
            </div>
            <div class="product_preview-img_big col-lg-20">
                <?foreach ($arResult["PROPERTIES"]["img_gallery"]["VALUE"] as $arFileInfo) :?>
                    <div class="product_preview-img_big-item" style="background-image: url('<?=$arFileInfo["origin"]?>')"></div>
                <?endforeach?>
            </div>
        <?else:?>
            <div
                    class="product_preview-img_big-item"
                    style="background-image: url('<?=is_array($arOffer["DETAIL_PICTURE"]) ? $arOffer["DETAIL_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH."/images/no-image.png"?>')"
            ></div>
        <?endif?>
    </div>
    <div class="product_preview-description col-lg-11">
        <div class="catalog_item-block" flex-align="start" flex-text_align="space-between">
            <div class="btn mark grey_full col-lg-11" align="center">
                <i class="icon icon-star"></i>
                <i class="icon icon-star"></i>
                <i class="icon icon-star"></i>
                <i class="icon icon-star"></i>
                <i class="icon icon-star"></i>
                <span>(0)</span>
            </div>
            <a href="#" class="btn grey_full col-lg-11" align="center" data-entity="favorite" data-id="<?=$arResult["ID"]?>">
                <i class="icon icon-favorite"></i>
                <span>Мне нравится</span>
            </a>
        </div>
        <div class="catalog_item-block">
            <?if (isset($arResult["PARENT_SECTION"])) :?>
                <small><?=$arResult["PARENT_SECTION"]["NAME"]?></small>
            <?endif?>
            <div><?=$arResult["NAME"]?></div>
        </div>
        <?if ($arOffer["CAN_BUY"]) :?>
            <div class="catalog_item-block">
                <small>Цена</small>
                <div class="catalog_item-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
            </div>
        <?endif?>
        <div class="catalog_item-block">
            <small>Цвет</small>
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
        </div>
        <div class="catalog_item-block">
            <div class="title-5 light">Размеры</div>
            <div flex-align="start" flex-wrap="wrap">
                <div class="catalog_item-footer-part">
                    <small>длина</small>
                    <span>200 см</span>
                </div>
                <div class="catalog_item-footer-part">
                    <small>ширина</small>
                    <span>96 см</span>
                </div>
                <div class="catalog_item-footer-part">
                    <small>высота</small>
                    <span>96 см</span>
                </div>
            </div>
        </div>
        <div class="catalog_item-block">
            <div class="title-5 light">Спальное место</div>
            <div flex-align="start" flex-wrap="wrap">
                <div class="catalog_item-footer-part">
                    <small>длина</small>
                    <span>200 см</span>
                </div>
                <div class="catalog_item-footer-part">
                    <small>ширина</small>
                    <span>96 см</span>
                </div>
                <div class="catalog_item-footer-part">
                    <small>высота</small>
                    <span>96 см</span>
                </div>
            </div>
        </div>
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
