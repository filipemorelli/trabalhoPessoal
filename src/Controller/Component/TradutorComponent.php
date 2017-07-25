<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Http\Client;

class TradutorComponent extends Component
{

    private $url = 'https://translate.yandex.net/api/v1.5/tr.json/translate';
    private $key = 'trnsl.1.1.20170724T223056Z.264845c0f934c32c.740c1b8dd0c1e8650da874c0d380ec13bae535fd';

    public function begin($message, $format = 'html', $lang = 'en-pt')
    {
        $c = new Client();
        $textTranslate = $c->post($this->url, [
            'key' => $this->key,
            'text' => $message,
            'format' => $format,
            'lang' => $lang
        ]);
        $result = json_decode($textTranslate->body());
        if ($result->code == 200)
        {
            return $result->text[0];
        }
        else
        {
            debug($result);
            throw new Exception("Traducao nao foi feita");
        }
        return false;
    }

}
