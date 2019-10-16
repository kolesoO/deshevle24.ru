<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("");

//баннеры
$imageSize = [];
if (DEVICE_TYPE != "DESKTOP") {
    $imageSize = [
        "WIDTH" => 875,
        "HEIGHT" => 500
    ];
}
$GLOBALS["bannerFilter"] = ["!PREVIEW_PICTURE" => false];
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "banner",
    [
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => IBLOCK_CONTENT_BANNERS,
        "NEWS_COUNT" => "10",
        "SORT_BY1" => "ACTIVE_DATE",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "bannerFilter",
        "FIELD_CODE" => Array("ID", "NAME"),
        "PROPERTY_CODE" => Array(),
        "CHECK_DATES" => "N",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "arrPager",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "IMAGE_SIZE" => $imageSize
    ]
);
//end

//лидеры продаж
$arCatalogTopParams = [
    "IMAGE_SIZE" => [
        "WIDTH" => "",
        "HEIGHT" => ""
    ],
    "ITEMS_COUNT" => 10,
    "LINE_ELEMENT_COUNT" => 4
];
if (DEVICE_TYPE == "TABLET") {
    $arCatalogTopParams["LINE_ELEMENT_COUNT"] = 2;
} elseif (DEVICE_TYPE == "MOBILE") {
    $arCatalogTopParams["LINE_ELEMENT_COUNT"] = 1;
}
$GLOBALS["arCatalogTopFilter"] = [
    "PROPERTY_status_VALUE" => "Лидер продаж"
];
$APPLICATION->IncludeComponent(
    "bitrix:catalog.top",
    "",
    [
        "ACTION_VARIABLE" => "action",
        "ADD_PICT_PROP" => "MORE_PHOTO",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "BASKET_URL" => "/personal/basket.php",
        "BRAND_PROPERTY" => "BRAND_REF",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
        "COMPARE_PATH" => "",
        "COMPATIBLE_MODE" => "N",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "CUSTOM_FILTER" => "",
        "DATA_LAYER_NAME" => "dataLayer",
        "DETAIL_URL" => "",
        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
        "DISPLAY_COMPARE" => "N",
        "ELEMENT_COUNT" => $arCatalogTopParams["ITEMS_COUNT"],
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "ENLARGE_PRODUCT" => "STRICT",
        "FILTER_NAME" => "arCatalogTopFilter",
        "HIDE_NOT_AVAILABLE" => "N",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => IBLOCK_CATALOG_CATALOG,
        "IBLOCK_TYPE" => "catalog",
        "LABEL_PROP" => array("SALELEADER"),
        "LABEL_PROP_MOBILE" => array(),
        "LABEL_PROP_POSITION" => "top-left",
        "LINE_ELEMENT_COUNT" => $arCatalogTopParams["LINE_ELEMENT_COUNT"],
        "MESS_BTN_ADD_TO_BASKET" => "Купить",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_COMPARE" => "Сравнить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "MESS_RELATIVE_QUANTITY_FEW" => "мало",
        "MESS_RELATIVE_QUANTITY_MANY" => "много",
        "MESS_SHOW_MAX_QUANTITY" => "Наличие",
        "OFFERS_CART_PROPERTIES" => array("COLOR_REF","SIZES_SHOES","SIZES_CLOTHES"),
        "OFFERS_FIELD_CODE" => array("ID", "NAME", "PREVIEW_PICTURE", "CODE"),
        "OFFERS_LIMIT" => "0",
        "OFFERS_PROPERTY_CODE" => array("size_length", "size_width", "size_height", "sleep_size_length", "sleep_size_width", "sleep_size_height"),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_ORDER2" => "desc",
        "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
        "OFFER_TREE_PROPS" => array("COLOR_REF","SIZES_SHOES"),
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(PRICE_CODE),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_BLOCKS_ORDER" => "price,buttons",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array("NEWPRODUCT"),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "PROPERTY_CODE" => array(),
        "PROPERTY_CODE_MOBILE" => array(),
        "RELATIVE_QUANTITY_FACTOR" => "5",
        "ROTATE_TIMER" => "30",
        "SECTION_URL" => "",
        "SEF_MODE" => "N",
        "SEF_RULE" => "",
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_MAX_QUANTITY" => "N",
        "SHOW_OLD_PRICE" => "Y",
        "SHOW_PAGINATION" => "Y",
        "SHOW_PRICE_COUNT" => "1",
        "SHOW_SLIDER" => "Y",
        "SLIDER_INTERVAL" => "3000",
        "SLIDER_PROGRESS" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_ENHANCED_ECOMMERCE" => "Y",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "Y",
        "VIEW_MODE" => "SECTION",
        "SHOW_PRODUCTS_".IBLOCK_CATALOG_CATALOGSKU => "Y",
        "DEVICE_TYPE" => DEVICE_TYPE,
        "IMAGE_SIZE" => $arCatalogTopParams["IMAGE_SIZE"],
        "SECTION_TITLE" => "Лидеры продаж",
        "INCLUDE_AREA_PATH" => "/include/index/leader_text.php"
    ]
);
//end

