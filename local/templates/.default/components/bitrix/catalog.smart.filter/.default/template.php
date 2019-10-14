<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(true);
?>

<aside class="catalog_filter col-lg-6 js-drop_down">
    <a href="#" class="btn color full col-lg-24 js-drop_down-btn" align="center">
        <span>Скрыть фильтры</span>
        <i class="icon"></i>
    </a>
    <div class="catalog_filter-inner js-drop_down-content" is-active="true">
        <form
                name="<?=$arResult["FILTER_NAME"]?>_form"
                action="<?=$arResult["FORM_ACTION"]?>"
                method="get"
                class="catalog_filter-inner-content"
        >
            <?if ($arParams["COMPONENT_CONTAINER_ID"]) :?>
                <input type="hidden" name="bxajaxid" value="<?=$arParams["COMPONENT_CONTAINER_ID"]?>">
            <?endif?>
            <?foreach($arResult["HIDDEN"] as $arItem):?>
                <input type="hidden" name="<?=$arItem["CONTROL_NAME"]?>" id="<?=$arItem["CONTROL_ID"]?>" value="<?=$arItem["HTML_VALUE"]?>" />
            <?endforeach;?>

            <?
            //цены
            foreach ($arResult["ITEMS"] as $key=>$arItem) :?>
                <?if (isset($arItem["PRICE"])) :
                    if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                        continue;
                    ?>
                    <div class="catalog_filter-item">
                        <div class="catalog_filter-title">Цена, руб.</div>
                        <div flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
                            <input
                                    class="col-lg-11"
                                    name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                    id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                    type="text"
                                    placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")." ".number_format(floatval($arItem["VALUES"]["MIN"]["VALUE"]), 0, ".", " ")?>"
                                    onkeyup="smartFilter.keyup(this)"
                                    value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                            >
                            <input
                                    class="col-lg-11"
                                    name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                    id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                    type="text"
                                    placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")." ".number_format(floatval($arItem["VALUES"]["MAX"]["VALUE"]), 0, ".", " ")?>"
                                    onkeyup="smartFilter.keyup(this)"
                                    value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                            >
                        </div>
                    </div>
                    <?break;?>
                <?endif?>
            <?endforeach?>

            <?
            //остальные свойства
            foreach ($arResult["ITEMS"] as $key=>$arItem) :
                if(empty($arItem["VALUES"]) || isset($arItem["PRICE"]))
                    continue;
                if ($arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0))
                    continue;
                $arCur = current($arItem["VALUES"]);
                ?>
                <div class="catalog_filter-item">
                    <div class="catalog_filter-title"><?=$arItem["NAME"]?></div>
                    <div flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
                        <?switch ($arItem["DISPLAY_TYPE"]) {
                            case "B": //числа ?>
                                <input
                                        name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                        id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                        type="text"
                                        placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")." ".number_format(floatval($arItem["VALUES"]["MIN"]["VALUE"]), 0, ".", " ")?>"
                                        value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                        onkeyup="smartFilter.keyup(this)"
                                >
                                <input
                                        name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                        id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                        type="text"
                                        placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")." ".number_format(floatval($arItem["VALUES"]["MAX"]["VALUE"]), 0, ".", " ")?>"
                                        value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                        onkeyup="smartFilter.keyup(this)"
                                >
                                <?break;
                            case "F": //флажки
                                $checkedItemExist = false;
                                foreach ($arItem["VALUES"] as $val => $ar) {
                                    if ($ar["CHECKED"]) {
                                        $checkedItemExist = true;
                                        break;
                                    }
                                }
                                ?>
                                <?foreach ($arItem["VALUES"] as $val => $ar) :
                                    if (!isset($ar["URL_ID"]) || strlen($ar["URL_ID"]) == 0) {
                                        $ar["URL_ID"] = "#fff";
                                    }
                                    ?>
                                    <div class="col-lg-11 catalog_checkbox catalog_filter-option">
                                        <input
                                                type="checkbox"
                                                value="<?=$ar["HTML_VALUE"]?>"
                                                name="<?=$ar["CONTROL_NAME"]?>"
                                                id="<?=$ar["CONTROL_ID"]?>"
                                            <?if ($ar["CHECKED"]) :?> checked<?endif?>
                                                onclick="smartFilter.click(this)"
                                        >
                                        <label for="<?=$ar["CONTROL_ID"]?>">
                                            <span class="catalog_color-color" style="background-color: <?=$ar["URL_ID"]?>"></span>
                                            <span><?=$ar["VALUE"]?></span>
                                        </label>
                                    </div>
                                <?endforeach?>
                                <?break;
                        }?>
                    </div>
                </div>
            <?endforeach?>
            <div class="catalog_filter-item">
                <input
                        class="btn color hidden-lg hidden-md hidden-xs"
                        type="submit"
                        id="set_filter"
                        name="set_filter"
                        value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
                        align="center"
                >
                <div id="modef_del"<?if (!$arResult["IS_APPLIED"]) :?> style="opacity:0"<?endif?> align="center">
                    <a href="<?=$arResult["SEF_DEL_FILTER_URL"]?>"><?=GetMessage("CT_BCSF_DEL_FILTER")?></a>
                </div>
            </div>
        </form>
    </div>
</aside>
<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>