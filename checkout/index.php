<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Оформление заказа");
?>

<section class="section">
    <div class="container">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:sale.basket.basket",
            "",
            Array(
                "ACTION_VARIABLE" => "action",
                "AUTO_CALCULATION" => "Y",
                "TEMPLATE_THEME" => "blue",
                "COLUMNS_LIST" => array("NAME","DISCOUNT","WEIGHT","DELETE","PRICE","QUANTITY"),
                "COMPONENT_TEMPLATE" => ".default",
                "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
                "GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
                "GIFTS_CONVERT_CURRENCY" => "Y",
                "GIFTS_HIDE_BLOCK_TITLE" => "N",
                "GIFTS_HIDE_NOT_AVAILABLE" => "N",
                "GIFTS_MESS_BTN_BUY" => "Выбрать",
                "GIFTS_MESS_BTN_DETAIL" => "Подробнее",
                "GIFTS_PAGE_ELEMENT_COUNT" => "4",
                "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
                "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "",
                "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
                "GIFTS_SHOW_IMAGE" => "Y",
                "GIFTS_SHOW_NAME" => "Y",
                "GIFTS_SHOW_OLD_PRICE" => "Y",
                "GIFTS_TEXT_LABEL_GIFT" => "Подарок",
                "GIFTS_PLACE" => "BOTTOM",
                "HIDE_COUPON" => "N",
                "OFFERS_PROPS" => array("SIZES_SHOES","SIZES_CLOTHES"),
                "PATH_TO_ORDER" => "/checkout/",
                "EMPTY_REDIRECT_PATH" => "/product-category/",
                "PRICE_VAT_SHOW_VALUE" => "N",
                "QUANTITY_FLOAT" => "N",
                "SET_TITLE" => "N",
                "TEMPLATE_THEME" => "blue",
                "USE_GIFTS" => "N",
                "USE_PREPAYMENT" => "N",
                "TOTAL_BLOCK_DISPLAY" => ["bottom"],
                "SHOW_FILTER" => "N",
                "SHOW_RESTORE" => "N"
            )
        );
        $APPLICATION->IncludeComponent(
            "bitrix:sale.order.ajax",
            "",
            Array(
                "ADDITIONAL_PICT_PROP_8" => "-",
                "ALLOW_AUTO_REGISTER" => "Y",
                "ALLOW_NEW_PROFILE" => "Y",
                "ALLOW_USER_PROFILES" => "Y",
                "BASKET_IMAGES_SCALING" => "standard",
                "BASKET_POSITION" => "after",
                "COMPATIBLE_MODE" => "Y",
                "DELIVERIES_PER_PAGE" => "8",
                "DELIVERY_FADE_EXTRA_SERVICES" => "Y",
                "DELIVERY_NO_AJAX" => "Y",
                "DELIVERY_NO_SESSION" => "Y",
                "DELIVERY_TO_PAYSYSTEM" => "d2p",
                "DISABLE_BASKET_REDIRECT" => "N",
                "MESS_DELIVERY_CALC_ERROR_TEXT" => "Вы можете продолжить оформление заказа, а чуть позже менеджер магазина свяжется с вами и уточнит информацию по доставке.",
                "MESS_DELIVERY_CALC_ERROR_TITLE" => "Не удалось рассчитать стоимость доставки.",
                "MESS_FAIL_PRELOAD_TEXT" => "Вы заказывали в нашем интернет-магазине, поэтому мы заполнили все данные автоматически. Обратите внимание на развернутый блок с информацией о заказе. Здесь вы можете внести необходимые изменения или оставить как есть и нажать кнопку \"#ORDER_BUTTON#\".",
                "MESS_SUCCESS_PRELOAD_TEXT" => "Вы заказывали в нашем интернет-магазине, поэтому мы заполнили все данные автоматически. Если все заполнено верно, нажмите кнопку \"#ORDER_BUTTON#\".",
                "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
                "PATH_TO_AUTH" => "/auth/",
                "PATH_TO_BASKET" => "/cart/",
                "PATH_TO_PAYMENT" => "payment.php",
                "PATH_TO_PERSONAL" => "/personal/",
                "PAY_FROM_ACCOUNT" => "N",
                "PAY_SYSTEMS_PER_PAGE" => "8",
                "PICKUPS_PER_PAGE" => "5",
                "PRODUCT_COLUMNS_HIDDEN" => array("PROPERTY_MATERIAL"),
                "PRODUCT_COLUMNS_VISIBLE" => array("PREVIEW_PICTURE","PROPS"),
                "PROPS_FADE_LIST_1" => array("17","19"),
                "SEND_NEW_USER_NOTIFY" => "Y",
                "SERVICES_IMAGES_SCALING" => "standard",
                "SET_TITLE" => "Y",
                "SHOW_BASKET_HEADERS" => "N",
                "SHOW_COUPONS_BASKET" => "Y",
                "SHOW_COUPONS_DELIVERY" => "Y",
                "SHOW_COUPONS_PAY_SYSTEM" => "Y",
                "SHOW_DELIVERY_INFO_NAME" => "Y",
                "SHOW_DELIVERY_LIST_NAMES" => "Y",
                "SHOW_DELIVERY_PARENT_NAMES" => "Y",
                "SHOW_MAP_IN_PROPS" => "N",
                "SHOW_NEAREST_PICKUP" => "N",
                "SHOW_ORDER_BUTTON" => "final_step",
                "SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
                "SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
                "SHOW_STORES_IMAGES" => "Y",
                "SHOW_TOTAL_ORDER_BUTTON" => "Y",
                "SHOW_VAT_PRICE" => "Y",
                "SKIP_USELESS_BLOCK" => "Y",
                "TEMPLATE_LOCATION" => "popup",
                "TEMPLATE_THEME" => "site",
                "USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
                "USE_CUSTOM_ERROR_MESSAGES" => "Y",
                "USE_CUSTOM_MAIN_MESSAGES" => "N",
                "USE_PREPAYMENT" => "N",
                "USE_YM_GOALS" => "N",
                "USER_CONSENT" => "Y",
                "USER_CONSENT_ID" => "1",
                "USER_CONSENT_IS_CHECKED" => "Y",
                "USER_CONSENT_IS_LOADED" => "N"
            )
        );
        ?>
    </div>
</section>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');