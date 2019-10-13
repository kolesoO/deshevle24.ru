<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["SECTION_COUNT"] > 0) :?>
    <div class="catalog_menu-wrap">
        <div class="container">
            <div class="catalog_menu js-tabs" flex-wrap="wrap" flex-align="stretch">
                <div class="catalog_menu-nav">
                    <?foreach ($arResult["SECTIONS"] as $arSection) :
                        if ($arSection["DEPTH_LEVEL"] > 1 || !is_array($arSection["CHILD_SECTIONS"])) continue;
                        ?>
                        <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="catalog_menu-nav-item" data-tab_target="#catalog_menu-<?=$arSection["CODE"]?>">
                            <?if (is_array($arSection["PICTURE"])) :?>
                                <img src="<?=$arSection["PICTURE"]["SRC"]?>" alt="<?=$arSection["NAME"]?>">
                            <?else:?>
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/no-image.png" alt="<?=$arSection["NAME"]?>">
                            <?endif?>
                            <span><?=$arSection["NAME"]?></span>
                        </a>
                    <?endforeach?>
                </div>
                <div class="catalog_menu-main" data-tab_content>
                    <?foreach ($arResult["SECTIONS"] as $arSection) :?>
                        <?if ($arSection["DEPTH_LEVEL"] == 1 && is_array($arSection["CHILD_SECTIONS"])) :?>
                            <div id="catalog_menu-<?=$arSection["CODE"]?>" data-tab_item flex-wrap="wrap" flex-align="start" flex-text_align="start">
                                <?foreach ($arSection["CHILD_SECTIONS"] as $sectionKey) :?>
                                    <a href="<?=$arResult["SECTIONS"][$sectionKey]["SECTION_PAGE_URL"]?>" class="catalog_menu-item">
                                        <?if (is_array($arResult["SECTIONS"][$sectionKey]["PICTURE"])) :?>
                                            <img src="<?=$arResult["SECTIONS"][$sectionKey]["PICTURE"]["SRC"]?>" alt="<?=$arResult["SECTIONS"][$sectionKey]["NAME"]?>">
                                        <?else:?>
                                            <img src="<?=SITE_TEMPLATE_PATH?>/images/no-image.png" alt="<?=$arResult["SECTIONS"][$sectionKey]["NAME"]?>">
                                        <?endif?>
                                        <span><?=$arResult["SECTIONS"][$sectionKey]["NAME"]?></span>
                                    </a>
                                <?endforeach;?>
                            </div>
                        <?endif?>
                    <?endforeach;?>
                </div>
            </div>
        </div>
    </div>
<?endif;?>