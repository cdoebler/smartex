<?php

/**
 * Smart extraction of string data
 * 
 * @version 0.1
 * @author Christian Doebler <http://www.christian-doebler.net/>
 */
class SmartEx {
    /**
     * Delimiter to indicate start of pattern variable
     * 
     * @var string
     */
    static private $_varStart = '{';
    
    /**
     * Delimiter to indicate end of pattern variable
     * 
     * @var string
     */
    static private $_varEnd = '}';
    
    /**
     * Pattern for value extraction
     * 
     * @var string
     */
    static public $pattern = '';
    
    /**
     * Sets extraction pattern
     * 
     * @param string $pattern Extraction pattern like 'some {text} to extract'
     */
    static public function setPattern ($pattern) {
        self::$pattern = $pattern;
    }
    
    /**
     * Extracts values and returns them
     * 
     * @param string $str String to extract data from
     * @param string $pattern Pattern to use for extraction
     * @return array Extracted values
     */
    static public function get($str, $pattern = false) {
        $extracted = array();
        
        if ($pattern !== false) {
            self::setPattern($pattern);
        }
        
        if (empty($pattern)) {
            throw new SmartExException('No pattern defined!');
        }

        // determine variables
        $varPattern = '/' . self::$_varStart . '([^' . self::$_varEnd . ']+)' . self::$_varEnd . '/ms';
        if (!preg_match_all($varPattern, $pattern, $varMatches)) {
            throw new SmartExException('No pattern variables found!');
        }
        
        // extract data
        $pattern = '/' . preg_replace($varPattern, '(.*)', $pattern) . '/ms';
        preg_match_all($pattern, $str, $matches);
        
        // create result
        $offset = 1;
        foreach($varMatches[1] as $varName) {
            $extracted[$varName] = $matches[$offset++][0];
        }
        
        return $extracted;
    }
}

class SmartExException extends Exception {};
