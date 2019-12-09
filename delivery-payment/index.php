<?
define("H1_IN_HEADER", "Y");
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("title", "");
$APPLICATION->SetTitle("Доставка и оплата");
?>

<div class="delivery-payment-descr">
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        [
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/delivery-payment/info.php"
        ],
        false
    );?>
</div>
<div class="delivery-payment-info">
    <div class="delivery-payment-info-item">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            ".default",
            [
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/delivery-payment/banner-text.php"
            ],
            false
        );?>
    </div>
    <div class="delivery-payment-info-item" flex-align="center" flex-wrap="wrap">
        <img src="<?=SITE_TEMPLATE_PATH?>/images/delivery-boxes.png">
    </div>
</div>
<div class="delivery-payment-table" flex-align="start" flex-text_align="space-between" flex-wrap="wrap">
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        [
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/delivery-payment/table.php"
        ],
        false
    );?>
    <div class="delivery-payment-table-descr col-lg-8 col-md-24 col-xs-24">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            ".default",
            [
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/delivery-payment/table-info.php"
            ],
            false
        );?>
    </div>
</div>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
