<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["PAY_SYSTEM_COUNT"] > 0) :?>
    <div class="catalog_item-price">Выберите способ оплаты</div>
    <div class="basket-payment" flex-align="center">
        <?foreach ($arResult["PAY_SYSTEM"] as $arPaySystem) :?>
            <div class="radio-wrapper">
                <input
                        id="PAY_SYSTEM_<?=$arPaySystem["ID"]?>"
                        class="custom-control-input"
                        type="radio"
                        name="PAY_SYSTEM_ID"
                        value="<?=$arPaySystem["ID"]?>"
                        onchange="BX.saleOrderAjax.submitForm();"
                    <?if ($arPaySystem["CHECKED"] == "Y" ) echo "checked";?>
                >
                <label
                        for="PAY_SYSTEM_<?=$arPaySystem["ID"]?>"
                        flex-align="center"
                        flex-wrap="wrap"
                >
                    <?if (is_array($arPaySystem['PSA_LOGOTIP'])) :?>
                        <img src="<?=$arPaySystem['PSA_LOGOTIP']['SRC']?>" alt="<?=$arPaySystem["NAME"]?>">
                    <?endif?>
                    <span><?=$arPaySystem["NAME"]?></span>
                </label>
            </div>
        <?endforeach;?>
    </div>
<?endif;?>
