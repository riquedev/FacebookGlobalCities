<?php

namespace rqdev\Facebook\utils;

/**
 * Esta classe busca cidades por termo.
 * Atenção, o próprio Facebook é utilizado para esta busca, então todos retornos
 * são de responsabildiade do mesmo.
 * @author Henrique da Silva Santos <rique_dev@hotmail.com>
 * @link <https://github.com/riquedev>
 */
class GlobalCities {

    protected $value = '';
    protected $use_unicorn = true;
    protected $curl;
    protected $requestArray = array();
    protected $responseText;
    protected $responseError;
    protected $locale = null;
    protected $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36';
    protected $useHttps = true;
    protected $lid = null;
    protected $cities = array();

    const _USER = 0;
    const _FACEBOOK = 'facebook.com';
    const _PATH = '/ajax/typeahead/global_cities.php';

    /**
     * @return string Retorna texto da busca.
     */
    public function getValue() {
        return $this->value;
    }

    public function getUse_unicorn() {
        return $this->use_unicorn;
    }

    /**
     * @param string $value Texto da busca.
     * @return $this
     */
    public function setValue(string $value) {
        $this->value = $value;
        return $this;
    }

    public function setUse_unicorn(bool $use_unicorn) {
        $this->use_unicorn = $use_unicorn;
        return $this;
    }

    protected function HttpRequest() {

        $this->setCurl(curl_init());
        $this->setRequestArray(CURLOPT_URL, $this->getUrl())
                ->setRequestArray(CURLOPT_RETURNTRANSFER, true)
                ->setRequestArray(CURLOPT_ENCODING, '')
                ->setRequestArray(CURLOPT_MAXREDIRS, 10)
                ->setRequestArray(CURLOPT_TIMEOUT, 30)
                ->setRequestArray(CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1)
                ->setRequestArray(CURLOPT_CUSTOMREQUEST, 'GET')
                ->setRequestArray(CURLOPT_HTTPHEADER, ["accept-encoding: gzip, deflate", 'user-agent: ' . $this->userAgent, 'referer: https://facebook.com/places/'])
                ->setRequestArray(CURLOPT_CAINFO, realpath(dirname(__FILE__)) . '/ca-bundle.crt')
                ->setRequestArray(CURLOPT_FOLLOWLOCATION, true)
                ->CloseCurlArray()
                ->setResponseText(curl_exec($this->getCurl()))
                ->setResponseError(curl_error($this->getCurl()));
        curl_close($this->getCurl());
    }

    /**
     * @return array Resposta
     */
    protected function getRequestArray() {
        return $this->requestArray;
    }

    protected function setRequestArray($key, $value) {
        $this->requestArray[$key] = $value;
        return $this;
    }

    protected function getCurl() {
        return $this->curl;
    }

    protected function setCurl($curl) {
        $this->curl = $curl;
        return $this;
    }

    protected function CloseCurlArray() {
        curl_setopt_array($this->getCurl(), $this->getRequestArray());
        return $this;
    }

    protected function getUrl() {
        $url = $this->getUseHttps() ? 'https://' : 'http://';
        $url .= $this->getLocale();
        $url .= self::_FACEBOOK;
        $url .= self::_PATH;
        $url .= '?value=' . urlencode($this->getValue());
        $url .= '&use_unicorn=' . strval($this->getUse_unicorn());
        $url .= '&__user=' . self::_USER;
        $url .= '&__a=1';
        return $url;
    }

    /**
     * @return string Facebook sub-domain.
     */
    public function getLocale() {
        return $this->locale;
    }

    /**
     * 
     * @return bool
     */
    public function getUseHttps() {
        return $this->useHttps;
    }

    /**
     * @param string $locale sub-domain.
     * @return $this
     */
    public function setLocale(string $locale) {
        $this->locale = $locale ? $locale . '.' : '';
        return $this;
    }

    /**
     * @param type $useHttps 
     * @return $this
     */
    public function setUseHttps($useHttps) {
        $this->useHttps = $useHttps;
        return $this;
    }

    protected function getResponseText() {
        return $this->responseText;
    }

    protected function setResponseText($responseText) {
        $this->responseText = $responseText;
        return $this;
    }

    public function getResponseError() {
        return $this->responseError;
    }

    protected function setResponseError($responseError) {
        $this->responseError = $responseError;
        return $this;
    }

    public function Search() {
        $this->HttpRequest();
        $this->cities = $this->TranslateResponse();
        return $this;
    }

    public function GetCities() {
        if ($this->cities) {
            return (new class($this->cities) {

                        public $citiesList = [];

                        public function __construct(array $cities) {
                            $this->citiesList = $cities;
                        }

                        public function toJson(bool $pretty = false) {
                            return $pretty ? json_encode($this->citiesList, JSON_PRETTY_PRINT) : json_encode($this->citiesList);
                        }

                        public function toArray() {
                            return $this->citiesList;
                        }

                        public function toObject() {
                            return (object) json_decode($this->toJson());
                        }
                    });
        } else {
            die($this->getResponseError());
            return null;
        }
    }

    protected function TranslateResponse() {

        $clean = str_replace('for (;;);', '', $this->responseText);
        $array = json_decode($clean, true);
        $this->lid = $array['lid'];
        return $array['payload']['entries'];
    }

}
