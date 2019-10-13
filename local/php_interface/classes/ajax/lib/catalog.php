<?
namespace kDevelop\Ajax;

class Catalog
{
    private static $arDefIbFields = ["ID", "IBLOCK_ID", "NAME"];

    /**
     * @param $arParams
     * @return array
     */
    public static function getFastProduct($arParams)
    {
        global $APPLICATION;

        ob_start();
        $APPLICATION->IncludeComponent();
        $return = ob_get_contents();
        ob_end_clean();

        return ["js_callback" => "getFastProductCallBack", "html" => $return];
    }
}