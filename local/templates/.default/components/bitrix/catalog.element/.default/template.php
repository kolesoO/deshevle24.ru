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
///end
?>

<section class="section">
    <div class="container">
        <div flex-align="center" flex-text_align="space-between" flex-wrap="wrap">
            <div class="col-lg-7 col-md-24">
                <div class="title-1"><?=isset($arResult["IPROP_VALUES"]["ELEMENT_PAGE_TITLE"]) ? $arResult["IPROP_VALUES"]["ELEMENT_PAGE_TITLE"] : $arOffer["NAME"]?></div>
            </div>
            <hr class="section_hr hidden-lg col-md-24 col-xs-24">
            <div class="btn_list col-lg-15 col-md-24 col-xs-24" flex-align="center" flex-text_align="space-between" flex-wrap="wrap">
                <div align="center">
                    <i class="icon icon-star"></i>
                    <i class="icon icon-star"></i>
                    <i class="icon icon-star"></i>
                    <i class="icon icon-star"></i>
                    <i class="icon icon-star"></i>
                    <span>(0)</span>
                </div>
                <a href="#" class="btn grey_full col-xs-24" align="center" data-entity="favorite" data-id="<?=$arResult["ID"]?>">
                    <i class="icon icon-favorite"></i>
                    <span>Мне нравится</span>
                </a>
                <?if ($arOffer["CAN_BUY"]) :?>
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
                <?endif?>
            </div>
        </div>
        <div class="catalog_detail">
            <div class="product_preview-img col-lg-24 col-md-24 col-xs-24" flex-align="stretch" flex-wrap="wrap" flex-text_align="space-between">
                <?if (is_array($arResult["PROPERTIES"]["img_gallery"]["VALUE"]) && count($arResult["PROPERTIES"]["img_gallery"]["VALUE"]) > 0) :?>
                    <div
                            class="product_preview-nav col-lg-3 col-md-3 hidden-xs"
                            data-autoplay="false"
                            data-autoplaySpeed="5000"
                            data-infinite="false"
                            data-speed="1000"
                            data-arrows="true"
                            data-dots="false"
                            data-slidesToShow="3"
                    >
                        <?foreach ($arResult["PROPERTIES"]["img_gallery"]["VALUE"] as $arFileInfo) :?>
                            <a href="#" class="product_preview-nav-item" style="background-image: url('<?=$arFileInfo["thumb"]?>')"></a>
                        <?endforeach;?>
                    </div>
                    <div
                            class="product_preview-img_big js-slider col-lg-20 col-md-20 col-xs-24"
                            data-autoplay="false"
                            data-autoplaySpeed="5000"
                            data-infinite="false"
                            data-speed="1000"
                            data-arrows="true"
                            data-dots="false"
                            data-slidesToShow="1"
                    >
                        <?foreach ($arResult["PROPERTIES"]["img_gallery"]["VALUE"] as $key => $arFileInfo) :?>
                            <div class="product_preview-img_big-item" style="background-image: url('<?=$arFileInfo["origin"]?>')"></div>
                        <?endforeach;?>
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
        <div flex-align="center" flex-text_align="space-between">
            <a href="#" class="catalog_detail-tab-item col-lg-6 col-md-6 col-xs-12" data-tab_target="#config">Конфигурация</a>
            <a href="#" class="catalog_detail-tab-item col-lg-18 col-md-18 col-xs-12" data-tab_target="#reviews">Отзывы (0)</a>
        </div>
        <div class="section" data-tab_content>
            <div id="config" data-tab_item>
                <div class="container">
                    <div class="catalog_detail-description" flex-align="start" flex-text_align="space-between" flex-wrap="wrap">
                        <div class="catalog_detail-description-item col-lg-6 col-md-8 col-xs-24">
                            <?
                            $propPerBlock = ceil(count($arParams["PRODUCT_PROPERTIES"]) / 4);
                            $counter = 0;
                            foreach ($arParams["PRODUCT_PROPERTIES"] as $code) :
                                $arProp = isset($arResult["PROPERTIES"][$code]) ? $arResult["PROPERTIES"][$code] : $arOffer["PROPERTIES"][$code];
                                if (!is_string($arProp["VALUE"]) || !$arProp) continue;
                                ?>
                                <?if ($counter % $propPerBlock == 0 && $counter > 0) :?>
                                    </div><div class="catalog_detail-description-item col-lg-6 col-md-8 col-xs-24">
                                <?endif?>
                                <div class="catalog_item-block">
                                    <div class="title-4"><?=$arProp["NAME"]?>:</div>
                                    <div><?=$arProp["VALUE"]?></div>
                                </div>
                                <?
                                $counter++;
                            endforeach;?>
                        </div>
                        <?if ($arOffer["CAN_BUY"]) :?>
                            <div class="catalog_detail-description-item col-lg-6 col-md-24 col-xs-24">
                                <div class="catalog_item-block">
                                    <div class="title-4">Цена:</div>
                                    <div flex-align="center" flex-text_align="space-between">
                                        <?if ($arParams['SHOW_OLD_PRICE'] == "Y" && $arPrice["DISCOUNT_DIFF_PERCENT"] > 0) :?>
                                            <div class="sale_label">-<?=$arPrice['DISCOUNT_DIFF_PERCENT']?>%</div>
                                        <?endif?>
                                        <div class="catalog_item-price" align="right">
                                            <?if ($arParams['SHOW_OLD_PRICE'] == "Y" && $arPrice["DISCOUNT_DIFF"] > 0) :?>
                                                <s><?=$arPrice['PRINT_VALUE']?></s>
                                            <?endif?>
                                            <div><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
                                        </div>
                                    </div>
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
                        <?endif?>
                    </div>
                    <hr class="section_hr">
                    <div class="articles_list" flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
                        <div class="articles_list-item col-lg-5 col-md-11 col-xs-24">
                            <div class="catalog_item-block">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/config-item.png">
                            </div>
                            <div class="title-4">Скандинавский стиль</div>
                            <div>Прямоугольные, слегка скругленные формы дивана «Динс» – образец традиционного скандинавского стиля. Приподнятое над полом основание делает модель визуально легкой, а симметричные стяжки на подушках дополняют образ.</div>
                        </div>
                        <div class="articles_list-item col-lg-5 col-md-11 col-xs-24">
                            <div class="catalog_item-block">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/config-item.png">
                            </div>
                            <div class="title-4">Скандинавский стиль</div>
                            <div>Прямоугольные, слегка скругленные формы дивана «Динс» – образец традиционного скандинавского стиля. Приподнятое над полом основание делает модель визуально легкой, а симметричные стяжки на подушках дополняют образ.</div>
                        </div>
                        <div class="articles_list-item col-lg-5 col-md-11 col-xs-24">
                            <div class="catalog_item-block">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/config-item.png">
                            </div>
                            <div class="title-4">Скандинавский стиль</div>
                            <div>Прямоугольные, слегка скругленные формы дивана «Динс» – образец традиционного скандинавского стиля. Приподнятое над полом основание делает модель визуально легкой, а симметричные стяжки на подушках дополняют образ.</div>
                        </div>
                        <div class="articles_list-item col-lg-5 col-md-11 col-xs-24">
                            <div class="catalog_item-block">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/config-item.png">
                            </div>
                            <div class="title-4">Скандинавский стиль</div>
                            <div>Прямоугольные, слегка скругленные формы дивана «Динс» – образец традиционного скандинавского стиля. Приподнятое над полом основание делает модель визуально легкой, а симметричные стяжки на подушках дополняют образ.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="reviews" data-tab_item>
                <div class="container">
                    <p>Список отзывов пуст</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?if (count($arResult["OFFERS"]) > 1) :?>
    <section class="section first">
        <div class="container">
            <div class="title-2">Ещё варианты <?=$arResult["NAME"]?></div>
            <div
                    class="catalog_slider js-slider clearfix"
                    data-autoplay="false"
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
    var obCatalogElementDetail = new window.catalogElementDetail(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
</script>