<?php
    namespace Aozora0000\Request;

    //use Request\Request\ValidateInterface;

    class Validate implements ValidateInterface {

        /** @var string */
        protected $needle;
        /** @var callable */
        protected $callback;


        public function setNeedle($needle) {
            $this->needle = $needle;
            return $this;
        }

        public function execute($target,$callback = NULL) {
            if(!empty($this->needle)) {
                return preg_match($this->needle,$target);
            } elseif (!is_null($callback)) {
                return $callback($target);
            } else {
                return true;
            }
        }
    }
