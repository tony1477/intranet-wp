<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class CustomConfig extends BaseConfig
{
    private $websiteUrl  = 'http://localhost/web/';
    private $assetsImg  = 'public/assets/img/';
    private $assetsCss = 'public/assets/css/';
    private $assetsJs = 'public/assets/js/';

    public function getUrlWebsite() {
        return $this->websiteUrl;
    }

    public function getPublicImg($dir=null) {
        // $dir = $dir.'/' ?? '';
        if($dir!==null) $dir = $dir.'/';
        return $this->websiteUrl.$this->assetsImg.$dir;
    }
}