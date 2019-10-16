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
        <div class="title-4">Просим обратить внимание:</div>
        <p>Работы по освобождению проходов помещений от хлама,
            демонтаж дверей и т.д - в цену подъема не входят.</p>
        <p>Чтобы нам легко и быстро занести диван в комнату,
            размеры проемов Ваших дверей должны быть
            не меньше 77x192 см, а ширина коридора
            любого другого похода не меньше 107см.</p>
        <p>У нашего транспорта должна быть возможность подъехать
            к месту выгрузки. Если грузчики пронесли мебель вручную
            более 20 метров, то дальнейшее расстояние оплачивается
            из расчета: 300 рублей за каждые 15 метров.</p>
    </div>
    <div class="delivery-payment-info-item">
        <img src="<?=SITE_TEMPLATE_PATH?>/images/delivery-boxes.png">
    </div>
</div>
<div class="delivery-payment-table" flex-align="start" flex-text_align="space-between" flex-wrap="wrap">
    <table class="col-lg-18 col-md-24 col-xs-24">
        <tr>
            <td rowspan="2">груз</td>
            <td colspan="2">подъем и занос</td>
            <td rowspan="2">сборка диванов</td>
        </tr>
        <tr>
            <td>грузовой лифт</td>
            <td>ручной подъём</td>
        </tr>
        <tr>
            <td>прямой диван</td>
            <td rowspan="3">450 руб.</td>
            <td>200 руб. этаж</td>
            <td rowspan="3">450 руб.</td>
        </tr>
        <tr>
            <td>угловой диван</td>
            <td>250 руб. этаж</td>
        </tr>
        <tr>
            <td>кресло, пуф</td>
            <td>100 руб. этаж</td>
        </tr>
    </table>
    <div class="delivery-payment-table-descr col-lg-5 col-md-24 col-xs-24">
        <p>*Зависит от наличия в доме грузового лифта и веса предмета мебели.</p>
        <p>*Для покупателей, проживающих в частных домах или на первом этаже, занос стоит 450 рублей.</p>
    </div>
</div>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');