<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["ITEMS_COUNT"] > 0) :?>
    <?foreach ($arResult["ITEMS"] as $arItem) :
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <section id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="section">
            <div class="container">
                <div class="banner" flex-align="center" flex-text_align="space-between" flex-wrap="wrap">
                    <div class="banner-description col-lg-12 col-md-12 col-xs-24">
                        <div class="col-lg-21">
                            <div class="banner-title"><?=$arItem["NAME"]?></div>
                            <?=$arItem["PREVIEW_TEXT_TYPE"] == "text" ? $arItem["PREVIEW_TEXT"] : htmlspecialcharsback($arItem["PREVIEW_TEXT"])?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-24">
                        <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">
                    </div>
                </div>
            </div>
        </section>
    <?endforeach;?>
<?endif?>