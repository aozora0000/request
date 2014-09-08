# HTTP GET/POST Method Wrapper

get HTTPMethod Wrapper With Validate System

## How To Install (Use Composer)

- composer.json

```
{
    "require" : {
        "aozora0000/request" : "dev-master"
    }
}
```

```
$ composer install
```

## How To Use

### Include&Configure
```
include "./vendor/autoload.php";
use Aozora0000\Request;

/*
 *  @return Object(Default)
 *  @configure
 *      returnType object | array
 */
$configure = array("returnType"=> "array");
$request = new Request($configure);
```

### UseCase

- Simple Use Case Sample

```
/*
 *  No Validation
 */
$message = $request->post("message");

/*
 *  OnlyNumeric FROM $_GET["id"]
 */
$get_id  = $request->get("id",Request::NUMERIC);

/*
 *  OnlyNumeric On Closure FROM $_POST["id"]
 */
$post_id = $request->post("id",function($val) {
    return preg_match("/^[0-9]{1,5}$/",$val);
});

/*
 *  No Validation FROM $_POST
 */
$allParams = $request->post();

/*
 *  No Validation FROM $_POST on Closure (multi params using $val['paramname'])
 */
$allParams = $request->post(null,function($val) {
    return (
        preg_match("/^[0-9]+$/",$val['id']) &&
        preg_match("/^\w(\s{1})?\w$/",$val['name'])
    );
});
```


- Preset Validate Case

```
***Caution***
Preset Validate Case Is Not Use Closure!

/*
 *  OnlyNumeric On setValid Method
 */
$request->setValid(Request::NUMERIC);
$get_id = $request->get("id");
$get_year = $request->get("year");
```

### ValidateAttributeRegex
```
Request::NUMERIC            "/^[0-9]+$/"
Request::FLOAT              "/^[0-9]+\.[0-9]+$/"
Request::ALPHANUMERIC       "/^[A-Za-z0-9_]+$/i"
Request::URI                "/^(http|https|ftp):\/\/[-\w\.]+(:\d+)?(\/[^\s]*)?$/"
Request::ZIPCODE            "/^([0-9]{3}-[0-9]{4})?$|^[0-9]{7}+$/i"
Request::MAIL               "/^[-+.\\w]+@[-a-z0-9]+(\\.[-a-z0-9]+)*\\.[a-z]{2,6}$/i"
Request::PHONE              "/^0\d{9,11}$/"
Request::PHONE_WITH_HYPHEN  "/^\d{2,4}-\d{3,4}-\d{3,4}$/"
Request::TIME               "/^([0-1]?[0-9]|[2][0-3]):[0-5][0-9]$/"
Request::DATE               "/^(\d{4})(-|\/)(\d{1,2})(-|\/)(\d{1,2})$/"
```
