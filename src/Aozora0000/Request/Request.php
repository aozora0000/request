<?php
    namespace Aozora0000\Request;

    use \Exception;

    class Request implements RequestInterface {
        protected $getRequest;
        protected $postRequest;
        protected $option;
        protected $validateNeedle;

        public function __construct(Array $option = array(),Array $input = array()) {
            $this->option = array_merge(array(
                "returnType"=> 'object'
            ),$option);
            $this->getRequest  = (empty($input)) ? $_GET  : $input;
            $this->postRequest = (empty($input)) ? $_POST : $input;
            $this->validateNeedle = null;
        }

        public function setValid($validateNeedle) {
            $this->validateNeedle = $validateNeedle;
            return $this;
        }

        public function get($paramName = null,$validateNeedle = null) {
            return $this->_execute("getRequest",$paramName,$validateNeedle);
        }
        public function post($paramName = null,$validateNeedle = null) {
            return $this->_execute("postRequest",$paramName,$validateNeedle);
        }

        /**
         * @param string $methodName
         * @param string|null $paramName
         */
        protected function _execute($methodName,$paramName,$validateNeedle = null) {
            $validate = new Validate;
            // EmptyRequest
            if(empty($this->{$methodName})) {
                return NULL;
            }

            // ParamNameKey Empty
            if(!is_null($paramName) && !array_key_exists($paramName,$this->{$methodName})) {
                return NULL;
            }
            if(!is_null($this->validateNeedle)) {
                $validateNeedle = $this->validateNeedle;
            }

            if(is_callable($validateNeedle)) {
                if(is_null($paramName)) {
                    if(!$validate->execute($this->{$methodName},$validateNeedle)) {
                        throw new Exception("Get Params Malformed Strings");
                    }
                } else {
                    if(!$validate->execute($this->{$methodName}[$paramName],$validateNeedle)) {
                        throw new Exception("Get Params Malformed Strings");
                    }
                }
            } elseif(is_string($validateNeedle)) {
                if(is_null($paramName)) {
                    foreach($this->{$methodName} as $reqest) {
                        if(!$validate->setNeedle($validateNeedle)->execute($this->{$methodName})) {
                            throw new Exception("Get Params Malformed Strings");
                        }
                    }
                } else {
                    if(!$validate->setNeedle($validateNeedle)->execute($this->{$methodName}[$paramName])) {
                        throw new Exception("Get Params Malformed Strings: {$paramName}");
                    }
                }
            }
            if(is_null($paramName)) {
                return ($this->option["returnType"] === "object") ? (object)$this->{$methodName} : $this->{$methodName};
            } else {
                return $this->{$methodName}[$paramName];
            }
        }
    }
