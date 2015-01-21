<?php

namespace CodeCounter;

/**
 * VersionMatcher
 * 
 * @version 0.1.0
 *
 * test if version match some expression
 *
 * @example
 *  $versionMatcher = new \CodeCounter\VersionMatcher(array(
 *      'ios' => '1.0.1',
 *      'android' => '1.1.2',
 *      'ver' => '1.1.0'
 *  ), array(
 *      'defaultField' => 'version',
 *      'defaultOperator' => '>='
 *  });
 * 
 *  $versionMatcher->match('ios > 1.0.0 || android > 1.1.0');
 *  $versionMatcher->match('ver > 1.0.0');
 *  $versionMatcher->match('1.0.0');
 */
class VersionMatcher {

    /**
     * Static function
     */
    public static function test ($expr, $params = array(), $config = array()) {
        $matcher = new static($params, $config);
        return $matcher->match($expr);
    }

    // operator greater-than
    const OPERATOR_GT = '>';

    // operator greater-than-equal
    const OPERATOR_GTE = '>=';

    // operator little-than
    const OPERATOR_LT = '<';

    // operator little-than-equal
    const OPERATOR_LTE = '<=';

    // operator equal
    const OPERATOR_EQ = '=';

    // operator not equal
    const OPERATOR_NE = '<>';

    // key-value for replace match expression
    protected $fields = array();

    // regex for version
    protected $versionRegex = '[\d\.]+';

    // regex for operator
    protected $operatorRegex = '[\<\>\=]+';

    // regex for expr item
    protected $exprItemRegex = '([\d\.]+)\s*([\<\>\=]+)\s*([\d\.]+)';

    // matcher config
    protected $config = array(
        'defaultField' => '',
        'defaultOperator' => self::OPERATOR_GTE
    );
    
    /**
     * Construct
     *
     * @param array $fields
     * @param array $config
     */
    public function __construct ($fields = array(), $config = array()) {
        if (is_array($fields)) {
            $this->fields = $fields;
        }

        if (is_array($config)) {
            $this->config = array_replace($this->config, $config);
        }
    }

    /**
     * Execute a match
     *
     * @param string $expr expression for match
     */
    public function match ($expr) {
        $expr = trim($expr);

        // get default field and default operator for future use
        $defaultField = $this->config['defaultField'];
        $defaultOperator = $this->config['defaultOperator'];

        // detect if $expr is only version string
        // eg: `1.3.0`
        if (preg_match('/^' . $this->versionRegex . '$/', $expr)) {

            if ($defaultField) {
                // concat result example `ver >= 1.3.0`
                $expr = $defaultField . ' ' . $defaultOperator . ' ' . $expr;
            } else {
                // no default field
                return false;
            }
        }

        // detect if $expr doesn't have default field
        // eg: `>= 1.3.0`
        if (preg_match('/^([\<\>\=]+)\s*([\d\.]+)$/', $expr)) {
            if ($defaultField) {
                $expr = $defaultField . ' ' . $expr;
            }
        }

        // full expr
        // replace field
        if (count($this->fields) > 0) {
            foreach ($this->fields as $key => $value) {
                $expr = str_replace($key, $value, $expr);
            }
        }

        // compare expr item
        $expr = preg_replace_callback('/([\d\.]+)\s*([\<\>\=]+)\s*([\d\.]+)/', function ($match) {
            $itemResult = version_compare($match[1], $match[3], $match[2]);
            return $itemResult ? 1 : 0;
        }, $expr);

        // eval value
        // TODO: if syntex error, convert error to exception without affect glboal
        try {
            eval('$result = !!(' . $expr . ');');

            if (isset($result)) {
                return $result;
            }

            return false;
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }

}

?>