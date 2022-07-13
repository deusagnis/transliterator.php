<?php

namespace MGGFLOW\Text;

/**
 * Fabric for Transliterator of any languages.
 */
class TransliteratorFabric
{
    protected $langCode1;
    protected $langCode2;

    /**
     * Make Transliterator for language pair.
     * @param $langCode1
     * @param $langCode2
     * @return Transliterator|null
     */
    public function make($langCode1, $langCode2){
        $this->setLangCodes($langCode1, $langCode2);

        $directPairName = $this->createPairName(true);
        $relation = $this->gainPairNameRelation($directPairName);
        if(!is_null($relation)){
            return new Transliterator($relation, false);
        }

        $reversedPairName = $this->createPairName(false);
        $relation = $this->gainPairNameRelation($reversedPairName);
        if(!is_null($relation)){
            return new Transliterator($relation, true);
        }

        return null;
    }

    protected function setLangCodes($langCode1, $langCode2){
        $this->langCode1 = strtolower($langCode1);
        $this->langCode2 = strtolower($langCode2);
    }

    protected function gainPairNameRelation($pairName){
        $pairNamePath = $this->genPairRelationFilePath($pairName);

        if(file_exists($pairNamePath)){
            return include $pairNamePath;
        }

        return null;
    }

    protected function createPairName($direct = true){
        if($direct){
            return $this->langCode1 . '-' . $this->langCode2;
        }

        return $this->langCode2 . '-' . $this->langCode1;
    }

    protected function genPairRelationFilePath($pairName){
        return __DIR__ . "/LangRelations/" . $pairName . ".php";
    }
}