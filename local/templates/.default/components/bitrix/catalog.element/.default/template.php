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
    "OFFER_ID" => $arOffer["ID"],
    "ITEM_ID" => $arResult['ID']
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

<section>
    <div class="container">
        <div flex-align="center" flex-text_align="space-between" flex-wrap="wrap">
            <div class="col-lg-8 col-md-24">
                <div flex-align="center" flex-wrap="wrap" flex-text_align="start">
                    <div class="title-3 medium"><?=isset($arResult["IPROP_VALUES"]["ELEMENT_PAGE_TITLE"]) ? $arResult["IPROP_VALUES"]["ELEMENT_PAGE_TITLE"] : $arOffer["NAME"]?></div>
                    <?if ($arOffer["CAN_BUY"]) :?>
                        <div class="catalog_label catalog_label-detail title-3 light" align="center"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
                    <?endif?>
                </div>
            </div>
            <div class="btn_list col-lg-16 col-md-24 col-xs-24" flex-align="center" flex-text_align="end" flex-wrap="wrap">
                <div class="btn_list-block">
                    <div class="btn grey_white col-xs-24">
                        <?=\kDevelop\Content\Reviews::getMarkeredHtmlStars($arOffer['ID'])?>
                        <span>(<?=\kDevelop\Content\Reviews::getMarkeredRating($arOffer['ID'])?>)</span>
                    </div>
                    <a href="#" class="btn grey_white col-xs-24" align="center" data-entity="favorite" data-id="<?=$arOffer["ID"]?>">
                        <i class="icon icon-like opacity"></i>
                        <span>Мне нравится</span>
                    </a>
                </div>
                <?if ($arOffer["CAN_BUY"]) :?>
                    <div class="btn_list-block">
                        <a
                                href="#"
                                class="btn col-xs-24"
                                align="center"
                                data-popup-open="#buy-one-click"
                        >Купить в 1 клик</a>
                        <a
                                href="#"
                                class="btn color col-xs-24"
                                align="center"
                                onclick="obAjax.addToBasket('<?=$arOffer["ID"]?>', '<?=$arPrice["PRICE_ID"]?>', event)"
                        ><?=$arParams["MESS_BTN_ADD_TO_BASKET"]?></a>
                    </div>
                <?endif?>
            </div>
        </div>
        <div class="catalog_detail">
            <div class="product_preview-img col-lg-24 col-md-24 col-xs-24" flex-align="stretch" flex-wrap="wrap" flex-text_align="space-between">
                <?if (is_array($arResult["PROPERTIES"]["img_gallery"]["VALUE"]) && count($arResult["PROPERTIES"]["img_gallery"]["VALUE"]) > 0) :?>
                    <div
                            class="product_preview-img_big js-slider col-lg-24"
                            data-autoplay="false"
                            data-speed="1000"
                            data-arrows="false"
                            data-dots="false"
                            data-asNavFor=".product_preview-nav"
                    >
                        <?foreach ($arResult["PROPERTIES"]["img_gallery"]["VALUE"] as $key => $arFileInfo) :?>
                            <div class="product_preview-img_big-item" style="background-image: url('<?=$arFileInfo["origin"]?>')"></div>
                        <?endforeach;?>
                    </div>
                    <div class="col-lg-24" flex-align="start" flex-text_align="center">
                        <div
                                class="product_preview-nav js-slider col-lg-21 hidden-xs"
                                data-slidesToShow="10"
                                data-autoplay="false"
                                data-speed="1000"
                                data-arrows="true"
                                data-dots="false"
                                data-asNavFor=".product_preview-img_big"
                                data-focusOnSelect="true"
                                data-centerMode="false"
                        >
                            <?foreach ($arResult["PROPERTIES"]["img_gallery"]["VALUE"] as $arFileInfo) :?>
                                <div class="product_preview-nav-item" style="background-image: url('<?=$arFileInfo["thumb"]?>')"></div>
                            <?endforeach;?>
                        </div>
                    </div>
                <?else:?>
                    <div class="product_preview-img_big col-lg-24">
                        <div class="product_preview-img_big-item" style="background-image: url('<?=is_array($arOffer["DETAIL_PICTURE"]) ? $arOffer["DETAIL_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH."/images/no-image.png"?>')"></div>
                    </div>
                <?endif?>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="catalog_detail-tab js-tabs">
        <div flex-align="center" class="catalog_detail-tab-btns container">
            <a href="#" class="catalog_detail-tab-item" data-tab_target="#description">
                <span class="title-5 light">Описание</span>
            </a>
            <a href="#" class="catalog_detail-tab-item" data-tab_target="#config">
                <span class="title-5 light">Характеристики</span>
            </a>
            <a
                    href="#"
                    class="catalog_detail-tab-item"
                    data-tab_target="#reviews"
                    onclick="obAjax.getReviews('reviews-list', '<?=$arOffer['ID']?>')"
            >
                <span class="title-5 light">Отзывы (<?=\kDevelop\Content\Reviews::getMarkeredCount($arOffer['ID'])?>)</span>
            </a>
        </div>
        <div class="catalog_detail-tab-inner" data-tab_content>
            <div id="description" data-tab_item>
                <div class="container">
                    <div class="title-5 light"><?=$arResult["PREVIEW_TEXT"]?></div>
                </div>
            </div>
            <div id="config" data-tab_item>
                <div class="container">
                    <div class="catalog_detail-description" flex-align="start" flex-wrap="wrap">
                        <div class="col-lg-19" flex-align="stretch">
                            <div class="catalog_detail-description-item">
                                <?
                                $additionalProps = [
                                    'size' => [
                                        'title' => 'Размеры',
                                        'items' => []
                                    ],
                                    'sleep_size' => [
                                        'title' => 'Спальное место',
                                        'items' => []
                                    ],
                                    'state_size' => [
                                        'title' => 'Посадочное место',
                                        'items' => []
                                    ],
                                ];
                                $propPerBlock = ceil(count($arParams["PRODUCT_PROPERTIES"]) / 4);
                                $counter = 0;
                                foreach ($arParams["PRODUCT_PROPERTIES"] as $code) :
                                    $arProp = isset($arResult["PROPERTIES"][$code]) ? $arResult["PROPERTIES"][$code] : $arOffer["PROPERTIES"][$code];
                                    if (!is_string($arProp["VALUE"]) || !$arProp || strlen($arProp["VALUE"]) == 0) continue;
                                    if (in_array($code, ['size_length', 'size_width', 'size_height'])) {
                                        $additionalProps['size']['items'][] = [
                                            'NAME' => $arProp['HINT'],
                                            'VALUE' => $arProp["VALUE"]
                                        ];
                                        continue;
                                    }
                                    if (in_array($code, ['sleep_size_length', 'sleep_size_width', 'sleep_size_height'])) {
                                        $additionalProps['sleep_size']['items'] = [
                                            'NAME' => $arProp['HINT'],
                                            'VALUE' => $arProp["VALUE"]
                                        ];
                                        continue;
                                    }
                                    if (in_array($code, ['state_size_length', 'state_size_width', 'state_size_height'])) {
                                        $additionalProps['state_size']['items'] = [
                                            'NAME' => $arProp['HINT'],
                                            'VALUE' => $arProp["VALUE"]
                                        ];
                                        continue;
                                    }
                                    ?>
                                    <?if ($counter % $propPerBlock == 0 && $counter > 0) :?>
                                        </div><div class="catalog_detail-description-item">
                                    <?endif?>
                                    <div class="catalog_item-block">
                                        <div class="title-5 light"><?=$arProp["NAME"]?>:</div>
                                        <div><?=$arProp["VALUE"]?></div>
                                    </div>
                                    <?
                                    $counter++;
                                endforeach;?>
                                <?foreach ($additionalProps as $prop) :
                                    if (count($prop['items']) == 0) continue;
                                    ?>
                                    <?if ($counter % $propPerBlock == 0 && $counter > 0) :?>
                                        </div><div class="catalog_detail-description-item">
                                    <?endif?>
                                    <div class="catalog_item-block">
                                        <div class="title-5 light"><?=$prop['title']?>:</div>
                                        <div flex-align="start" flex-wrap="wrap">
                                            <?foreach ($prop['items'] as $propItem) :?>
                                                <div class="catalog_item-footer-part">
                                                    <small><?=$propItem['NAME']?></small>
                                                    <span><?=$propItem['VALUE']?> см</span>
                                                </div>
                                            <?endforeach;?>
                                        </div>
                                    </div>
                                    <?
                                    $counter++;
                                endforeach;?>
                            </div>
                        </div>
                        <?if ($arOffer["CAN_BUY"]) :?>
                            <div class="col-lg-5" flex-align="start" flex-text_align="end">
                                <div>
                                    <div class="catalog_item-block">
                                        <div class="title-5 light">Цена:</div>
                                        <?if ($arParams['SHOW_OLD_PRICE'] == "Y" && $arPrice['DISCOUNT_DIFF'] > 0) :?>
                                            <div flex-align="center">
                                                <div class="catalog_item-price">
                                                    <s><?=$arPrice['PRINT_VALUE']?></s>
                                                </div>
                                                <?if ($arPrice["DISCOUNT_DIFF_PERCENT"] > 0) :?>
                                                    <div class="sale_label">-<?=$arPrice['DISCOUNT_DIFF_PERCENT']?>%</div>
                                                <?endif?>
                                            </div>
                                        <?endif?>
                                        <div class="catalog_item-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
                                    </div>
                                    <div class="catalog_item-block">
                                        <a href="#" class="btn btn-arrow col-lg-24 col-xs-24" align="center" data-popup-open="#buy-one-click">
                                            <span>Купить в 1 клик</span>
                                            <i class="icon icon-arrow-orange"></i>
                                        </a>
                                    </div>
                                    <div class="catalog_item-block">
                                        <a
                                                href="#"
                                                class="btn color btn-arrow col-lg-24 col-xs-24"
                                                align="center"
                                                onclick="obAjax.addToBasket('<?=$arOffer["ID"]?>', '<?=$arPrice["PRICE_ID"]?>', event)"
                                        >
                                            <span>В корзину</span>
                                            <i class="icon icon-arrow"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?endif?>
                    </div>
                    <?=kDevelop\Content\ProductArticles::getMarkeredId($arOffer['ID'])?>
                </div>
            </div>
            <div id="reviews" data-tab_item>
                <div class="container">
                    <div flex-align="center" flex-wrap="wrap" flex-text_align="space-between">
                        <div>
                            <div class="title-5 light">Рейтинг</div>
                            <div>
                                <?=\kDevelop\Content\Reviews::getMarkeredHtmlStars($arOffer['ID'])?>
                                <span>(<?=\kDevelop\Content\Reviews::getMarkeredRating($arOffer['ID'])?>)</span>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="btn color btn-arrow" flex-text_align="end" data-popup-open="#myfeedback">
                                <span>Оставить отзыв</span>
                                <i class="icon icon-arrow"></i>
                            </a>
                        </div>
                    </div>
                    <div id="reviews-list"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?if (count($arResult["OFFERS"]) > 1) :?>
    <section class="section first">
        <div class="container">
            <div class="title-3 medium">Ещё варианты <?=$arResult["NAME"]?></div>
            <div
                    class="catalog_slider js-slider clearfix"
                    data-autoplay="true"
                    data-autoplaySpeed="5000"
                    data-infinite="false"
                    data-speed="1000"
                    data-arrows="<?=$arParams["DEVICE_TYPE"] == "DESKTOP" ? "true" : "false"?>"
                    data-dots="false"
                    data-slidesToShow="<?=$arParams["ALSO_BUY_ELEMENT_COUNT"]?>"
            >
                <?foreach ($arResult["OFFERS"] as $arOfferItem) :
                    if ($arOffer["ID"] == $arOfferItem["ID"]) continue;
                    ?>
                    <div id="catalog-item-<?=$arOfferItem["ID"]?>" class="catalog_item">
                        <?
                        $this->AddEditAction($arOfferItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arOfferItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arOfferItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arOfferItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        $APPLICATION->IncludeComponent(
                            "kDevelop:catalog.item",
                            $arResult["INNER_TEMPLATE"],
                            [
                                "RESULT" => [
                                    "ITEM" => $arOfferItem,
                                    "WRAP_ID" => "catalog-item-".$arOfferItem["ID"],
                                    "AREA_ID" => ($arResult["SET_AREA"] ? $this->GetEditAreaId($arOfferItem["ID"]) : null)
                                ],
                                "PARAMS" => array_merge($arParams, ["HIDE_FAST_PRODUCT" => "Y"]),
                                "PRICES" => $arResult["PRICES"]
                            ],
                            null,
                            ['HIDE_ICONS' => 'Y']
                        );?>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </section>
<?endif?>

<script>
    BX.message({
        ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
        TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
        TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
        BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
        BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
        BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
        BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
        BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
        TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
        COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
        COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
        COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
        BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
        PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
        PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
        RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
        RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
        SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>',
        BTN_MESSAGE_FAVORITE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_FAVORITE_REDIRECT')?>',
        FAVORITE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_FAVORITE_TITLE')?>'
    });
    var obCatalogElement_<?=$arOffer["ID"]?> = new window.catalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
</script>
