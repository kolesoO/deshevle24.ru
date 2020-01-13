<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["DELIVERY_COUNT"] > 0) :?>
    <div class="catalog_item-price">Выберите способ доставки</div>
    <div flex-align="center" class="catalog_item-block">
        <?foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery):
            if ($delivery_id <= 0) continue;?>
            <div class="radio-wrapper">
                <input
                    type="radio"
                    id="DELIVERY_ID_<?=$arDelivery["ID"]?>"
                    class="custom-control-input"
                    name="<?=$arDelivery["FIELD_NAME"]?>"
                    value="<?=$arDelivery["ID"]?>"
                    onchange="BX.saleOrderAjax.submitForm();"
                    <?if ($arDelivery["CHECKED"]=="Y") echo " checked";?>
                >
                <label
                    for="DELIVERY_ID_<?=$arDelivery["ID"]?>"
                    flex-align="center"
                    flex-wrap="wrap"
                >
                    <?if (is_array($arDelivery['LOGOTIP'])) :?>
                        <img src="<?=$arDelivery['LOGOTIP']['SRC']?>" alt="<?=$arDelivery["NAME"]?>">
                    <?endif?>
                    <span><?=$arDelivery["NAME"]?></span>
                </label>
            </div>
        <?endforeach;?>
    </div>
<?endif?>