//Новинки
$arCatalogTopParams = [
    "IMAGE_SIZE" => [
        "WIDTH" => "",
        "HEIGHT" => ""
    ],
    "ITEMS_COUNT" => 10,
    "LINE_ELEMENT_COUNT" => 4
];
if (DEVICE_TYPE == "TABLET") {
    $arCatalogTopParams["LINE_ELEMENT_COUNT"] = 2;
} elseif (DEVICE_TYPE == "MOBILE") {
    $arCatalogTopParams["LINE_ELEMENT_COUNT"] = 1;
}
$GLOBALS["arCatalogTopFilter"] = [
    "PROPERTY_status_VALUE" => "Новинка"
];
$APPLICATION->IncludeComponent(
    "bitrix:catalog.top",
    "",
    [
        "ACTION_VARIABLE" => "action",
        "ADD_PICT_PROP" => "MORE_PHOTO",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "BASKET_URL" => "/personal/basket.php",
        "BRAND_PROPERTY" => "BRAND_REF",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
        "COMPARE_PATH" => "",
        "COMPATIBLE_MODE" => "N",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "CUSTOM_FILTER" => "",
        "DATA_LAYER_NAME" => "dataLayer",
        "DETAIL_URL" => "",
        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
        "DISPLAY_COMPARE" => "N",
        "ELEMENT_COUNT" => $arCatalogTopParams["ITEMS_COUNT"],
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "ENLARGE_PRODUCT" => "STRICT",
        "FILTER_NAME" => "arCatalogTopFilter",
        "HIDE_NOT_AVAILABLE" => "N",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => IBLOCK_CATALOG_CATALOG,
        "IBLOCK_TYPE" => "catalog",
        "LABEL_PROP" => array("SALELEADER"),
        "LABEL_PROP_MOBILE" => array(),
        "LABEL_PROP_POSITION" => "top-left",
        "LINE_ELEMENT_COUNT" => $arCatalogTopParams["LINE_ELEMENT_COUNT"],
        "MESS_BTN_ADD_TO_BASKET" => "Купить",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_COMPARE" => "Сравнить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "MESS_RELATIVE_QUANTITY_FEW" => "мало",
        "MESS_RELATIVE_QUANTITY_MANY" => "много",
        "MESS_SHOW_MAX_QUANTITY" => "Наличие",
        "OFFERS_CART_PROPERTIES" => array("COLOR_REF","SIZES_SHOES","SIZES_CLOTHES"),
        "OFFERS_FIELD_CODE" => array("ID", "NAME", "PREVIEW_PICTURE", "CODE"),
        "OFFERS_LIMIT" => "0",
        "OFFERS_PROPERTY_CODE" => array("size_length", "size_width", "size_height", "sleep_size_length", "sleep_size_width", "sleep_size_height"),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_ORDER2" => "desc",
        "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
        "OFFER_TREE_PROPS" => array("COLOR_REF","SIZES_SHOES"),
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(PRICE_CODE),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_BLOCKS_ORDER" => "price,buttons",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array("NEWPRODUCT"),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "PROPERTY_CODE" => array(),
        "PROPERTY_CODE_MOBILE" => array(),
        "RELATIVE_QUANTITY_FACTOR" => "5",
        "ROTATE_TIMER" => "30",
        "SECTION_URL" => "",
        "SEF_MODE" => "N",
        "SEF_RULE" => "",
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_MAX_QUANTITY" => "N",
        "SHOW_OLD_PRICE" => "Y",
        "SHOW_PAGINATION" => "Y",
        "SHOW_PRICE_COUNT" => "1",
        "SHOW_SLIDER" => "Y",
        "SLIDER_INTERVAL" => "3000",
        "SLIDER_PROGRESS" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_ENHANCED_ECOMMERCE" => "Y",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "Y",
        "VIEW_MODE" => "SECTION",
        "SHOW_PRODUCTS_".IBLOCK_CATALOG_CATALOGSKU => "Y",
        "DEVICE_TYPE" => DEVICE_TYPE,
        "IMAGE_SIZE" => $arCatalogTopParams["IMAGE_SIZE"],
        "SECTION_TITLE" => "Новинки",
        "INCLUDE_AREA_PATH" => "/include/index/new_text.php"
    ]
);
//end

//Акционные баннеры
$imageSize = [];
if (DEVICE_TYPE == "TABLET") {
    $imageSize = [
        "WIDTH" => 296,
        "HEIGHT" => 131
    ];
} elseif (DEVICE_TYPE == "MOBILE") {
    $imageSize = [
        "WIDTH" => 275,
        "HEIGHT" => 122
    ];
}
$GLOBALS["bannerFilter"] = ["!PREVIEW_PICTURE" => false];
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "action-banner",
    [
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => IBLOCK_CONTENT_ACTION_BANNERS,
        "NEWS_COUNT" => "10",
        "SORT_BY1" => "ACTIVE_DATE",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "bannerFilter",
        "FIELD_CODE" => Array("ID", "NAME"),
        "PROPERTY_CODE" => Array(),
        "CHECK_DATES" => "N",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "arrPager",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "IMAGE_SIZE" => $imageSize
    ]
);
//end

