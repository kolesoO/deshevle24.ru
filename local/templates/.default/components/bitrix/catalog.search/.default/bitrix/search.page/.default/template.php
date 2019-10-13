<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<form class="col-lg-12" flex-align="stretch" flex-wrap="wrap" method="get">
    <input
            type="text"
            name="q"
            class="col-lg-15"
            placeholder="<?=GetMessage("CT_BSP_INPUT_PLACEHOLDER")?>"
            value="<?=$arResult["REQUEST"]["QUERY"]?>"
    >
    <button type="submit" class="btn color col-lg-9">Найти</button>
</form>
<hr class="section_hr">