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
    <hr class="default_hr">
    <div
            class="catalog_slider news_list_slider clearfix js-slider"
            data-autoplay="true"
            data-autoplaySpeed="5000"
            data-infinite="false"
            data-speed="1000"
            data-arrows="true"
            data-dots="false"
            data-slidesToShow="<?=$arParams["CATEGORY_ITEMS_COUNT"]?>"
    >
        <?foreach ($arResult["ITEMS"] as $arItem) :
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            if (is_array($arItem["PREVIEW_PICTURE"])) {
                $previewImagePath = $arItem["PREVIEW_PICTURE"]["SRC"];
            } else {
                $previewImagePath = $arResult["PICTURE"]["SRC"];
            }
            $dateInfo = explode(" ", $arItem["DISPLAY_ACTIVE_FROM"]);
            ?>
            <div class="news_list-item">
                <a
                        href="<?=$arItem["DETAIL_PAGE_URL"]?>"
                        class="news_list-img"
                        style="background-image:url('<?=$previewImagePath?>')"
                ></a>
                <small class="news_list-date" flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
                    <span><?=$dateInfo[0]?></span>
                    <?if (isset($dateInfo[1])) :?>
                        <span><?=$dateInfo[1]?></span>
                    <?endif?>
                </small>
                <div class="news_list-desc">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news_list-title title-5"><?=$arItem["NAME"]?></a>
                    <?=$arItem["PREVIEW_TEXT_TYPE"] == "text" ? '<p>' . $arItem["PREVIEW_TEXT"] . '</p>' : htmlspecialcharsback($arItem["PREVIEW_TEXT"])?>
                </div>
            </div>
        <?endforeach?>

    </div>
<?endif?>
