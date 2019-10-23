<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<?if ($arResult["ITEMS_COUNT"]) :?>
    <?if ($arParams["DISPLAY_TOP_PAGER"]) :?>
        <?=$arResult["NAV_STRING"]?>
        <hr class="section_hr">
    <?endif;?>
    <div class="news_list" flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
        <?foreach ($arResult["ITEMS"] as $arItem) :
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $previewImageClass = "";
            if (is_array($arItem["PREVIEW_PICTURE"])) {
                $previewImagePath = $arItem["PREVIEW_PICTURE"]["SRC"];
            } else {
                $previewImagePath = SITE_TEMPLATE_PATH."/images/no-image.png";
                $previewImageClass = " default";
            }
            ?>
            <div class="news_list-item col-lg-7 col-md-11 col-xs-24">
                <a
                        href="<?=$arItem["DETAIL_PAGE_URL"]?>"
                        class="news_list-img<?=$previewImageClass?>"
                        style="background-image:url('<?=$previewImagePath?>')"
                ></a>
                <div class="news_list-desc">
                    <small class="news_list-date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></small>
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news_list-title title-3 link"><?=$arItem["NAME"]?></a>
                </div>
            </div>
        <?endforeach;?>
    </div>
    <?if ($arParams["DISPLAY_BOTTOM_PAGER"]) :?>
        <?=$arResult["NAV_STRING"]?>
    <?endif;?>
<?endif?>