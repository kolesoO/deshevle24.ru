<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["SECTION_COUNT"] > 0) :?>
    <?foreach ($arResult["SECTIONS"] as $arSection) :
        if (!is_array($arSection["CHILD_SECTIONS"])) continue;
        $bgImg = (is_array($arSection["PICTURE"])) ? $arSection["PICTURE"]["SAFE_SRC"] : SITE_TEMPLATE_PATH . "/images/no-image.png";
        ?>
        <?if (isset($arSection["UF_SECTION_LABEL"])) :?>
            <div class="catalog_label"><?=$arSection["UF_SECTION_LABEL"]["VALUE"]?></div>
        <?endif?>
        <?if (isset($arSection["NAME"])) :?>
            <div class="title-2 medium"><?=$arSection["NAME"]?></div>
        <?endif?>
        <div class="catalog_section" flex-align="start" flex-wrap="wrap">
            <?foreach ($arSection["CHILD_SECTIONS"] as $childSection) :
                $bgImg = (is_array($childSection["PICTURE"])) ? $childSection["PICTURE"]["SAFE_SRC"] : SITE_TEMPLATE_PATH . "/images/no-image.png";
                ?>
                <a href="<?=$childSection["SECTION_PAGE_URL"]?>" class="catalog_section-item">
                    <div
                            class="catalog_item-block catalog_item-img"
                            style="background-image: url('<?=$bgImg?>')"
                    ></div>
                    <div align="center"><?=$childSection["NAME"]?></div>
                </a>
            <?endforeach;?>
        </div>
        <hr class="section_hr">
    <?endforeach;?>
<?endif;?>
