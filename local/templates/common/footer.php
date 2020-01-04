<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

    <?if (defined("H1_IN_HEADER") && H1_IN_HEADER == "Y"):?>
        </div></section>
    <?endif?>
    </main>
    <footer class="footer">
        <div class="container" flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
            <div class="footer-item col-lg-4 col-md-7 col-xs-24">
                <div class="col-lg-20">
                    <div class="logo">
                        <?
                        echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/logo.svg');
                        /*$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            [
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/header/logo.php"
                            ],
                            false
                        );*/
                        ?>
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        [
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH . "/include/footer/contacts.php"
                        ],
                        false
                    );?>
                </div>
            </div>
            <div class="footer-item col-lg-4 col-md-7 col-xs-24">
                <div class="col-lg-20">
                    <div class="title-5">Инфо для покупателей</div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bottom",
                        Array(
                            "ROOT_MENU_TYPE" => "bottom",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "bottom",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );?>
                    <a href="#" class="btn dark_grey col-lg-24 col-md-24 col-xs-24" align="center" data-popup-open="#callback">
                        <span class="title-5 medium">Заказать звонок</span>
                    </a>
                    <br>
                    <br>
                    <a href="#" class="btn dark_grey col-lg-24 col-md-24 col-xs-24" align="center" data-popup-open="#callback">
                        <span class="title-5 medium">Написать нам</span>
                    </a>
                </div>
            </div>
            <div class="footer-item col-lg-5 col-md-7 col-xs-24">
                <div class="col-lg-21">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        [
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH . "/include/footer/shops.php"
                        ],
                        false
                    );?>
                    <div class="footer_shops">
                        <?
                        //соц сети
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "socials",
                            [
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "AJAX_MODE" => "N",
                                "IBLOCK_TYPE" => "content",
                                "IBLOCK_ID" => IBLOCK_CONTENT_SOCIALS,
                                "NEWS_COUNT" => "10",
                                "SORT_BY1" => "ACTIVE_DATE",
                                "SORT_ORDER1" => "DESC",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER2" => "ASC",
                                "FILTER_NAME" => "",
                                "FIELD_CODE" => Array("ID", "NAME", "PREVIEW_PICTURE"),
                                "PROPERTY_CODE" => Array("LINK", "IMAGE"),
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
                                "IMAGE_SIZE" => [
                                    "WIDTH" => "",
                                    "HEIGHT" => ""
                                ]
                            ]
                        );
                        //end
                        ?>
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        [
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_TEMPLATE_PATH . "/include/footer/ready-to-pay.php"
                        ],
                        false
                    );?>
                </div>
            </div>
            <?if (DEVICE_TYPE == "DESKTOP") :?>
                <div class="col-lg-9">
                    <div class="title-5">Каталог</div>
                    <div flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
                        <div class="col-lg-10">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:catalog.section.list",
                                "footer",
                                [
                                    "VIEW_MODE" => "TEXT",
                                    "SHOW_PARENT_NAME" => "Y",
                                    "IBLOCK_TYPE" => "catalog",
                                    "IBLOCK_ID" => IBLOCK_CATALOG_CATALOG,
                                    "SECTION_ID" => "",
                                    "SECTION_CODE" => "divany_i_kresla",
                                    "SECTION_URL" => "",
                                    "COUNT_ELEMENTS" => "N",
                                    "TOP_DEPTH" => "3",
                                    "SECTION_FIELDS" => "",
                                    "SECTION_USER_FIELDS" => "",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_NOTES" => "",
                                    "CACHE_GROUPS" => "Y"
                                ]
                            );?>
                        </div>
                        <div class="col-lg-13">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:catalog.section.list",
                                "footer",
                                [
                                    "VIEW_MODE" => "TEXT",
                                    "SHOW_PARENT_NAME" => "Y",
                                    "IBLOCK_TYPE" => "catalog",
                                    "IBLOCK_ID" => IBLOCK_CATALOG_CATALOG,
                                    "SECTION_ID" => "",
                                    "SECTION_CODE" => "matrasy_porolon_i_laty",
                                    "SECTION_URL" => "",
                                    "COUNT_ELEMENTS" => "N",
                                    "TOP_DEPTH" => "3",
                                    "SECTION_FIELDS" => "",
                                    "SECTION_USER_FIELDS" => "",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_NOTES" => "",
                                    "CACHE_GROUPS" => "Y"
                                ]
                            );?>
                        </div>
                    </div>
                </div>
            <?endif?>
        </div>
        <div class="container footer_copyright" flex-align="center" flex-wrap="wrap" flex-text_align="space-between">
            <div class="developers col-lg-4">
                <div>Разработка сайта: <a href="#">Вячеслав Корнев</a></div>
                <div>Верстка сайта: <a href="#">Алексей Колесниченко</a></div>
            </div>
            <div class="col-lg-19">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    [
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/footer/copyright.php"
                    ],
                    false
                );?>
            </div>
        </div>
    </footer>
    <noindex>
        <div id="callback" class="popup">
            <div class="popup_wrapper">
                <div class="popup_content small js-popup_content">
                    <a href="#" class="popup_content-close" data-popup-close>
                        <i class="icon icon-close"></i>
                    </a>
                    <div class="popup_content-inner">
                        <div class="js-tabs">
                            <div class="content_tab" flex-align="center" flex-wrap="wrap" flex-text_align="space-between">
                                <a href="#" class="content_tab-item" data-tab_target="#callback-form">Перезвоните мне</a>
                                <a href="#" class="content_tab-item" data-tab_target="#question-form">Задать вопрос</a>
                            </div>
                            <div data-tab_content>
                                <div id="callback-form" data-tab_item>
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:form.result.new",
                                        "",
                                        [
                                            "SEF_MODE" => "N",
                                            "WEB_FORM_ID" => WEB_FORM_CALLBACK,
                                            "LIST_URL" => "",
                                            "EDIT_URL" => "",
                                            "SUCCESS_URL" => "",
                                            "CHAIN_ITEM_TEXT" => "",
                                            "CHAIN_ITEM_LINK" => "",
                                            "IGNORE_CUSTOM_TEMPLATE" => "Y",
                                            "USE_EXTENDED_ERRORS" => "Y",
                                            "CACHE_TYPE" => "A",
                                            "CACHE_TIME" => "3600",
                                            "AJAX_MODE" => "Y",
                                            "AJAX_OPTION_SHADOW" => "N",
                                            "AJAX_OPTION_JUMP" => "N",
                                            "AJAX_OPTION_STYLE" => "Y",
                                            "AJAX_OPTION_HISTORY" => "N"
                                        ]
                                    );?>
                                </div>
                                <div id="question-form" data-tab_item>
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:form.result.new",
                                        "",
                                        [
                                            "SEF_MODE" => "N",
                                            "WEB_FORM_ID" => WEB_FORM_QUESTION,
                                            "LIST_URL" => "",
                                            "EDIT_URL" => "",
                                            "SUCCESS_URL" => "",
                                            "CHAIN_ITEM_TEXT" => "",
                                            "CHAIN_ITEM_LINK" => "",
                                            "IGNORE_CUSTOM_TEMPLATE" => "Y",
                                            "USE_EXTENDED_ERRORS" => "Y",
                                            "CACHE_TYPE" => "A",
                                            "CACHE_TIME" => "3600",
                                            "AJAX_MODE" => "Y",
                                            "AJAX_OPTION_SHADOW" => "N",
                                            "AJAX_OPTION_JUMP" => "N",
                                            "AJAX_OPTION_STYLE" => "Y",
                                            "AJAX_OPTION_HISTORY" => "N"
                                        ]
                                    );?>
                                </div>
                            </div>
                        </div>
                        <div id="popup_content-success" class="popup_content-success">
                            <div flex-align="center" flex-text_align="center" flex-wrap="wrap">
                                <div>
                                    <div class="popup_content-success-title col-lg-24 col-md-24 col-xs-24">Спасибо!</div>
                                    <span>Менеджер перезвонит Вам <br>в ближайшее время.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="fast-product" class="popup">
            <div class="popup_wrapper">
                <div class="popup_content product js-popup_content">
                    <a href="#" class="popup_content-close" data-popup-close>
                        <i class="icon icon-close"></i>
                    </a>
                    <div id="fast-product-content" class="popup_content-inner"></div>
                </div>
            </div>
        </div>
    </noindex>
</body>
</html>
