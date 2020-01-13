<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
    <div class="catalog_item-price" flex-align="start" flex-wrap="wrap" flex-text_align="space-between">
        <span>{{{TOTAL_ITEMS_PHRASE}}}</span>
        <b data-entity="basket-total-price">{{{PRICE_FORMATED}}}</b>
    </div>
</script>
