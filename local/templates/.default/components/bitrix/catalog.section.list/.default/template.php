<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["SECTION_COUNT"] > 0) :?>
    <?
    $counter = 0;
    foreach ($arResult["SECTIONS"] as $arSection) :?>
        <?if ($arSection["DEPTH_LEVEL"] == 1 && is_array($arSection["CHILD_SECTIONS"])) :?>
            <?if ($counter > 0) :?>
                <hr class="section_hr">
            <?endif?>
            <!--div class="catalog_label"></div-->
            <div class="title-3"><?=$arSection["NAME"]?></div>
            <div class="catalog_section" flex-align="start" flex-wrap="wrap">
                <?foreach ($arSection["CHILD_SECTIONS"] as $sectionKey) :
                    $bgImg = (is_array($arResult["SECTIONS"][$sectionKey]["PICTURE"])) ? $arResult["SECTIONS"][$sectionKey]["PICTURE"]["SRC"] : SITE_TEMPLATE_PATH . "/images/no-image.png";
                    ?>
                    <a href="<?=$arResult["SECTIONS"][$sectionKey]["SECTION_PAGE_URL"]?>" class="catalog_section-item">
                        <div
                                class="catalog_item-block catalog_item-img"
                                style="background-image: url('<?=$bgImg?>')"
                        ></div>
                        <div align="center"><?=$arResult["SECTIONS"][$sectionKey]["NAME"]?></div>
                    </a>
                <?endforeach;?>
            </div>
            <?
            $counter++;
        endif?>
    <?endforeach;?>
<?endif;?>
