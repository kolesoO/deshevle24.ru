<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["SECTION_COUNT"] > 0) :?>
    <?foreach ($arResult["SECTIONS"] as $arSection) :
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
        <div id="<?=$this->GetEditAreaId($arSection['ID'])?>">
            <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="grey_link"><?=$arSection["NAME"]?></a>
        </div>
    <?endforeach?>
<?endif?>