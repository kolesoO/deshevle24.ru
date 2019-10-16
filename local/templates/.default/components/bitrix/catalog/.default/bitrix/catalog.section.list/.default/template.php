<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if ($arResult["SECTION_COUNT"] > 0) :?>
    <div class="catalog_section" flex-align="start" flex-wrap="wrap">
        <?foreach ($arResult["SECTIONS"] as $arSection) :
            $bgImg = (is_array($arSection["PICTURE"])) ? $arSection["PICTURE"]["SAFE_SRC"] : SITE_TEMPLATE_PATH . "/images/no-image.png";
            ?>
            <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="catalog_section-item">
                <div
                        class="catalog_item-block catalog_item-img"
                        style="background-image: url('<?=$bgImg?>')"
                ></div>
                <div align="center"><?=$arSection["NAME"]?></div>
            </a>
        <?endforeach;?>
    </div>
    <hr class="section_hr">
<?endif;?>