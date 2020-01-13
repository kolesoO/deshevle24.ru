<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<div class="catalog_item-price">Заполните информацию о себе</div>
<?foreach ($arResult["ORDER_PROP"]["USER_PROPS_N"] as $arProp) :
    //name
    $name = $arProp["NAME"].($arProp["REQUIRED"] == "Y" ? "*" : "");
    //end
    //type
    $type = "text";
    if ($arProp["IS_PHONE"] == "Y") {
        $type = "tel";
    } elseif ($arProp["IS_EMAIL"] == "Y") {
        $type = "email";
    }
    //end
    ?>
    <?if ($arProp["IS_LOCATION"] == "Y") :?>
        <input
            type="hidden"
            name="<?=$arProp["FIELD_NAME"]?>"
            value="<?=$arProp["DEFAULT_VALUE"]?>"
        >
    <?else:?>
        <div class="def_form-item">
            <input
                    type="<?=$type?>"
                    placeholder="<?=$name?>"
                    class="col-lg-24 col-md-24 col-xs-24"
                    name="<?=$arProp["FIELD_NAME"]?>"
                    value="<?=$arProp["VALUE"]?>"
            >
        </div>
    <?endif?>
<?endforeach?>
