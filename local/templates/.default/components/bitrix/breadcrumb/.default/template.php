<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(empty($arResult)) return "";

$strReturn = '';
$count = count($arResult);
if ($count > 0) {
    $strReturn .= '<div class="breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">';
    $strReturn .= '<div class="container">';

    //root link
    $strReturn .= '
        <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="'.SITE_DIR.'" itemprop="item">
                <span itemprop="name">Главная</span>
            </a>
            <meta itemprop="position" content="1" />
        </span>
        <span>/</span>
    ';
    //end

    foreach ($arResult as $key => $arItem) {
        $strReturn .= '
            <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="'.$arItem["LINK"].'" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" itemprop="item">
                    <span itemprop="name">'.$arItem["TITLE"].'</span>
                </a>
                <meta itemprop="position" content="'.($key + 2).'" />
            </span>
        ';
        if ($key < $count - 1) {
            $strReturn .= '<span>/</span>';
        }
    }
    $strReturn .= '</div>';
    $strReturn .= '</div>';
}

return $strReturn;