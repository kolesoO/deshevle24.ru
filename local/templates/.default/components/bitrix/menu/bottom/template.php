<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if (is_array($arResult)) :?>
    <?foreach ($arResult as $arItem) :?>
        <div>
            <?if ($arItem["SELECTED"] == "Y") :?>
                <span class="grey_link active"><?=$arItem["TEXT"]?></span>
            <?else:?>
                <a href="<?=$arItem["LINK"]?>" class="grey_link"><?=$arItem["TEXT"]?></a>
            <?endif?>
        </div>
    <?endforeach;?>
<?endif?>