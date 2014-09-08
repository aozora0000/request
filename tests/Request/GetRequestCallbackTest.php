<?php
    use Aozora0000\Request;

    class GetRequestCallbackTest extends PHPUnit_Framework_TestCase {

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
         *
         * @expectedException PHPUnit_Framework_Error
         */
        public function testGetRequestCallbackSingle() {
            try {
                $id = $this->request->get("id",function($value) {
                    return preg_match("/^[0-9]$/",$value);
                });
                $this->assertEquals($id,1);
            } catch (Exception $e) {
                $this->fail($e->getMessage());
            }
        }

        public function testGetRequestCallbackSingleFailCase() {
            try {
                $id = $this->request->get("id",function($value) {
                    return preg_match("/^[a-z]$/i",$value);
                });
                $this->fail('期待通りの例外が発生しませんでした。');
            } catch (Exception $e) {
                $this->assertTrue(true);
            }
        }

        public function testGetRequestCallbackAll() {
            try {
                $getParams = $this->request->get(NULL,function($value) {
                    return (
                        preg_match(Request::NUMERIC,$value['id']) &&
                        preg_match(Request::PHONE_WITH_HYPHEN,$value['mobile']) &&
                        preg_match(Request::URI,$value['homepage']) &&
                        preg_match(Request::MAIL,$value['mail'])
                    ) ? true : false;
                });
                $this->assertTrue(true);
            } catch(Exception $e) {
                $this->fail($e->getMessage());
            }
        }

        public function testGetRequestCallbackAllFailCase() {
            try {
                $getParams = $this->request->get(NULL,function($value) {
                    return (
                        preg_match("/^[a-z]$/i",$value["id"]) &&
                        preg_match("/^[1-9]{11}$/i",$value["mobile"])
                    ) ? true : false;
                });
                $this->fail("期待通りの例外が発生しませんでした。");
            } catch(Exception $e) {
                $this->assertTrue(true);
            }
        }
    }
