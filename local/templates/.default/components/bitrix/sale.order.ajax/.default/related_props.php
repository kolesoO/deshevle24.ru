<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?foreach ($arResult["ORDER_PROP"]["RELATED"] as $arProp) :
    //name
    $name = $arProp["NAME"].($arProp["REQUIRED"] == "Y" ? "*" : "");
    //end
    ?>
    <div class="def_form-item">
        <input
            type="text"
            name="<?=$arProp["FIELD_NAME"]?>"
            class="col-lg-24 col-md-24 col-xs-24"
            placeholder="<?=$name?>"
            value="<?=$arProp["VALUE"]?>"
        >
    </div>
<?endforeach;?>
