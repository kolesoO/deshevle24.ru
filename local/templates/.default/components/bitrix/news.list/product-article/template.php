<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["ITEMS_COUNT"] > 0) :?>
    <div class="articles_list" flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
        <?foreach ($arResult["ITEMS"] as $arItem) :
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $imgPath = is_array($arItem['PREVIEW_PICTURE']) ? $arItem['PREVIEW_PICTURE']['SRC'] : SITE_TEMPLATE_PATH . '/images/no-image.png';
            ?>
            <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="articles_list-item col-lg-5 col-md-11 col-xs-24">
                <div class="articles_list-img catalog_item-block" style="background-image:url('<?=$imgPath?>')">
                    <?if (strlen($arItem['PROPERTIES']['VIDEO_LINK']['VALUE']) > 0) :?>
                        <a href="#" data-popup-open="#video-popup" data-path="<?=$arItem['PROPERTIES']['VIDEO_LINK']['VALUE']?>" onclick="obAjax.getVideo('video-popup-content', event)">
                            <i class="icon icon-play"></i>
                        </a>
                    <?endif?>
                </div>
                <div class="title-5 medium"><?=$arItem['NAME']?></div>
                <div class="articles_list-desc"><?=$arItem['PREVIEW_TEXT']?></div>
            </div>
        <?endforeach?>
    </div>
<?endif?>
