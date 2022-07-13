<?php

namespace MGGFLOW\Text;

/**
 * Transliteration between languages pair by replacement relations.
 */
class Transliterator
{
    protected $directLangRelation = null;
    protected $reverseLangRelation = null;

    /**
     * Create instance for languages pair relation.
     * @param $langRelation
     * @param bool $reversed
     */
    public function __construct($langRelation, $reversed = false)
    {
        if($reversed){
            $this->reverseLangRelation = $langRelation;
        }else{
            $this->directLangRelation = $langRelation;
        }
    }

    /**
     * Do direct transliteration.
     * @param $langStr
     * @return string
     */
    public function direct($langStr){
        if(is_null($this->directLangRelation)){
            $this->directLangRelation = array_flip($this->reverseLangRelation);
        }

        return strtr($langStr, $this->directLangRelation);
    }

    /**
     * Do reverse transliteration.
     * @param $langStr
     * @return string
     */
    public function reverse($langStr){
        if(is_null($this->reverseLangRelation)){
            $this->reverseLangRelation = array_flip($this->directLangRelation);
        }

        return strtr($langStr, $this->reverseLangRelation);
    }

}