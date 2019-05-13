<?php

namespace Templating\Helper;

use Faker\Factory;

use DateTime;

/**
 */
class FakerHelper
{

    private $faker;

    public function __construct(string $locale = 'es_ES')
    {
        $this->faker = Factory::create($locale);
    }

    public function fakeName(): string
    {
        return $this->faker->name;
    }

    public function fakeAddress(): string
    {
        return $this->faker->address;
    }

    public function fakePhoneNumber(): string
    {
        return $this->faker->phoneNumber;
    }

    public function fakeText(int $length): string
    {
        return $this->faker->text($length);
    }

    public function fakeWords(int $numWords): string
    {
        return $this->faker->words($numWords, true);
    }

    public function fakeSentence(int $numWords): string
    {
        return $this->faker->sentence($numWords, true);
    }

    public function fakeUrl(): string
    {
        return sprintf('%s://%s/%s.%s',
            ($this->faker->randomNumber(1) % 2) ? 'http' : 'https',
            strtolower($this->faker->domainName),
            strtolower($this->faker->words(1, true)),
            strtolower($this->faker->fileExtension)
        );
    }

    public function fakeParagraph(int $numSentences): string
    {
        return $this->faker->paragraph($numSentences, true);
    }

    public function fakeInt(int $numDigits): int
    {
        return $this->faker->randomNumber(min(mt_getrandmax(), $numDigits));
    }

    public function fakeFloat(int $numDecimals, float $min = 0, float $max = null): float
    {
        return $this->faker->randomFloat($numDecimals, $min, $max);
    }

    public function fakeRandomInt(int $min, int $max): int
    {
        return $this->faker->numberBetween($min, $max);
    }

    public function fakeTime(string $format = 'H:i:s', $max = 'now'): string
    {
        return $this->faker->time($format, $max);
    }

    public function fakeDate(string $format = 'Y-m-d', $max = 'now'): string
    {
        return $this->faker->date($format, $max);
    }

    public function fakeUnixTime($max = 'now'): int
    {
        return $this->faker->unixTime($max);
    }

    public function fakeDateTime($max = 'now', string $timezone = null): DateTime
    {
        return $this->faker->dateTime($max, $timezone);
    }

    public function fakeEmail(): string
    {
        return $this->faker->email;
    }

    public function fakeUsername(): string
    {
        return $this->faker->userName;
    }

    public function fakePassword(): string
    {
        return $this->faker->password;
    }

    public function fakeDomainName(): string
    {
        return $this->faker->domainName;
    }

    public function fakeIp4(): string
    {
        return $this->faker->ipv4;
    }

    public function fakeIp6(): string
    {
        return $this->faker->ipv6;
    }

    public function fakeMacAddress(): string
    {
        return $this->faker->macAddress;
    }

    public function fakeUserAgent(): string
    {
        return $this->faker->userAgent;
    }

    public function fakeCreditCardNumber(): string
    {
        return $this->faker->creditCardNumber;
    }

    public function fakeCreditCardExpiration(): string
    {
        return $this->faker->creditCardExpirationDateString;
    }

    public function fakeIban(string $country = 'ES'): string
    {
        return $this->faker->iban($country);
    }

    public function fakeHexColor(): string
    {
        return $this->faker->hexColor;
    }

    public function fakeRgbColor(): string
    {
        return $this->faker->rgbCssColor;
    }

    public function fakeColorName(): string
    {
        return $this->faker->colorName;
    }

    public function fakeFileExtension(): string
    {
        return $this->faker->fileExtension;
    }

    public function fakeMediaType(): string
    {
        return $this->faker->mimeType;
    }

    public function fakeUuid(): string
    {
        return $this->faker->uuid;
    }

    public function fakeMd5(): string
    {
        return $this->faker->md5;
    }

    public function fakeSha1(): string
    {
        return $this->faker->sha1;
    }

    public function fakeSha256(): string
    {
        return $this->faker->sha256;
    }

    public function fakeCountryCode(): string
    {
        return $this->faker->countryCode;
    }

    public function fakeLanguageCode(): string
    {
        return $this->faker->languageCode;
    }

    public function fakeCurrencyCode(): string
    {
        return $this->faker->currencyCode;
    }

    public function fakeRandomHtml(int $levels, int $elementsPerLevel): string
    {
        return $this->faker->randomHtml($levels, $elementsPerLevel);
    }
}