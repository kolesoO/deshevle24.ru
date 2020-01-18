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

<section>
    <div class="container">
        <div flex-align="center" flex-text_align="space-between" flex-wrap="wrap">
            <div class="col-lg-8 col-md-24">
                <div flex-align="center" flex-wrap="wrap" flex-text_align="start">
                    <div class="title-3 medium col-lg-13"><?=isset($arResult["IPROP_VALUES"]["ELEMENT_PAGE_TITLE"]) ? $arResult["IPROP_VALUES"]["ELEMENT_PAGE_TITLE"] : $arOffer["NAME"]?></div>
                    <?if ($arOffer["CAN_BUY"]) :?>
                        <div class="catalog_label catalog_label-detail title-3 light" align="center"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
                    <?endif?>
                </div>
            </div>
            <div class="btn_list col-lg-15 col-md-24 col-xs-24" flex-align="center" flex-text_align="end" flex-wrap="wrap">
                <div class="btn_list-block">
                    <div class="btn grey_white col-xs-24" align="center">
                        <i class="icon icon-star-gray-empty"></i>
                        <i class="icon icon-star-gray-empty"></i>
                        <i class="icon icon-star-gray-empty"></i>
                        <i class="icon icon-star-gray-empty"></i>
                        <i class="icon icon-star-gray-empty"></i>
                        <span class="title-5 light">(0)</span>
                    </div>
                    <a href="#" class="btn grey_white col-xs-24" align="center" data-entity="favorite" data-id="<?=$arOffer["ID"]?>">
                        <i class="icon icon-favorite opacity"></i>
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
                            class="product_preview-img_big col-lg-24"
                            data-autoplay="true"
                            data-speed="1000"
                            data-arrows="false"
                            data-dots="false"
                            data-centerMode="true"
                            data-focusOnSelect="true"
                            data-asNavFor=".product_preview-nav"
                    >
                        <?foreach ($arResult["PROPERTIES"]["img_gallery"]["VALUE"] as $key => $arFileInfo) :?>
                            <div class="product_preview-img_big-item" style="background-image: url('<?=$arFileInfo["origin"]?>')"></div>
                        <?endforeach;?>
                    </div>
                    <div class="col-lg-24" flex-align="start" flex-text_align="center">
                        <div
                                class="product_preview-nav col-lg-21 hidden-xs"
                                data-slidesToShow="3"
                                data-autoplay="false"
                                data-speed="1000"
                                data-arrows="false"
                                data-dots="false"
                                data-asNavFor=".product_preview-img_big"
                                data-focusOnSelect="true"
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
        <div flex-align="center" flex-text_align="space-between">
            <a href="#" class="catalog_detail-tab-item col-lg-6 col-md-6 col-xs-12" data-tab_target="#description">
                <span class="title-5 light">Описание</span>
            </a>
            <a href="#" class="catalog_detail-tab-item col-lg-3 col-md-6 col-xs-12" data-tab_target="#config">
                <span class="title-5 light">Конфигурация</span>
            </a>
            <a href="#" class="catalog_detail-tab-item col-lg-3 col-md-6 col-xs-12" data-tab_target="#reviews-old" align="center">
                <span class="title-5 light">Отзывы (0)</span>
            </a>
            <a href="#" class="catalog_detail-tab-item col-lg-18 col-md-18 col-xs-12" data-tab_target="#reviews">
                <span class="title-5 light">Отзывы (2)</span>
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
                    <div class="catalog_detail-description" flex-align="start" flex-text_align="space-between" flex-wrap="wrap">
                        <div class="catalog_detail-description-item">
                            <?
                            $propPerBlock = ceil(count($arParams["PRODUCT_PROPERTIES"]) / 4);
                            $counter = 0;
                            foreach ($arParams["PRODUCT_PROPERTIES"] as $code) :
                                $arProp = isset($arResult["PROPERTIES"][$code]) ? $arResult["PROPERTIES"][$code] : $arOffer["PROPERTIES"][$code];
                                if (!is_string($arProp["VALUE"]) || !$arProp || strlen($arProp["VALUE"]) == 0) continue;
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
                        </div>
                        <?if ($arOffer["CAN_BUY"]) :?>
                            <div class="catalog_detail-description-item">
                                <div class="catalog_item-block">
                                    <div class="title-5 light">Цена:</div>
                                    <?if ($arParams['SHOW_OLD_PRICE'] == "Y") :?>
                                        <div flex-align="center">
                                            <div class="catalog_item-price">
                                                <s><?=number_format($arPrice['VALUE'], 0, '.', ' ')?></s>
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
                        <?endif?>
                    </div>
                    <div class="articles_list" flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
                        <div class="articles_list-item col-lg-5 col-md-11 col-xs-24">
                            <div class="articles_list-img catalog_item-block" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/images/config-item.png')"></div>
                            <div class="title-5 medium">Скандинавский стиль</div>
                            <div class="articles_list-desc">Прямоугольные, слегка скругленные формы дивана «Динс» – образец традиционного скандинавского стиля. Приподнятое над полом основание делает модель визуально легкой, а симметричные стяжки на подушках дополняют образ.</div>
                        </div>
                        <div class="articles_list-item col-lg-5 col-md-11 col-xs-24">
                            <div class="articles_list-img catalog_item-block" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/images/config-item.png')"></div>
                            <div class="title-5 medium">Скандинавский стиль</div>
                            <div class="articles_list-desc">Прямоугольные, слегка скругленные формы дивана «Динс» – образец традиционного скандинавского стиля. Приподнятое над полом основание делает модель визуально легкой, а симметричные стяжки на подушках дополняют образ.</div>
                        </div>
                        <div class="articles_list-item col-lg-5 col-md-11 col-xs-24">
                            <div class="articles_list-img catalog_item-block" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/images/config-item.png')"></div>
                            <div class="title-5 medium">Скандинавский стиль</div>
                            <div class="articles_list-desc">Прямоугольные, слегка скругленные формы дивана «Динс» – образец традиционного скандинавского стиля. Приподнятое над полом основание делает модель визуально легкой, а симметричные стяжки на подушках дополняют образ.</div>
                        </div>
                        <div class="articles_list-item col-lg-5 col-md-11 col-xs-24">
                            <div class="articles_list-img catalog_item-block" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/images/config-item.png')"></div>
                            <div class="title-5 medium">Скандинавский стиль</div>
                            <div class="articles_list-desc">Прямоугольные, слегка скругленные формы дивана «Динс» – образец традиционного скандинавского стиля. Приподнятое над полом основание делает модель визуально легкой, а симметричные стяжки на подушках дополняют образ.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="reviews-old" data-tab_item>
                <div class="container">
                    <div flex-align="center" flex-wrap="wrap" flex-text_align="space-between">
                        <div>
                            <div class="title-5 light">Рейтинг (0)</div>
                            <div>
                                <i class="icon icon-star-gray-empty"></i>
                                <i class="icon icon-star-gray-empty"></i>
                                <i class="icon icon-star-gray-empty"></i>
                                <i class="icon icon-star-gray-empty"></i>
                                <i class="icon icon-star-gray-empty"></i>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="btn color btn-arrow" flex-text_align="end" data-popup-open="#myfeedback">
                                <span>Оставить отзыв</span>
                                <i class="icon icon-arrow"></i>
                            </a>
                        </div>
                    </div>
                    <div class="feedback-list">
                        <div class="feedback-empty" flex-align="center" flex-wrap="wrap" flex-text_align="center">
                            <div align="center">
                                <i class="icon icon-chat_msg"></i>
                                <br><br><br>
                                <div>Отзывов о данном товаре пока нет</div>
                                <div class="title-5 medium">Оставь отзыв первым</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="reviews" data-tab_item>
                <div class="container">
                    <div flex-align="center" flex-wrap="wrap" flex-text_align="space-between">
                        <div>
                            <div class="title-5 light">Рейтинг (0)</div>
                            <div>
                                <i class="icon icon-star"></i>
                                <i class="icon icon-star"></i>
                                <i class="icon icon-star-gray-empty"></i>
                                <i class="icon icon-star-gray-empty"></i>
                                <i class="icon icon-star-gray-empty"></i>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="btn color btn-arrow" flex-text_align="end" data-popup-open="#myfeedback">
                                <span>Оставить отзыв</span>
                                <i class="icon icon-arrow"></i>
                            </a>
                        </div>
                    </div>
                    <div class="feedback-list">
                        <div class="feedback-list-item">
                            <div flex-align="start" flex-text_align="space-between" flex-wrap="wrap">
                                <div class="user-info col-lg-18" flex-align="start" flex-text_align="space-between" flex-wrap="wrap">
                                    <div class="title-5 medium">Иванов Максим</div>
                                    <p>26.01.2019 12.30</p>
                                    <div class="feedback-stars col-lg-24">
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star"></i>
                                        <i class="icon icon-star-gray-empty"></i>
                                    </div>
                                    <div class="user-info-txt col-lg-24">
                                        <p>Все понравилось. Удобный диван, хорошая продавщица в салоне, няшные доставщики. Рекомендую!</p>
                                    </div>
                                    <div class="feedback-like col-lg-24" flex-align="start">
                                        <i class="icon icon-like-black"></i>
                                        <p>Да, я рекомендую эту модель!</p>
                                    </div>
                                </div>
                                <img src="/local/templates/common/images/instagram-item.png" class="col-lg-5">
                            </div>
                        </div>
                        <div class="feedback-list-item">
                            <div class="user-info col-lg-24" flex-align="start" flex-text_align="space-between" flex-wrap="wrap">
                                <div class="title-5 medium">Иванов Максим</div>
                                <p>26.01.2019 12.30</p>
                                <div class="feedback-stars col-lg-24">
                                    <i class="icon icon-star"></i>
                                    <i class="icon icon-star"></i>
                                    <i class="icon icon-star"></i>
                                    <i class="icon icon-star"></i>
                                    <i class="icon icon-star-gray-empty"></i>
                                </div>
                                <div class="user-info-txt col-lg-24">
                                    <p>Все понравилось. Удобный диван, хорошая продавщица в салоне, няшные доставщики. Рекомендую!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div flex-align="center" flex-text_align="center">
                        <a href="#" class="title-5 medium btn" align="center" data-popup-open="#">Все отзывы</a>
                    </div>
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
    var obCatalogElementDetail = new window.catalogElementDetail(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
</script>
