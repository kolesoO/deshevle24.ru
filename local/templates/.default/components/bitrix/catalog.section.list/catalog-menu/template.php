<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["SECTIONS_COUNT"] > 0) :?>
    <div class="catalog_menu-wrap">
        <div class="container">
            <div class="catalog_menu js-tabs" flex-wrap="wrap" flex-align="stretch">
                <div class="catalog_menu-nav">
                    <?foreach ($arResult["SECTIONS"] as $arSection) :
                        if (!is_array($arSection["CHILD_SECTIONS"])) continue;
                        ?>
                        <a
                                href="<?=$arSection["SECTION_PAGE_URL"]?>"
                                class="catalog_menu-nav-item"
                                data-tab_target="#catalog_menu-<?=$arSection["CODE"]?>"
                        >
                            <div
                                    class="catalog_menu-nav-img"
                                    style="background-image:url('<?=is_array($arSection["PICTURE"]) ? $arSection["PICTURE"]["SRC"] : SITE_TEMPLATE_PATH . '/images/no-image.png'?>')"
                            ></div>
                            <span><?=$arSection["NAME"]?></span>
                        </a>
                    <?endforeach?>
                </div>
                <div class="catalog_menu-main" data-tab_content>
                    <?foreach ($arResult["SECTIONS"] as $arSection) :?>
                        <?if (is_array($arSection["CHILD_SECTIONS"])) :?>
                            <div id="catalog_menu-<?=$arSection["CODE"]?>" data-tab_item flex-wrap="wrap" flex-align="start" flex-text_align="start" class="col-lg-24 col-md-24 col-xs-24">
                                <?foreach ($arSection["CHILD_SECTIONS"] as $sectionKey) :?>
                                    <a
                                            href="<?=$arResult["SECTIONS"][$sectionKey]["SECTION_PAGE_URL"]?>"
                                            class="catalog_menu-item"
                                    >
                                        <div
                                                class="catalog_menu-img"
                                                style="background-image:url('<?=is_array($arResult["SECTIONS"][$sectionKey]["PICTURE"]) ? $arResult["SECTIONS"][$sectionKey]["PICTURE"]["SRC"] : SITE_TEMPLATE_PATH . '/images/no-image.png'?>')"
                                        ></div>
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
