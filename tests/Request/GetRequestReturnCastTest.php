<?php
    use Aozora0000\Request;

    class GetRequestReturnCastTest extends PHPUnit_Framework_TestCase {

        protected $inputArray;

        protected function setUp() {
            $this->inputArray = array(
                'id' => "1",
                'name' => 'テスト太郎',
                'mobile'=> '090-0000-0000',
                'phone'=> '0600000000',
                'homepage'=>'https://blog.example.com',
                'mail'=>'taro@example.com'
            );
        }

        public function testGetRequestReturnCastObject() {
            $this->request = new Request(array(),$this->inputArray);
            $getObject = $this->request->get();
            $this->assertTrue(is_object($getObject));
        }

        public function testGetRequestReturnCastArray() {
            $this->request = new Request(array("returnType"=>"array"),$this->inputArray);
            $getObject = $this->request->get();
            $this->assertTrue(is_array($getObject));
        }
    }
