<?php

namespace kDevelop\Content;

class Reviews
{
    const COUNT_MARKER = '#REVIEWS_COUNT_(\d+)#';

    const RATING_MARKER = '#REVIEWS_RATING_(\d+)#';

    const HTML_STARS_MARKER = '#REVIEWS_HTML_STARS_(\d+)#';

    /**
     * @param $productId
     * @return string|string[]
     */
    public static function getMarkeredCount($productId)
    {
        return str_replace('(\d+)', $productId, self::COUNT_MARKER);
    }

    /**
     * @param $productId
     * @return string|string[]
     */
    public static function getMarkeredRating($productId)
    {
        return str_replace('(\d+)', $productId, self::RATING_MARKER);
    }

    /**
     * @param $productId
     * @return string|string[]
     */
    public static function getMarkeredHtmlStars($productId)
    {
        return str_replace('(\d+)', $productId, self::HTML_STARS_MARKER);
    }

    /**
     * @param $rating
     * @return string
     */
    public static function getHtmlStars($rating)
    {
        $result = '';
        for ($counter = 0; $counter < 5; $counter ++) {
            $result .= $counter < $rating ? '<i class="icon icon-star"></i>' : '<i class="icon icon-star-gray-empty"></i>';
        }

        return $result;
    }

    /**
     * @param array $values
     * @return false|float
     */
    public static function getRating(array $values)
    {
        $result = round(array_sum($values) / count($values));

        return $result <= 5 ? $result : 5;
    }

    /**
     * @param array $data
     * @param $offerId
     * @return array
     */
    public static function getMarkList(array $data, $offerId)
    {
        return isset($data[$offerId])
            ? array_column($data[$offerId], 'PROPERTY_MARK_VALUE')
            : [0];
    }

    /**
     * @param $content
     */
    public static function replaceContent(&$content)
    {
        preg_match_all(self::COUNT_MARKER, $content, $countMatches);
        preg_match_all(self::RATING_MARKER, $content, $ratingMatches);
        preg_match_all(self::HTML_STARS_MARKER, $content, $htmlStarsMatches);

        if (!isset($countMatches[1])) {
            $countMatches[1] = [];
        }
        if (!isset($ratingMatches[1])) {
            $ratingMatches[1] = [];
        }
        if (!isset($htmlStarsMatches[1])) {
            $htmlStarsMatches[1] = [];
        }

        $reviewsList = [];
        $rs = \CIBlockElement::GetList(
            [],
            [
                'IBLOCK_ID' => IBLOCK_CONTENT_REVIEWS,
                'ACTIVE' => 'Y',
                'PROPERTY_PRODUCT_SKU_ID' => array_unique(
                    array_merge($countMatches[1], $ratingMatches[1])
                )
            ],
            false,
            false,
            ['ID', 'IBLOCK_ID', 'PROPERTY_MARK', 'PROPERTY_PRODUCT_SKU_ID']
        );
        while ($item = $rs->fetch()) {
            $reviewsList[$item['PROPERTY_PRODUCT_SKU_ID_VALUE']][] = $item;
        }

        foreach ($countMatches[1] as $offerId) {
            $content = str_replace(self::getMarkeredCount($offerId), count($reviewsList[$offerId]), $content);
        }
        foreach ($ratingMatches[1] as $offerId) {
            $content = str_replace(
                self::getMarkeredRating($offerId),
                self::getRating(
                    self::getMarkList($reviewsList, $offerId)
                ),
                $content
            );
        }
        foreach ($htmlStarsMatches[1] as $offerId) {
            $content = str_replace(
                self::getMarkeredHtmlStars($offerId),
                self::getHtmlStars(
                    self::getRating(
                        self::getMarkList($reviewsList, $offerId)
                    )
                ),
                $content
            );
        }
    }
}
