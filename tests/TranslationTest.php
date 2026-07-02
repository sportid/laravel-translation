<?php

namespace Tests;

use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Vemcogroup\Translation\Translation;

class TranslationTest extends TestCase
{
    public function testNormalizeScannedKeysRemovesEscapedQuotes(): void
    {
        $translation = new class extends Translation {
            public function __construct()
            {
            }

            public function normalizeScannedKeysPublic(array $keys): array
            {
                return $this->normalizeScannedKeys(new Collection($keys))->all();
            }
        };

        $this->assertSame(
            [
                "yes, I'm sure",
                "yes, I'm sure",
            ],
            $translation->normalizeScannedKeysPublic([
                "yes, I\\'m sure",
                "yes, I'm sure",
            ])
        );
    }

    public function testNormalizeStoredTranslationsRemovesEscapedQuotesFromKeysAndValues(): void
    {
        $translation = new class extends Translation {
            public function __construct()
            {
            }

            public function normalizeStoredTranslationsPublic(array $translations): array
            {
                return $this->normalizeStoredTranslations(new Collection($translations))->all();
            }
        };

        $this->assertSame(
            [
                "yes, I'm sure" => "yes, I'm sure",
                'keep me' => 'keep me',
            ],
            $translation->normalizeStoredTranslationsPublic([
                "yes, I\\'m sure" => "yes, I\\'m sure",
                'keep me' => 'keep me',
            ])
        );
    }
}
