<?php
    namespace Aozora0000\Request;

    use \Exception;

    class Request implements RequestInterface {
        const NUMERIC           = "/^[0-9]+$/";
        const FLOAT             = "/^[0-9]+\.[0-9]+$/";
        const ALPHANUMERIC      = "/^[a-z0-9_]+$/i";
        const URI               = "/^(http|https|ftp):\/\/[-\w\.]+(:\d+)?(\/[^\s]*)?$/";
        const ZIPCODE           = "/^([0-9]{3}-[0-9]{4})?$|^[0-9]{7}+$/i";
        const MAIL              = "/^[-+.\\w]+@[-a-z0-9]+(\\.[-a-z0-9]+)*\\.[a-z]{2,6}$/i";
        const PHONE             = "/^0\d{9,11}$/";
        const PHONE_WITH_HYPHEN = "/^\d{2,4}-\d{3,4}-\d{3,4}$/";
        const TIME              = "/^([0-1]?[0-9]|[2][0-3]):[0-5][0-9]$/";
        const DATE              = "/^(\d{4})(-|\/)(\d{1,2})(-|\/)(\d{1,2})$/";

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
            $validate = new Validate;
            // EmptyRequest
            if(empty($this->getRequest)) {
                return NULL;
            }
            // ParamNameKey Empty
            if(!is_null($paramName) && !isset($this->getRequest[$paramName])) {
                return NULL or die();
            }
            if(!is_null($this->validateNeedle)) {
                $validateNeedle = $this->validateNeedle;
            }

            if(is_callable($validateNeedle)) {
                if(is_null($paramName)) {
                    if(!$validate->execute($this->getRequest,$validateNeedle)) {
                        throw new Exception("Get Params Malformed Strings");
                    }
                } else {
                    if(!$validate->execute($this->getRequest[$paramName],$validateNeedle)) {
                        throw new Exception("Get Params Malformed Strings");
                    }
                }
            } elseif(is_string($validateNeedle)) {
                if(is_null($paramName)) {
                    foreach($this->getRequest as $reqest) {
                        if(!$validate->setNeedle($validateNeedle)->execute($this->getRequest)) {
                            throw new Exception("Get Params Malformed Strings");
                        }
                    }
                } else {
                    if(!$validate->setNeedle($validateNeedle)->execute($this->getRequest[$paramName])) {
                        throw new Exception("Get Params Malformed Strings: {$paramName}");
                    }
                }
            }
            if(is_null($paramName)) {
                return ($this->option["returnType"] === "object") ? (object)$this->getRequest : $this->getRequest;
            } else {
                return $this->getRequest[$paramName];
            }
        }

        public function post($paramName = null,$validateNeedle = null) {
            $validate = new Validate;
            // EmptyRequest
            if(empty($this->postRequest)) {
                return NULL;
            }
            // ParamNameKey Empty
            if(!is_null($paramName) && !isset($this->postRequest[$paramName])) {
                return NULL or die();
            }
            if(!is_null($this->validateNeedle)) {
                $validateNeedle = $this->validateNeedle;
            }

            if(is_callable($validateNeedle)) {
                if(!$validate->execute($this->postRequest,$validateNeedle)) {
                    throw new Exception("Get Params Malformed Strings");
                }
            } elseif(is_string($validateNeedle)) {
                if(is_null($paramName)) {
                    foreach($this->postRequest as $reqest) {
                        if(!$validate->setNeedle($validateNeedle)->execute($this->postRequest)) {
                            throw new Exception("Get Params Malformed Strings");
                        }
                    }
                } else {
                    if(!$validate->setNeedle($validateNeedle)->execute($this->postRequest[$paramName])) {
                        throw new Exception("Get Params Malformed Strings: {$paramName}");
                    }
                }
            }
            if(is_null($paramName)) {
                return ($this->option["returnType"] === "object") ? (object)$this->postRequest : $this->postRequest;
            } else {
                return $this->postRequest[$paramName];
            }
        }
    }
