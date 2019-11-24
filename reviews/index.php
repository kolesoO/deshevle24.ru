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
            <img src="<?=SITE_TEMPLATE_PATH?>/images/instagram-item.png" class="col-lg-5">
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
<div flex-align='center' flex-text_align='center'>
    <a href="#" class="title-5 medium btn" align="center" data-popup-open="#">Все отзывы</a>
</div>

<div id="myfeedback" class="popup">
    <div class="popup_wrapper">
        <div class="popup_content js-popup_content">
            <a href="#" class="popup_content-close" data-popup-close>
                <i class="icon icon-close"></i>
            </a>
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
                        <div>
                            <span class="form-item-rate title-5 medium">Поставьте оценку</span>
                            <a href="#"><i class="icon icon-star-gray-empty"></i></a>
                            <a href="#"><i class="icon icon-star-gray-empty"></i></a>
                            <a href="#"><i class="icon icon-star-gray-empty"></i></a>
                            <a href="#"><i class="icon icon-star-gray-empty"></i></a>
                            <a href="#"><i class="icon icon-star-gray-empty"></i></a>
                        </div>
                        <br>
                        <div class="title-5 medium">Вы рекомендуете этот товар?</div>
                        <br>
                        <div flex-align="start">
                            <div class="col-lg-2">
                                <i class="icon icon-like-black"></i>
                            </div>
                            <div class="col-lg-22">
                                <a href="#">Да, я рекомендую эту модель!</a>
                            </div>
                        </div>
                        <div flex-align="start">
                            <div class="col-lg-2">
                                <i class="icon icon-close dark"></i>
                            </div>
                            <div class="col-lg-22">
                                <a href="#">Я не рекомендую эту модель!</a>
                            </div>
                        </div>
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
                    <button type="submit" class="btn color col-lg-13 col-md-24 col-xs-24" align="center">Отправить отзыв</button>
                    <button class="btn light_grey col-lg-9 col-md-24 col-xs-24" align="center" data-popup-close="myfeedback">Отменить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
