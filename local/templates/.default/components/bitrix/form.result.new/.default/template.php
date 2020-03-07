<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>


<?=$arResult["FORM_HEADER"]?>
<?if (isset($arParams["SHOW_TITLE"]) && $arParams["SHOW_TITLE"] == "Y") :?>
    <div class="medium"><?=$arResult["arForm"]["NAME"]?></div>
<?endif?>
<?if (strlen($arParams['SECTION_NAME']) > 0 || strlen($arParams['PRODUCT_NAME']) > 0) :?>
    <br>
    <div class="catalog_item-block_small">
        <?if (strlen($arParams['SECTION_NAME']) > 0) :?>
            <small><?=$arParams['SECTION_NAME']?></small>
        <?endif?>
        <?if (strlen($arParams['PRODUCT_NAME']) > 0) :?>
            <div class="title-3 medium"><?=$arParams['PRODUCT_NAME']?></div>
        <?endif?>
    </div>
<?endif?>
<?if (strlen($arParams['PRODUCT_PRICE']) > 0) :?>
    <div class="catalog_item-block_small">
        <small>Цена</small>
        <div class="title-3 medium"><?=$arParams['PRODUCT_PRICE']?></div>
    </div>
    <br>
<?endif?>
<div class="def_form">
    <?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) :?>
        <?if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') :?>
            <?=$arQuestion["HTML_CODE"];?>
        <?else:?>
            <div class="def_form-item"><?=$arQuestion["HTML_CODE"];?></div>
        <?endif?>
    <?endforeach?>
    <div class="def_form-item" flex-align="stretch" flex-wrap="wrap" flex-text_align="space-between">
        <input
                type="submit"
                name="web_form_submit"
                class="btn color col-lg-10"
                align="center"
                value="<?=$arResult["arForm"]["BUTTON"]?>"
        >
        <a href="#" class="btn grey col-lg-12" align="center" data-popup-close>Отменить покупку</a>
    </div>
</div>
<?=$arResult["FORM_FOOTER"]?>

<?if ($arResult["isFormNote"] == "Y") :?>
    <script>
        $("#popup_content-success").addClass("active");
        setTimeout(function() {
            $("#popup_content-success").removeClass("active");
        }, 3000);
    </script>
<?endif?>
