<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>


<?=$arResult["FORM_HEADER"]?>
<?if (isset($arParams["SHOW_TITLE"]) && $arParams["SHOW_TITLE"] == "Y") :?>
    <div class="title-3"><?=$arResult["arForm"]["NAME"]?></div>
<?endif?>
<div class="def_form">
    <?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) :?>
        <?if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') :?>
            <?=$arQuestion["HTML_CODE"];?>
        <?else:?>
            <div class="def_form-item"><?=$arQuestion["HTML_CODE"];?></div>
        <?endif?>
    <?endforeach?>
    <div class="def_form-item">
        <input
                type="submit"
                name="web_form_submit"
                class="btn color col-lg-24 col-md-24 col-xs-24"
                align="center"
                value="<?=$arResult["arForm"]["BUTTON"]?>"
        >
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
