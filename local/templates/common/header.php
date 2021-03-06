<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @global CMain $APPLICATION */
/** @global CMain $USER */

CJSCore::Init(array('ajax'));

$rsAsset = \Bitrix\Main\Page\Asset::getInstance();
$strCurPage = $APPLICATION->GetCurPage(false);
$isMainPage = $strCurPage == SITE_DIR;

//css
$rsAsset->addCss(SITE_TEMPLATE_PATH.'/fonts/Gilroy/index.min.css');
$rsAsset->addCss(SITE_TEMPLATE_PATH.'/libs/noUiSlider-14.1.0/nouislider.min.css');
$rsAsset->addCss(SITE_TEMPLATE_PATH.'/css/icons.min.css');
$rsAsset->addCss(SITE_TEMPLATE_PATH.'/css/main.min.css');
if (DEVICE_TYPE == "MOBILE") {
    $rsAsset->addCss(SITE_TEMPLATE_PATH.'/css/mobile.min.css');
} else {
    $rsAsset->addCss(SITE_TEMPLATE_PATH.'/css/desktop.min.css');
    $rsAsset->addCss(SITE_TEMPLATE_PATH.'/css/tablet.min.css');
}
//end

//js
$rsAsset->addJs(SITE_TEMPLATE_PATH.'/libs/jquery1.12.4.min.js');
$rsAsset->addJs(SITE_TEMPLATE_PATH.'/libs/slick.1.8.1.min.js');
$rsAsset->addJs(SITE_TEMPLATE_PATH.'/libs/noUiSlider-14.1.0/nouislider.min.js');
$rsAsset->addJs(SITE_TEMPLATE_PATH.'/libs/jquery.maskedinput/jquery.maskedinput.min.js');
$rsAsset->addJs(SITE_TEMPLATE_PATH.'/js/modules/slider/script.min.js');
$rsAsset->addJs(SITE_TEMPLATE_PATH.'/js/modules/tabs/script.min.js');
$rsAsset->addJs(SITE_TEMPLATE_PATH.'/js/main.min.js');
$rsAsset->addJs(SITE_TEMPLATE_PATH.'/js/ajax.min.js');
//end
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?$APPLICATION->ShowTitle()?></title>

    <?if (DEVICE_TYPE == "MOBILE") :?>
        <meta name="viewport" content="width=375, user-scalable=0">
    <?elseif (DEVICE_TYPE == "TABLET") :?>
        <meta name="viewport" content="width=768, user-scalable=0">
    <?else:?>
        <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=0">
    <?endif?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">

    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="<?=SITE_TEMPLATE_PATH?>/images/favicons/default.ico">
    <meta name="theme-color" content="#fff">
    <!--end-->

    <?$APPLICATION->ShowHead();?>
</head>
<body>
    <?if ($USER->IsAdmin()) :?>
        <div id="panel"><?$APPLICATION->ShowPanel();?></div>
    <?endif?>
    <header class="header">
        <div class="header-part">
            <div class="container">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top",
                    Array(
                        "ROOT_MENU_TYPE" => "top",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "top",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "Y",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    )
                );?>
                <div class="header-contacts col-xs-11">
                    <div flex-align="center" flex-wrap="wrap">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            [
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/header/contacts.php"
                            ],
                            false
                        );?>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-part">
            <div class="container">
                <div flex-align="center" flex-wrap="wrap">
                    <a href="#" class="header-menu_btn js-toggle_class" data-class="active" data-target=".catalog_menu-wrap">
                        <i class="icon icon-burger"><hr><hr><hr></i>
                    </a>
                    <?if ($isMainPage) :?>
                        <div class="logo">
                            <?=file_get_contents($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/logo.svg')?>
                        </div>
                    <?else:?>
                        <a href="<?=SITE_DIR?>" class="logo">
                            <?=file_get_contents($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/logo.svg')?>
                        </a>
                    <?endif?>
                </div>
                <div flex-align="center" flex-wrap="wrap">
                    <div class="header-col header_search">
                        <form action="/search/">
                            <input type="text" name="q" placeholder="Поиск">
                            <button type="submit" class="header_search-btn">
                                <i class="icon icon-search opacity"></i>
                            </button>
                        </form>
                    </div>
                    <div class="header-col">
                        <a
                                href="#"
                                data-popup-open="#favorite-list"
                                onclick="obAjax.getFavoriteList('favorites')"
                        >
                            <span class="icon-wrap">
                                <i class="icon icon-favorite opacity"></i>
                                <span id="favorite-wrapper">
                                    <?if (\kDevelop\Ajax\Favorite::getCount() > 0) :?>
                                        <span class="icon-inner"><?=\kDevelop\Ajax\Favorite::getCount()?></span>
                                    <?endif?>
                                </span>
                            </span>
                        </a>
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:sale.basket.basket.line",
                        "",
                        [
                            "HIDE_ON_BASKET_PAGES" => "Y",
                            "PATH_TO_BASKET" => SITE_DIR."checkout/",
                            "PATH_TO_ORDER" => SITE_DIR."checkout/",
                            "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                            "PATH_TO_PROFILE" => SITE_DIR."personal/",
                            "PATH_TO_REGISTER" => SITE_DIR."login/",
                            "POSITION_FIXED" => "Y",
                            "POSITION_HORIZONTAL" => "",
                            "POSITION_VERTICAL" => "",
                            "SHOW_AUTHOR" => "N",
                            "SHOW_DELAY" => "N",
                            "SHOW_EMPTY_VALUES" => "N",
                            "SHOW_IMAGE" => "N",
                            "SHOW_NOTAVAIL" => "N",
                            "SHOW_NUM_PRODUCTS" => "Y",
                            "SHOW_PERSONAL_LINK" => "N",
                            "SHOW_PRICE" => "N",
                            "SHOW_PRODUCTS" => "Y",
                            "SHOW_SUMMARY" => "N",
                            "SHOW_TOTAL_PRICE" => "N"
                        ]
                    );?>
                </div>
            </div>
        </div>
        <?
        $GLOBALS["catalogMenuFilter"] = ["=UF_FOR_MENU" => "1"];
        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "catalog-menu",
            [
                "VIEW_MODE" => "TEXT",
                "SHOW_PARENT_NAME" => "Y",
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => IBLOCK_CATALOG_CATALOG,
                "SECTION_ID" => "",
                "SECTION_CODE" => "",
                "SECTION_URL" => "",
                "COUNT_ELEMENTS" => "N",
                "TOP_DEPTH" => "2",
                "SECTION_FIELDS" => ['ID', 'NAME', 'CODE', 'SECTION_PAGE_URL', 'PICTURE'],
                "SECTION_USER_FIELDS" => ["UF_*"],
                "ADD_SECTIONS_CHAIN" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_NOTES" => "",
                "CACHE_GROUPS" => "Y",
                "FILTER_NAME" => "catalogMenuFilter"
            ]
        );?>
    </header>
    <main<?if (!$isMainPage) :?> class="inner"<?endif?>>
        <?if (!$isMainPage) :?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "",
                [
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => SITE_ID
                ]
            );?>
        <?endif?>
        <?if (defined("H1_IN_HEADER") && H1_IN_HEADER == "Y"):?>
            <section class="section">
                <div class="container">
                    <div class="title-1"><?$APPLICATION->ShowTitle(false)?></div>
        <?endif?>
