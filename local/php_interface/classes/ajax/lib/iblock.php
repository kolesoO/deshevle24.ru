<?
namespace kDevelop\Ajax;

class Iblock
{
    use MsgHandBook;

    /**
     * @param array $arParams
     * @return array
     */
    public static function add(array $arParams)
    {
        global $USER;

        $arReturn = ["js_callback" => isset($arParams['js_callback']) ? $arParams['js_callback'] : ''];
        $arFields = [
            "MODIFIED_BY" => $USER->GetID(),
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "ACTIVE" => "N"
        ];

        if (intval($arParams["IBLOCK_ID"]) == 0) {
            $arReturn["msg"] = self::getMsg("IBLOCK_NOT_FOUND");
        } else {
            //полготовка полей
            foreach ($arParams as $code => $value) {
                if ($code == "PROPERTIES") {
                    foreach ($value as $propCode => $propValue) {
                        if (is_array($propValue) && count($propValue) > 0) {
                            $newValue = [];
                            foreach ($propValue as $key => $valueItem) {
                                $newValue["n".$key] = [
                                    "VALUE" => $valueItem,
                                    "DESCRIPTION" => $arParams["DESCRIPTION"][$propCode][$key]
                                ];
                            }
                            $propValue = $newValue;
                        }
                        $arFields["PROPERTY_VALUES"][$propCode] = $propValue;
                    }
                } elseif ($code == 'FILES') {
                    foreach ($value as $fieldCode) {
                        $arFields[$fieldCode] = $_FILES[$fieldCode];
                    }
                } else {
                    $arFields[$code] = $value;
                }
            }
            //end

            return $_REQUEST;

            //добавление или обновление
            $obElem = new \CIblockElement();
            if (intval($arParams["ID"]) == 0) {
                $elemId = $obElem->Add($arFields);
                if (intval($elemId) == 0) {
                    $arReturn["msg"] = self::getMsg("ADD_TO_IBLOCK_ERROR", $obElem->LAST_ERROR);
                } else {
                    $arReturn["new_item"] = true;
                    $arReturn["id"] = $elemId;
                }
            } else {
                $arReturn["id"] = $arParams["ID"];
                if (!$obElem->Update($arParams["ID"], $arFields)) {
                    $arReturn["msg"] = self::getMsg("UPDATE_IN_IBLOCK_ERROR", $obElem->LAST_ERROR);
                }
            }
            //end
        }

        return $arReturn;
    }
}