//Скоро в продаже
$arCatalogTopParams = [
    "IMAGE_SIZE" => [
        "WIDTH" => "",
        "HEIGHT" => ""
    ],
    "ITEMS_COUNT" => 10,
    "LINE_ELEMENT_COUNT" => 4
];
if (DEVICE_TYPE == "TABLET") {
    $arCatalogTopParams["LINE_ELEMENT_COUNT"] = 2;
} elseif (DEVICE_TYPE == "MOBILE") {
    $arCatalogTopParams["LINE_ELEMENT_COUNT"] = 1;
}
$GLOBALS["arCatalogTopFilter"] = [
    "PROPERTY_status_VALUE" => "Скоро в продаже"
];
$APPLICATION->IncludeComponent(
    "bitrix:catalog.top",
    "",
    [
        "ACTION_VARIABLE" => "action",
        "ADD_PICT_PROP" => "MORE_PHOTO",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "BASKET_URL" => "/personal/basket.php",
        "BRAND_PROPERTY" => "BRAND_REF",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
        "COMPARE_PATH" => "",
        "COMPATIBLE_MODE" => "N",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "CUSTOM_FILTER" => "",
        "DATA_LAYER_NAME" => "dataLayer",
        "DETAIL_URL" => "",
        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
        "DISPLAY_COMPARE" => "N",
        "ELEMENT_COUNT" => $arCatalogTopParams["ITEMS_COUNT"],
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "ENLARGE_PRODUCT" => "STRICT",
        "FILTER_NAME" => "arCatalogTopFilter",
        "HIDE_NOT_AVAILABLE" => "N",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => IBLOCK_CATALOG_CATALOG,
        "IBLOCK_TYPE" => "catalog",
        "LABEL_PROP" => array("SALELEADER"),
        "LABEL_PROP_MOBILE" => array(),
        "LABEL_PROP_POSITION" => "top-left",
        "LINE_ELEMENT_COUNT" => $arCatalogTopParams["LINE_ELEMENT_COUNT"],
        "MESS_BTN_ADD_TO_BASKET" => "Купить",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_COMPARE" => "Сравнить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "MESS_RELATIVE_QUANTITY_FEW" => "мало",
        "MESS_RELATIVE_QUANTITY_MANY" => "много",
        "MESS_SHOW_MAX_QUANTITY" => "Наличие",
        "OFFERS_CART_PROPERTIES" => array("COLOR_REF","SIZES_SHOES","SIZES_CLOTHES"),
        "OFFERS_FIELD_CODE" => array("ID", "NAME", "PREVIEW_PICTURE", "CODE"),
        "OFFERS_LIMIT" => "0",
        "OFFERS_PROPERTY_CODE" => array("size_length", "size_width", "size_height", "sleep_size_length", "sleep_size_width", "sleep_size_height"),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_ORDER2" => "desc",
        "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
        "OFFER_TREE_PROPS" => array("COLOR_REF","SIZES_SHOES"),
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(PRICE_CODE),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_BLOCKS_ORDER" => "price,buttons",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array("NEWPRODUCT"),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "PROPERTY_CODE" => array(),
        "PROPERTY_CODE_MOBILE" => array(),
        "RELATIVE_QUANTITY_FACTOR" => "5",
        "ROTATE_TIMER" => "30",
        "SECTION_URL" => "",
        "SEF_MODE" => "N",
        "SEF_RULE" => "",
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_MAX_QUANTITY" => "N",
        "SHOW_OLD_PRICE" => "Y",
        "SHOW_PAGINATION" => "Y",
        "SHOW_PRICE_COUNT" => "1",
        "SHOW_SLIDER" => "Y",
        "SLIDER_INTERVAL" => "3000",
        "SLIDER_PROGRESS" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_ENHANCED_ECOMMERCE" => "Y",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "Y",
        "VIEW_MODE" => "SECTION",
        "SHOW_PRODUCTS_".IBLOCK_CATALOG_CATALOGSKU => "Y",
        "DEVICE_TYPE" => DEVICE_TYPE,
        "IMAGE_SIZE" => $arCatalogTopParams["IMAGE_SIZE"],
        "SECTION_TITLE" => "Скоро в продаже",
        "INCLUDE_AREA_PATH" => "/include/index/soon_text.php"
    ]
);
//end

//Форма подписки
$APPLICATION->IncludeComponent(
    "bitrix:subscribe.form",
    "",
    [
        "USE_PERSONALIZATION" => "Y",
        "PAGE" => "",
        "SHOW_HIDDEN" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600"
    ]
);
//end

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
