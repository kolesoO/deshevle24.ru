<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<div class="title-5 medium">Мой отзыв</div>
<br>
<?if (strlen($arParams['SECTION_NAME']) > 0 || strlen($arParams['PRODUCT_NAME']) > 0) :?>
    <div>
        <?if (strlen($arParams['SECTION_NAME']) > 0) :?>
            <small><?=$arParams['SECTION_NAME']?></small>
        <?endif?>
        <?if (strlen($arParams['PRODUCT_NAME']) > 0) :?>
            <div class="title-2 medium"><?=$arParams['PRODUCT_NAME']?></div>
        <?endif?>
    </div>
    <br>
<?endif?>
<form class="def_form" onsubmit="obAjax.createReview(this);return false;" enctype="multipart/form-data">
    <input type="hidden" name="class" value="Iblock">
    <input type="hidden" name="method" value="add">
    <input type="hidden" name="params[IBLOCK_ID]" value="<?=$arParams['IBLOCK_ID']?>">
    <input type="hidden" name="params[PROPERTIES][PRODUCT_SKU_ID]" value="<?=$arParams['PRODUCT_SKU_ID']?>">
    <div class="def_form-item">
        <input
                type="text"
                placeholder="Номер заказа"
                class="col-lg-24 col-md-24 col-xs-24"
                required
                name="params[PROPERTIES][ORDER]"
        >
    </div>
    <div class="def_form-item">
        <input
                type="text"
                placeholder="Ваше имя"
                class="col-lg-24 col-md-24 col-xs-24"
                required
                name="params[NAME]"
        >
    </div>
    <div class="def_form-item">
        <textarea
                name="params[PREVIEW_TEXT]"
                class="col-lg-24 col-md-24 col-xs-24"
                placeholder="Текст отзыва"
                required
        ></textarea>
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
                <input
                        type="hidden"
                        id="mark-input"
                        value="1"
                        name="params[PROPERTIES][MARK]"
                >
            </div>
            <?if (is_array($arResult['RECOMMEND'])) :?>
                <div class="title-5 medium">Вы рекомендуете этот товар?</div>
                <?foreach ($arResult['RECOMMEND']['VALUE'] as $value) :?>
                    <label for="like-<?=$value['ID']?>" flex-align="center" class="list_block-item pseudo_link">
                        <span class="col-lg-2">
                            <i class="icon <?=$value['XML_ID']?>"></i>
                        </span>
                        <span class="col-lg-22">
                            <span><?=$value['VALUE']?></span>
                        </span>
                    </label>
                <?endforeach;?>
                <?foreach ($arResult['RECOMMEND']['VALUE'] as $value) :?>
                    <input
                            id="like-<?=$value['ID']?>"
                            type="radio"
                            name="params[PROPERTIES][RECOMMEND]"
                            class="hidden-lg hidden-md hidden-xs"
                            value="<?=$value['ID']?>"
                    >
                <?endforeach;?>
            <?endif?>
        </div>
        <div class="col-lg-8">
            <div class="file_input">
                <label for="file">
                    <i class="icon icon-file"></i>
                    <small>Добавить<br>фотографию</small>
                </label>
                <input
                        id="file"
                        type="file"
                        name="PREVIEW_PICTURE"
                >
            </div>
        </div>
    </div>
    <div class="def_form-item def_form_footer" flex-align="start" flex-text_align="space-between">
        <button type="submit" class="btn color col-lg-14 col-md-24 col-xs-24" align="center">Отправить отзыв</button>
        <button class="btn light_grey col-lg-8 col-md-24 col-xs-24" align="center" data-popup-close="myfeedback">Отменить</button>
    </div>
</form>
