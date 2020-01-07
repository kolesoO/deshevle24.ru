<?
use \Bitrix\Main;

$rsManager = Main\EventManager::getInstance();

//Классы
Main\Loader::registerAutoLoadClasses(null, [
    "\kDevelop\Help\Hload" => "/local/php_interface/classes/help/hload.php",
    "\kDevelop\Help\Mobile_Detect" => "/local/php_interface/classes/help/mobile_detect.php",
    "\kDevelop\Help\Tools" => "/local/php_interface/classes/help/tools.php",
    "\kDevelop\Settings\Store" => "/local/php_interface/classes/settings/store.php",
    "\kDevelop\Ajax\MsgHandBook" => "/local/php_interface/classes/ajax/msgHandBook.php",
    "\kDevelop\Ajax\Favorite" => "/local/php_interface/classes/ajax/lib/favorite.php",
    "\kDevelop\Content\ProductArticles" => "/local/php_interface/classes/content/productArticles.php",
    "\kDevelop\Content\Reviews" => "/local/php_interface/classes/content/reviews.php"
]);
//end

//Обработчики событий
if (strpos($APPLICATION->GetCurDir(), "/bitrix/admin") === false) {
    //main module
    $rsManager->addEventHandler("main", "OnProlog", ["\kDevelop\Help\Tools", "setDeviceType"], false, 100);
    $rsManager->addEventHandler("main", "OnProlog", ["\kDevelop\Settings\Store", "setStore"], false, 200);
    $rsManager->addEventHandler("main", "OnProlog", ["\kDevelop\Help\Tools", "defineAjax"], false, 300);
    $rsManager->addEventHandler("main", "OnEndBufferContent", ["\kDevelop\Content\ProductArticles", "replaceContent"], false, 100);
    $rsManager->addEventHandler("main", "OnEndBufferContent", ["\kDevelop\Content\Reviews", "replaceContent"], false, 200);
    //end
    \kDevelop\Help\Tools::definders();
} else {
    //iblock module

    //end
}
//end
