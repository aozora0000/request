<?php
    namespace Aozora0000;
    class Request extends Request\Request {
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
    }
