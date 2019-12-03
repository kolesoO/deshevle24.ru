<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<div class="feedback-list">
    <?if ($arResult["ITEMS_COUNT"] > 0) :?>
        <?foreach ($arResult["ITEMS"] as $arItem) :
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="feedback-list-item">
                <?if (is_array($arItem["PREVIEW_PICTURE"])) :?>
                    <div flex-align="start" flex-text_align="space-between" flex-wrap="wrap">
                        <div class="user-info col-lg-18" flex-align="start" flex-text_align="space-between" flex-wrap="wrap">
                            <div class="title-5 medium"><?=$arItem["NAME"]?></div>
                            <p><?=$arItem["DISPLAY_ACTIVE_FROM"]?></p>
                            <div class="feedback-stars col-lg-24">
                                <?for ($counter = 0; $counter < $arItem["PROPERTIES"]["MARK"]["VALUE"]; $counter++) :?>
                                    <i class="icon icon-star"></i>
                                <?endfor?>
                                <?while ($counter <= 5) {?>
                                    <i class="icon icon-star-gray-empty"></i>
                                    <?
                                    $counter ++;
                                }?>
                            </div>
                            <div class="user-info-txt col-lg-24"><?=$arItem["PREVIEW_TEXT_TYPE"] == "text" ? $arItem["PREVIEW_TEXT"] : htmlspecialcharsback($arItem["PREVIEW_TEXT"])?></div>
                            <div class="feedback-like col-lg-24" flex-align="start">
                                <i class="icon <?=$arItem["PROPERTIES"]["RECOMMEND"]["VALUE_XML_ID"]?>"></i>
                                <p><?=$arItem["PROPERTIES"]["RECOMMEND"]["VALUE"]?></p>
                            </div>
                        </div>
                        <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="col-lg-5" alt="<?=$arItem["NAME"]?>">
                    </div>
                <?else:?>
                    <div class="user-info col-lg-24" flex-align="start" flex-text_align="space-between" flex-wrap="wrap">
                        <div class="title-5 medium"><?=$arItem["NAME"]?></div>
                        <p><?=$arItem["DISPLAY_ACTIVE_FROM"]?></p>
                        <div class="feedback-stars col-lg-24">
                            <?for ($counter = 0; $counter < $arItem["PROPERTIES"]["MARK"]["VALUE"]; $counter++) :?>
                                <i class="icon icon-star"></i>
                            <?endfor?>
                            <?while ($counter <= 5) {?>
                                <i class="icon icon-star-gray-empty"></i>
                                <?
                                $counter ++;
                            }?>
                        </div>
                        <div class="user-info-txt col-lg-24">
                            <p><?=$arItem["PREVIEW_TEXT_TYPE"] == "text" ? $arItem["PREVIEW_TEXT"] : htmlspecialcharsback($arItem["PREVIEW_TEXT"])?></p>
                        </div>
                        <div class="feedback-like col-lg-24" flex-align="start">
                            <i class="icon <?=$arItem["PROPERTIES"]["RECOMMEND"]["VALUE_XML_ID"]?>"></i>
                            <p><?=$arItem["PROPERTIES"]["RECOMMEND"]["VALUE"]?></p>
                        </div>
                    </div>
                <?endif?>
            </div>
        <?endforeach?>
    <?else:?>
        <div class="feedback-empty" flex-align="center" flex-wrap="wrap" flex-text_align="center">
            <div align="center">
                <i class="icon icon-chat_msg"></i>
                <br><br><br>
                <div>Отзывов пока нет</div>
                <div class="title-5 medium">Оставь отзыв первым</div>
            </div>
        </div>
    <?endif?>
</div>
