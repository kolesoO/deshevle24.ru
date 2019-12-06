<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["SECTIONS_COUNT"] > 0) :?>
    <div class="footer_menu-item light"><?=$arResult["SECTION"]["UF_SECTION_LABEL"]["VALUE"]?></div>
    <?foreach ($arResult["SECTIONS"] as $key => $arSection) :
        $this->AddEditAction(
            $arSection['ID'],
            $arSection['EDIT_LINK'],
            CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT")
        );
        $this->AddDeleteAction(
            $arSection['ID'],
            $arSection['DELETE_LINK'],
            CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE"),
            array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'))
        );
        ?>
        <div id="<?=$this->GetEditAreaId($arSection['ID'])?>" class="footer_menu-item">
            <?=str_repeat('-&nbsp;', $arSection["DEPTH_LEVEL"] - 2)?>
            <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="grey_link"><?=$arSection["NAME"]?></a>
        </div>
    <?endforeach?>
<?endif?>
