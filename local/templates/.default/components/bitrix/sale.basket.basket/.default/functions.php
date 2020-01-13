<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!function_exists("getColumnName"))
{
	function getColumnName($arHeader)
	{
		return (strlen($arHeader["name"]) > 0) ? $arHeader["name"] : GetMessage("SALE_".$arHeader["id"]);
	}
}

if (!function_exists("getColumnId"))
{
	function getColumnId($arHeader)
	{
		return $arHeader["id"];
	}
}

if (!function_exists('GetDeclNum'))
{
    function GetDeclNum($value = 1, $status = array('', 'а', 'ов')) {
        $array = array(2, 0, 1, 1, 1, 2);
        return $status[($value % 100 > 4 && $value % 100 < 20) ? 2 : $array[($value % 10 < 5) ? $value % 10 : 5]];
    }
}
