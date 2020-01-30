<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>

<section class="section">
    <div class="container">
        <div flex-align="center" flex-text_align="space-between" flex-wrap="wrap">
            <div class="col-lg-9 col-md-12 col-xs-24">
                <div class="title-2 short_info">Будь в курсе акций и скидок</div>
                <!--p class="short_info">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p-->
            </div>
            <div id="subscribe-form" class="col-lg-14 col-md-10 col-xs-24">
                <?$frame = $this->createFrame("subscribe-form", false)->begin();?>
                    <form flex-align="stretch" flex-wrap="wrap" action="<?=$arResult["FORM_ACTION"]?>">
                        <input type="hidden" name="OK" value="<?=GetMessage("subscr_form_button")?>">
                        <div class="form-item col-lg-15 col-md-24 col-xs-24 input_icon">
                            <input type="email" name="sf_EMAIL" placeholder="Укажите ваш  Email" class="col-lg-24 col-md-24 col-xs-24" required>
                            <i class="icon icon-message"></i>
                        </div>
                        <div class="form-item col-lg-9 col-md-24 col-xs-24">
                            <button type="submit" class="btn color btn-arrow col-lg-24 col-md-24 col-xs-24">
                                <span>Подписаться</span>
                                <i class="icon icon-arrow"></i>
                            </button>
                        </div>
                    </form>
                <?$frame->beginStub();?>
                    <form flex-align="stretch" flex-wrap="wrap" action="<?=$arResult["FORM_ACTION"]?>">
                        <div class="col-lg-15 input_icon">
                            <input type="text" placeholder="Укажите ваш  Email" class="col-lg-24">
                            <i class="icon icon-message"></i>
                        </div>
                        <button type="submit" class="btn color btn-arrow col-lg-9">
                            <span>Подписаться</span>
                            <i class="icon icon-arrow"></i>
                        </button>
                    </form>
                <?$frame->end();?>
            </div>
        </div>
    </div>
</section>
