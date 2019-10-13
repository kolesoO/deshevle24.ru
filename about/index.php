<?
define("H1_IN_HEADER", "Y");
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("title", "");
$APPLICATION->SetTitle("О компании");
?>

<div class="delivery-payment-descr">
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        [
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/about/info.php"
        ],
        false
    );?>
</div>
<div class="company-employees-photo">
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        [
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/about/employees.php"
        ],
        false
    );?>
</div>
<div class="company-info" flex-align="start">
    <div class="company-info-item col-lg-12">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            ".default",
            [
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/about/banner-text.php"
            ],
            false
        );?>
    </div>
    <div class="company-info-item col-lg-12">
        <img src="<?=SITE_TEMPLATE_PATH?>/images/company-info-divan.png" class="company-info">
    </div>
</div>
<div class="company-text title-4" align="center">
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        [
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/about/text1.php"
        ],
        false
    );?>
</div>
<div class="company-text title-4" align="center">
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        [
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/about/more-title.php"
        ],
        false
    );?>
</div>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    [
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_TEMPLATE_PATH . "/include/about/more-items.php"
    ],
    false
);?>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');