<?php

/**
 * This file is part of the YFeed package.
 *
 * @author (c) Yakamara Media GmbH & Co. KG
 * @author thomas.blum@redaxo.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Instagram\Instagram;
use Instagram\Media;

class rex_yfeed_stream_instagram_user extends rex_yfeed_stream_instagram_abstract
{
    public function getTypeName()
    {
        return rex_i18n::msg('yfeed_instagram_user');
    }

    public function getTypeParams()
    {
        return [
            [
                'label' => rex_i18n::msg('yfeed_instagram_user_id'),
                'name' => 'user',
                'type' => 'string',
            ],
            [
                'label' => rex_i18n::msg('yfeed_instagram_count'),
                'name' => 'count',
                'type' => 'select',
                'options' => [5 => 5, 10 => 10, 15 => 15, 20 => 20, 30 => 30, 50 => 50, 75 => 75, 100 => 100],
                'default' => 10,
            ],
        ];
    }

    protected function fetchItemsFromOfficialApi(Instagram $instagram)
    {
        $user = $instagram->getUser($this->typeParams['user']);

        return $user->getMedia(['count' => $this->typeParams['count']]);
    }

    protected function fetchItemsFromFrontendApi()
    {
        return Bolandish\Instagram::getMediaByUserID($this->typeParams['user'], $this->typeParams['count']);
    }
}
