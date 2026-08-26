<?php

namespace App\Services;

class IngredientTranslator
{
    /**
     * Common Indonesian kitchen/leftover ingredient names mapped to the English
     * names TheMealDB's ingredient search expects.
     *
     * @var array<string, string>
     */
    private const MAP = [
        'nasi' => 'rice',
        'nasi putih' => 'rice',
        'nasi sisa' => 'rice',
        'telur' => 'egg',
        'telur ayam' => 'egg',
        'wortel' => 'carrot',
        'bawang putih' => 'garlic',
        'bawang merah' => 'red onion',
        'bawang bombay' => 'onion',
        'bawang' => 'onion',
        'kecap manis' => 'soy sauce',
        'kecap asin' => 'soy sauce',
        'kecap' => 'soy sauce',
        'cabai' => 'chili',
        'cabe' => 'chili',
        'cabai merah' => 'red chili',
        'cabai rawit' => 'chili',
        'ayam' => 'chicken',
        'daging ayam' => 'chicken',
        'daging sapi' => 'beef',
        'sapi' => 'beef',
        'ikan' => 'fish',
        'udang' => 'shrimp',
        'tahu' => 'tofu',
        'tempe' => 'tofu',
        'bayam' => 'spinach',
        'kentang' => 'potato',
        'tomat' => 'tomato',
        'kol' => 'cabbage',
        'kubis' => 'cabbage',
        'sawi' => 'mustard greens',
        'kangkung' => 'spinach',
        'timun' => 'cucumber',
        'mentimun' => 'cucumber',
        'jagung' => 'corn',
        'brokoli' => 'broccoli',
        'kembang kol' => 'cauliflower',
        'susu' => 'milk',
        'keju' => 'cheese',
        'mentega' => 'butter',
        'margarin' => 'margarine',
        'minyak goreng' => 'vegetable oil',
        'minyak' => 'oil',
        'terigu' => 'flour',
        'tepung terigu' => 'flour',
        'tepung' => 'flour',
        'gula' => 'sugar',
        'garam' => 'salt',
        'merica' => 'pepper',
        'lada' => 'pepper',
        'jahe' => 'ginger',
        'kunyit' => 'turmeric',
        'lengkuas' => 'galangal',
        'serai' => 'lemongrass',
        'daun salam' => 'bay leaf',
        'jeruk nipis' => 'lime',
        'jeruk limau' => 'lime',
        'santan' => 'coconut milk',
        'kelapa' => 'coconut',
        'mie' => 'noodles',
        'mi' => 'noodles',
        'pasta' => 'pasta',
        'roti' => 'bread',
        'kacang panjang' => 'green beans',
        'buncis' => 'green beans',
        'terong' => 'eggplant',
        'nanas' => 'pineapple',
        'pisang' => 'banana',
        'apel' => 'apple',
        'jamur' => 'mushroom',
        'daun bawang' => 'spring onion',
        'seledri' => 'celery',
        'paprika' => 'bell pepper',
        'cuka' => 'vinegar',
        'madu' => 'honey',
    ];

    /**
     * Translate an Indonesian ingredient name to English for use with TheMealDB.
     * Falls back to the original text (unchanged) when there is no mapping,
     * so already-English input still works.
     */
    public static function toEnglish(string $indonesian): string
    {
        $key = mb_strtolower(trim($indonesian));

        return self::MAP[$key] ?? $indonesian;
    }
}
