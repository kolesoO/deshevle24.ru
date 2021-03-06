<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var SaleOrderAjax $component
 */

global $USER_FIELD_MANAGER;

$component = $this->__component;
$component::scaleImages($arResult['JS_DATA'], $arParams['SERVICES_IMAGES_SCALING']);

$arResult["PERSON_TYPE_COUNT"] = count($arResult["PERSON_TYPE"]);
$arResult["DELIVERY_COUNT"] = count($arResult["DELIVERY"]);
$arResult["PAY_SYSTEM_COUNT"] = count($arResult["PAY_SYSTEM"]);

//тип платеьлщика
$counter = 0;
foreach ($arResult["PERSON_TYPE"] as $arPersonType) {
    if ($arPersonType["CHECKED"] == "Y") {
        $arResult["ACTIVE_PERSON_TYPE"] = $arPersonType["ID"];
        $arResult["ACTIVE_PERSON_TYPE_KEY"] = $counter;
    }
    $counter ++;
}
//end

//свойства заказа
$groupKeys = [];
foreach ($arResult['JS_DATA']['ORDER_PROP']['groups'] as $key => &$group) {
    $groupKeys[$group['ID']] = $key;
    $group['PROPS_COUNT'] = 0;
    $group['RELATED_PROPS_COUNT'] = 0;
}
unset($group);

foreach ($arResult["ORDER_PROP"]["USER_PROPS_N"] as &$arProp) {
    $groupId = $groupKeys[$arProp['PROPS_GROUP_ID']];
    $arResult['JS_DATA']['ORDER_PROP']['groups'][$groupId]['PROPS_COUNT'] ++;
    if (isset($_REQUEST[$arProp['FIELD_NAME']])) {
        $arProp['VALUE'] = $_REQUEST[$arProp['FIELD_NAME']];
    }
}
unset($arProp);

foreach ($arResult["ORDER_PROP"]["RELATED"] as &$arProp) {
    $groupId = $groupKeys[$arProp['PROPS_GROUP_ID']];
    $arResult['JS_DATA']['ORDER_PROP']['groups'][$groupId]['RELATED_PROPS_COUNT'] ++;
    if (isset($_REQUEST[$arProp['FIELD_NAME']])) {
        $arProp['VALUE'] = $_REQUEST[$arProp['FIELD_NAME']];
    }
}
unset($arProp);
