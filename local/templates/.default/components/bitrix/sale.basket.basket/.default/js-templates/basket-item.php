<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */
?>
<script id="basket-item-template" type="text/html">
    <div
        id="basket-item-{{ID}}"
        data-entity="basket-item"
        data-id="{{ID}}"
        class="basket-item col-lg-24"
        flex-align="center"
        flex-text_align="space-between"
        flex-wrap="wrap"
    >
        <div class="basket-item-col col-lg-6" align="center">
            <div class="col-lg-22">
                <img src="{{IMAGE_URL}}">
            </div>
        </div>
        <div class="basket-item-col col-lg-6">
            <div class="catalog_item-block">
                <div class="light_grey_link">{{SECTION}}</div>
                <div class="title-3 light">{{NAME}}</div>
            </div>
            <div class="catalog_item-block">
                <div class="title-5 light">Цвет</div>
                <div class="catalog_color" flex-align="start" flex-wrap="wrap">
                    <div class="catalog_color-item" flex-align="center">
                        <span class="catalog_color-color" style="background-color: #ff9901"></span>
                        <span>Оранжевый</span>
                    </div>
                </div>
            </div>
            <div class="catalog_item-block">
                <div class="title-5 light">Размеры</div>
                <div flex-align="start" flex-wrap="wrap">
                    <div class="catalog_item-footer-part">
                        <small>длина</small>
                        <span>170 см</span>
                    </div>
                    <div class="catalog_item-footer-part">
                        <small>ширина</small>
                        <span>75 см</span>
                    </div>
                    <div class="catalog_item-footer-part">
                        <small>высота</small>
                        <span>80 см</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="basket-item-col col-lg-12" flex-align="start" flex-wrap="wrap">
            <div class="col-lg-2"></div>
            <div class="col-lg-22">
                <div class="catalog_item-block">
                    <div class="color-grey">Цена</div>
                    <div id="basket-item-price-{{ID}}" class="catalog_item-price">{{{PRICE_FORMATED}}}</div>
                </div>
                <div
                        class="catalog_item-block basket_list-qnt"
                        flex-align="center"
                        flex-wrap="wrap"
                        flex-text_align="space-between"
                >
                    <div flex-align="center" flex-wrap="wrap" data-entity="basket-item-quantity-block">
                        <button class="cart_buy-qnt title-1 light" data-entity="basket-item-quantity-minus">-</button>
                        <input
                                id="basket-item-quantity-{{ID}}"
                                type="text"
                                class="cart_buy-qnt"
                                value="{{QUANTITY}}"
                                data-value="{{QUANTITY}}"
                                data-entity="basket-item-quantity-field"
                        >
                        <button class="cart_buy-qnt title-1 light" data-entity="basket-item-quantity-plus">+</button>
                    </div>
                    <button
                            class="btn grey col-md-24 col-xs-24"
                            align="center"
                            data-entity="basket-item-delete"
                    >Удалить</button>
                </div>
                <div>
                    <div class="color-grey">{{{ITEM_PHRASE}}}</div>
                    <div id="basket-item-sum-price-{{ID}}" class="catalog_item-price">{{{SUM_PRICE_FORMATED}}}</div>
                </div>
            </div>
        </div>
    </div>
</script>
