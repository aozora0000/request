<?php
    namespace Aozora0000\Request;
    interface RequestInterface {

        /*
         *  Return new getRequest Object
         *  @param array $option
         *  @param array $input (TestOnly!)
         */
        /**
         * @return void
         */
        public function __construct(Array $option = array(),Array $input = array());

        /*
         *  Set Validate Needle
         *  @param array $validateNeedle
         *  @return $this
         */
        public function setValid($validateNeedle);

        /*
         *  Get Request Method From $_GET method
         *  @param string $paramName
         *  @param string|array|callable $validateNeedle
         *  @return Array|Object
         *  @throw Exception
         */
        public function get($paramName = null,$validateNeedle = null);

        /*
         *  get Request Method From $_POST method
         *  @param string $paramName
         *  @param string|array|callable $validateNeedle
         *  @return Array|Object
         *  @throw Exception
         */
        public function post($paramName = null,$validateNeedle = null);
    }
