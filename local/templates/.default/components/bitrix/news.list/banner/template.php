<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["ITEMS_COUNT"] > 0) :?>
    <div
            class="main_slider clearfix js-slider"
            data-autoplay="true"
            data-autoplaySpeed="5000"
            data-infinite="false"
            data-speed="1000"
            data-arrows="true"
            data-dots="true"
    >
        <?foreach ($arResult["ITEMS"] as $arItem) :
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div
                    id="<?=$this->GetEditAreaId($arItem['ID']);?>"
                    class="main_slider-item" style="background-image: url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>')"
            >
                <div class="container main_slider-description"><?=$arItem["PREVIEW_TEXT_TYPE"] == "text" ? $arItem["PREVIEW_TEXT"] : htmlspecialcharsback($arItem["PREVIEW_TEXT"])?></div>
            </div>
        <?endforeach?>
    </div>
<?endif?>