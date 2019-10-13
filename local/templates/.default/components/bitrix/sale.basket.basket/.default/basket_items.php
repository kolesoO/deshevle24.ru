<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
use Bitrix\Sale\DiscountCouponsManager;

if (!empty($arResult["ERROR_MESSAGE"]))
	ShowError($arResult["ERROR_MESSAGE"]);

if (count($arResult["ITEMS"]["AnDelCanBuy"]) > 0) :?>
    <?foreach ($arResult["ITEMS"]["AnDelCanBuy"] as $arItem) :?>
        <div class="basket-item col-lg-24" flex-align="start" flex-text_align="space-between" flex-wrap="wrap">
            <div class="basket-item-col col-lg-5" align="center">
                <img src="<?=strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0 ? $arItem["PREVIEW_PICTURE_SRC"] : SITE_TEMPLATE_PATH . "/images/no-image.png" ?>">
            </div>
            <div class="basket-item-col col-lg-5">
                <div class="catalog_item-block">
                    <div><?=$arItem["NAME"]?></div>
                </div>
                <div class="catalog_item-block">
                    <small>Цвет</small>
                    <div class="catalog_color" flex-align="start" flex-wrap="wrap">
                        <a href="#" class="catalog_color-item" flex-align="center">
                            <span class="catalog_color-color" style="background-color: #ff9901"></span>
                            <span>Оранжевый</span>
                        </a>
                    </div>
                </div>
                <div class="catalog_item-block">
                    <div>Размеры</div>
                    <div flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
                        <div class="col-lg-8">
                            <small>длина</small>
                            <span>200 см</span>
                        </div>
                        <div class="col-lg-8">
                            <small>ширина</small>
                            <span>96 см</span>
                        </div>
                        <div class="col-lg-8">
                            <small>высота</small>
                            <span>96 см</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="basket-item-col col-lg-5">
                <div class="catalog_item-block">
                    <small>Цена</small>
                    <div class="catalog_item-price"><?=$arItem["FULL_PRICE_FORMATED"]?></div>
                </div>
                <div class="basket-item-ammount">

                </div>
                <div>
                    <small><?=$arItem["QUANTITY"]?> товара на сумму</small>
                    <div class="catalog_item-price"><?=$arItem["SUM"]?></div>
                </div>
            </div>
            <div class="basket-item-col col-lg-5">
                <button class="btn grey col-md-24 col-xs-24" align="center">Удалить</button>
            </div>
        </div>
    <?endforeach;?>
<?else:?>
    <div id="basket_items_list">
        <table>
            <tbody>
                <tr>
                    <td style="text-align:center">
                        <div class=""><?=GetMessage("SALE_NO_ITEMS");?></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?endif;