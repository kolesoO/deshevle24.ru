<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if (is_array($arResult)) :?>
    <nav class="header-menu col-xs-11" flex-align="start" flex-wrap="wrap">
        <?foreach ($arResult as $arItem) :?>
            <?if ($arItem["SELECTED"] == "Y") :?>
                <span class="header-menu-item active"><?=$arItem["TEXT"]?></span>
            <?else:?>
                <a href="<?=$arItem["LINK"]?>" class="header-menu-item"><?=$arItem["TEXT"]?></a>
            <?endif?>
        <?endforeach;?>
    </nav>
<?endif?>