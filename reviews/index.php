<?
define("H1_IN_HEADER", "Y");
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("title", "");
$APPLICATION->SetTitle("Отзывы");
?>

<div class="feedback-btn">
    <a href="#" class="btn color btn-arrow" flex-text_align='end' data-popup-open="#myfeedback">
        <span>Оставить отзыв</span>
        <i class="icon icon-arrow"></i>
    </a>
</div>

<?
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "review",
    [
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => IBLOCK_CONTENT_REVIEWS,
        "NEWS_COUNT" => "10",
        "SORT_BY1" => "ACTIVE_DATE",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => Array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE"),
        "PROPERTY_CODE" => Array("*"),
        "CHECK_DATES" => "N",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y h.m",
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
            "WIDTH" => 320,
            "HEIGHT" => 320
        ]
    ]
);?>

<div flex-align='center' flex-text_align='center'>
    <a href="#" class="title-5 medium btn" align="center" data-popup-open="#">Все отзывы</a>
</div>

<div id="myfeedback" class="popup">
    <div class="popup_wrapper">
        <div class="popup_content js-popup_content">
            <a href="#" class="popup_content-close" data-popup-close>
                <i class="icon icon-close"></i>
            </a>
            <div class="popup_content-inner">
                <div class="title-5 medium">Мой отзыв</div>
                <br>
                <div>
                    <small>Диван</small>
                    <div class="title-2 medium">Beige</div>
                </div>
                <br>
                <form class="def_form">
                    <div class="def_form-item">
                        <input type="text" placeholder="Номер заказа" class="col-lg-24 col-md-24 col-xs-24" required>
                    </div>
                    <div class="def_form-item">
                        <input type="text" placeholder="Ваше имя" class="col-lg-24 col-md-24 col-xs-24" required>
                    </div>
                    <div class="def_form-item">
                        <textarea  name="Текст отзыва" class="col-lg-24 col-md-24 col-xs-24" placeholder="Текст отзыва" required></textarea>
                    </div>
                    <div class="def_form-item def_form_footer col-lg-24" flex-align="start" flex-text_align="space-between" flex-wrap="wrap">
                        <div class="def_form-item col-lg-15">
                            <div class="catalog_item-block" flex-align="center" flex-wrap="wrap">
                                <span class="form-item-rate title-5 medium">Поставьте оценку</span>
                                <div class="markable no-m js-markable" data-target="#mark-input">
                                    <a href="#" data-value="1">
                                        <i class="icon icon-star-gray-empty"></i>
                                    </a>
                                    <a href="#" data-value="2">
                                        <i class="icon icon-star-gray-empty"></i>
                                    </a>
                                    <a href="#" data-value="3">
                                        <i class="icon icon-star-gray-empty"></i>
                                    </a>
                                    <a href="#" data-value="4">
                                        <i class="icon icon-star-gray-empty"></i>
                                    </a>
                                    <a href="#" data-value="5">
                                        <i class="icon icon-star-gray-empty"></i>
                                    </a>
                                </div>
                                <input type="hidden" id="mark-input" value="1">
                            </div>
                            <div class="title-5 medium">Вы рекомендуете этот товар?</div>
                            <label for="like" flex-align="center" class="list_block-item pseudo_link">
                                <span class="col-lg-2">
                                    <i class="icon icon-like"></i>
                                </span>
                                    <span class="col-lg-22">
                                    <span>Да, я рекомендую эту модель!</span>
                                </span>
                            </label>
                            <label for="dislike" flex-align="center" class="list_block-item pseudo_link grey_link">
                                <span class="col-lg-2">
                                    <i class="icon icon-close static"></i>
                                </span>
                                    <span class="col-lg-22">
                                    <span>Я не рекомендую эту модель!</span>
                                </span>
                            </label>
                            <input id="like" type="radio" name="like" class="hidden-lg hidden-md hidden-xs">
                            <input id="dislike" type="radio" name="like" class="hidden-lg hidden-md hidden-xs">
                        </div>
                        <div class="col-lg-8">
                            <div class="file_input">
                                <label for="file">
                                    <i class="icon icon-file"></i>
                                    <small>Добавить<br>фотографию</small>
                                </label>
                                <input id="file" type="file">
                            </div>
                        </div>
                    </div>
                    <div class="def_form-item def_form_footer" flex-align="start" flex-text_align="space-between">
                        <button type="submit" class="btn color col-lg-14 col-md-24 col-xs-24" align="center">Отправить отзыв</button>
                        <button class="btn light_grey col-lg-8 col-md-24 col-xs-24" align="center" data-popup-close="myfeedback">Отменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
