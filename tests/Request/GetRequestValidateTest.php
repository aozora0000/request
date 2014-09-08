<?php
    use Aozora0000\Request;

    class GetRequestValidateTest extends PHPUnit_Framework_TestCase {
        protected function setUp() {
            $inputArray = array(
                'numeric' => "1",
                'float' => '3.14159265359',
                'alphanumeric'=> 'a1b2c3d4',
                'uri'=> 'https://blog.example.com',
                'zipcode'=>'510-0000',
                'mail'=>'taro@example.com',
                'phone'=>'0612345678',
                'phone_with_hyphen'=>'06-1234-5678',
                'time'=>'12:25',
                'date1'=>'2014/05/12',
                'date2'=>'2014-05-12'
            );
            $this->request = new Request(array(),$inputArray);
        }

        public function testGetRequestValid() {
            try {
                $this->request->get("numeric",          Request::NUMERIC);
                $this->request->get("float",            Request::FLOAT);
                $this->request->get("alphanumeric",     Request::ALPHANUMERIC);
                $this->request->get("uri",              Request::URI);
                $this->request->get("zipcode",          Request::ZIPCODE);
                $this->request->get("mail",             Request::MAIL);
                $this->request->get("phone",            Request::PHONE);
                $this->request->get("phone_with_hyphen",Request::PHONE_WITH_HYPHEN);
                $this->request->get("time",             Request::TIME);
                $this->request->get("date1",            Request::DATE);
                $this->request->get("date2",            Request::DATE);

                $this->assertTrue(true);
            } catch(Exception $e) {
                $this->fail($e->getMessage());
            }
        }

    }
