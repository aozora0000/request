<?php
    use Aozora0000\Request;

    class GetRequestStringTest extends PHPUnit_Framework_TestCase {

        protected function setUp() {
            $inputArray = array(
                'id' => "1",
                'name' => 'テスト太郎',
                'mobile'=> '090-0000-0000',
                'phone'=> '0600000000',
                'homepage'=>'https://blog.example.com',
                'mail'=>'taro@example.com'
            );
            $this->request = new Request(array(),$inputArray);
        }

        /*
         * @expectedException PHPUnit_Framework_Error
         */
        public function testGetRequestString() {
            try {
                $id = $this->request->get("id",Request::NUMERIC);
                $phone = $this->request->get("phone",Request::PHONE);
                $name = $this->request->get("name");
                $homepage = $this->request->get("homepage",Request::URI);
                $mail = $this->request->get("mail",Request::MAIL);

                $this->assertEquals($id,1);
                $this->assertEquals($phone,"0600000000");
                $this->assertEquals($name,"テスト太郎");
                $this->assertEquals($homepage,'https://blog.example.com');
                $this->assertEquals($mail,'taro@example.com');
            } catch(InvalidArgumentException $e) {
                $this->fail($e->getMessage());
            }
        }

        public function testGetRequestStringFailCase() {
            try {
                $id = $this->request->get("id","/^[a-z]$/i");
                $this->fail('期待通りの例外が発生しませんでした。');
            } catch (Exception $e) {
                $this->assertTrue(true);
            }
        }

        /*
         * @expectedException PHPUnit_Framework_Error
         */
        public function testGetRequestStringSetValid() {
            $this->request->setValid(Request::NUMERIC);
            try {
                $id = $this->request->get("id");
                $phone = $this->request->get("phone");
                $this->assertEquals($id,1);
                $this->assertEquals($phone,'0600000000');
            } catch(Exception $e) {
                $this->fail($e->getMessage());
            }
        }

        public function testGetRequestStringSetValidFailCase() {
            $this->request->setValid(Request::NUMERIC);
            try {
                $name = $this->request->get("name");
                $this->fail('期待通りの例外が発生しませんでした。');
            } catch (Exception $e) {
                $this->assertTrue(true);
            }
        }
    }
