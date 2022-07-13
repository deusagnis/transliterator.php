# Transliterator

## About
This package can transliterate between languages using string replacements.

Available pairs:
1. RU-EN

## Usage
To install:
```

```

Example:
```
// Create instanse of TransliteratorFabric.
$fabric = new TransliteratorFabric();
// Make Transliterator for EN-RU pair.
$enRu = $fabric->make("en", "ru");

if(is_null($enRu)){
    throw new Exception("Language pair not found!");
}

$resultFromRuToEn = $enRu->reverse("Привет!");
// Result is "Privet!".
var_dump($resultFromRuToEn);
// Result is "Привет!".
$resultFromEnToRu = $enRu->direct($resultFromRuToEn);
var_dump($resultFromEnToRu);
```