<?php
    namespace Aozora0000\Request;

    interface ValidateInterface {
        /*
         *  Set Regex needle
         *  @param string $needle
         *  @return $this
         */
        public function setNeedle($needle);


        /*
         *  Execute Validation
         *  @param string $target
         *  @return boolean
         *  @throw \Exception
         */
        /**
         * @param   $callback
         */
        public function execute($target,$callback = NULL);
    }
