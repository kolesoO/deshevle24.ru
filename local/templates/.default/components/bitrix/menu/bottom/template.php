<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if (is_array($arResult)) :?>
    <div class="footer_menu">
        <?foreach ($arResult as $arItem) :?>
            <div class="footer_menu-item">
                <?if ($arItem["SELECTED"] == "Y") :?>
                    <span class="grey_link active"><?=$arItem["TEXT"]?></span>
                <?else:?>
                    <a href="<?=$arItem["LINK"]?>" class="grey_link"><?=$arItem["TEXT"]?></a>
                <?endif?>
            </div>
        <?endforeach;?>
    </div>
<?endif?>
