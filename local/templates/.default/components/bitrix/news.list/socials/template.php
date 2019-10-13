<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["ITEMS_COUNT"] > 0) :?>
    <div class="title-4">Мы в соц.сетях</div>
    <div class="footer_socials" flex-align="center" flex-wrap="wrap">
        <?foreach ($arResult["ITEMS"] as $arItem) :
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <a
                    id="<?=$this->GetEditAreaId($arItem['ID']);?>"
                    href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" class="footer_socials-item"
                    target="_blank"
                    style="background-image: url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>')"
            ></a>
        <?endforeach;?>
    </div>
<?endif?>