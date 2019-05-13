<?php

namespace Templating\Extension;

use Templating\Helper\AssetHelper;
use Templating\Helper\ColorHelper;
use Templating\Helper\DummyHelper;
use Templating\Helper\FakerHelper;
use Templating\Helper\PhpHelper;

use Twig_Extension;
use Twig_Function;

/**
 */
class FrontendExtension extends Twig_Extension
{

    /**
     * @var string
     */
    private $locale;

    /**
     * @var AssetHelper
     */
    private $assetHelper;

    /**
     * @var ColorHelper
     */
    private $colorHelper;

    /**
     * @var DummyHelper
     */
    private $dummyHelper;

    /**
     * @var FakerHelper
     */
    private $fakeHelper;

    /**
     * @var PhpHelper
     */
    private $phpHelper;


    public function __construct(string $locale = 'es_ES')
    {
        $this->locale = $locale;
        $this->assetHelper = new AssetHelper();
        $this->colorHelper = new ColorHelper();
        $this->dummyHelper = new DummyHelper();
        $this->fakeHelper = new FakerHelper($locale);
        $this->phpHelper = new PhpHelper();
    }


    public function getFilters()
    {
        // TODO: Implement getFilters() method.
        return [];
    }

    public function getFunctions()
    {
        return [
            new Twig_Function('asset', [$this->assetHelper, 'asset']),
            new Twig_Function('image', [$this->assetHelper, 'image']),
            new Twig_Function('uuid', [$this->assetHelper, 'uuid']),

            new Twig_Function('hexToRgb', [$this->colorHelper, 'rgbToHex']),
            new Twig_Function('rgbToHex', [$this->colorHelper, 'hexToRgb']),
            new Twig_Function('lighten', [$this->colorHelper, 'lighten']),
            new Twig_Function('darken', [$this->colorHelper, 'darken']),

            new Twig_Function('dummy', [$this->dummyHelper, 'dummy']),
            new Twig_Function('dummyCollection', [$this->dummyHelper, 'dummyCollection']),
            new Twig_Function('dummyImage', [$this->dummyHelper, 'dummyImage']),
            new Twig_Function('dummyImageSrc', [$this->dummyHelper, 'dummyImageSrc']),
            new Twig_Function('dummyAudio', [$this->dummyHelper, 'dummyAudio']),
            new Twig_Function('dummyAudioSrc', [$this->dummyHelper, 'dummyAudioSrc']),
            new Twig_Function('dummyVideo', [$this->dummyHelper, 'dummyVideo']),
            new Twig_Function('dummyVideoSrc', [$this->dummyHelper, 'dummyVideoSrc']),

            new Twig_Function('fakeName', [$this->fakeHelper, 'fakeName']),
            new Twig_Function('fakeAddress', [$this->fakeHelper, 'fakeAddress']),
            new Twig_Function('fakePhoneNumber', [$this->fakeHelper, 'fakePhoneNumber']),
            new Twig_Function('fakeText', [$this->fakeHelper, 'fakeText']),
            new Twig_Function('fakeWords', [$this->fakeHelper, 'fakeWords']),
            new Twig_Function('fakeSentence', [$this->fakeHelper, 'fakeSentence']),
            new Twig_Function('fakeParagraph', [$this->fakeHelper, 'fakeParagraph']),
            new Twig_Function('fakeInt', [$this->fakeHelper, 'fakeInt']),
            new Twig_Function('fakeFloat', [$this->fakeHelper, 'fakeFloat']),
            new Twig_Function('fakeRandomInt', [$this->fakeHelper, 'fakeRandomInt']),
            new Twig_Function('fakeTime', [$this->fakeHelper, 'fakeTime']),
            new Twig_Function('fakeDate', [$this->fakeHelper, 'fakeDate']),
            new Twig_Function('fakeUnixTime', [$this->fakeHelper, 'fakeUnixTime']),
            new Twig_Function('fakeDateTime', [$this->fakeHelper, 'fakeDateTime']),
            new Twig_Function('fakeEmail', [$this->fakeHelper, 'fakeEmail']),
            new Twig_Function('fakeUsername', [$this->fakeHelper, 'fakeUsername']),
            new Twig_Function('fakePassword', [$this->fakeHelper, 'fakePassword']),
            new Twig_Function('fakeDomainName', [$this->fakeHelper, 'fakeDomainName']),
            new Twig_Function('fakeUrl', [$this->fakeHelper, 'fakeUrl']),
            new Twig_Function('fakeIp4', [$this->fakeHelper, 'fakeIp4']),
            new Twig_Function('fakeIp6', [$this->fakeHelper, 'fakeIp6']),
            new Twig_Function('fakeMacAddress', [$this->fakeHelper, 'fakeMacAddress']),
            new Twig_Function('fakeUserAgent', [$this->fakeHelper, 'fakeUserAgent']),
            new Twig_Function('fakeCreditCardNumber', [$this->fakeHelper, 'fakeCreditCardNumber']),
            new Twig_Function('fakeCreditCardExpiration', [$this->fakeHelper, 'fakeCreditCardExpiration']),
            new Twig_Function('fakeIban', [$this->fakeHelper, 'fakeIban']),
            new Twig_Function('fakeHexColor', [$this->fakeHelper, 'fakeHexColor']),
            new Twig_Function('fakeRgbColor', [$this->fakeHelper, 'fakeRgbColor']),
            new Twig_Function('fakeColorName', [$this->fakeHelper, 'fakeColorName']),
            new Twig_Function('fakeFileExtension', [$this->fakeHelper, 'fakeFileExtension']),
            new Twig_Function('fakeMediaType', [$this->fakeHelper, 'fakeMediaType']),
            new Twig_Function('fakeUuid', [$this->fakeHelper, 'fakeUuid']),
            new Twig_Function('fakeMd5', [$this->fakeHelper, 'fakeMd5']),
            new Twig_Function('fakeSha1', [$this->fakeHelper, 'fakeSha1']),
            new Twig_Function('fakeSha256', [$this->fakeHelper, 'fakeSha256']),
            new Twig_Function('fakeCountryCode', [$this->fakeHelper, 'fakeCountryCode']),
            new Twig_Function('fakeLanguageCode', [$this->fakeHelper, 'fakeLanguageCode']),
            new Twig_Function('fakeCurrencyCode', [$this->fakeHelper, 'fakeCurrencyCode']),
            new Twig_Function('fakeRandomHtml', [$this->fakeHelper, 'fakeRandomHtml']),

            new Twig_Function('phpClassName', [$this->phpHelper, 'phpClassName']),
            new Twig_Function('phpNamespaceName', [$this->phpHelper, 'phpNamespaceName']),
            new Twig_Function('phpShortClassName', [$this->phpHelper, 'phpShortClassName']),
            new Twig_Function('phpGlobals', [$this->phpHelper, 'phpGlobals']),
            new Twig_Function('phpGlobalGet', [$this->phpHelper, 'phpGlobalGet']),
            new Twig_Function('phpGlobalPost', [$this->phpHelper, 'phpGlobalPost']),
            new Twig_Function('phpGlobalFiles', [$this->phpHelper, 'phpGlobalFiles']),
            new Twig_Function('phpGlobalRequest', [$this->phpHelper, 'phpGlobalRequest']),
            new Twig_Function('phpGlobalServer', [$this->phpHelper, 'phpGlobalServer']),

            new Twig_Function('d', [$this, 'dump']),
            new Twig_Function('countries', [$this, 'getCountries']),
            new Twig_Function('uniqueId', [$this, 'generateUniqueId']),
        ];
    }

    public function dump()
    {
        foreach(func_get_args() as $arg){
            d($arg);
        }
    }

    public function generateUniqueId(){
        return uniqid();
    }

}
