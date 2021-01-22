<?php
    
    
    namespace App\Traits;
    
    
    trait SanitizeTrait
    {
        // https://www.php.net/manual/en/filter.filters.sanitize.php
        // We trim the $_POST data before any spaces get encoded to "%20"

        // Trim array values using this function "trim_value"
//        function trim_value(&$value)
//        {
            // this removes whitespace and related characters from the beginning and end of the string
//            $value = trim($value);
//        }
    }
/*
        array_filter($_POST, 'trim_value');    // the data in $_POST is trimmed

        // set up the filters to be used with the trimmed post array
        $postfilter = [
            'user_tasks' =>['filter' => FILTER_SANITIZE_STRING, 'flags' => !FILTER_FLAG_STRIP_LOW],
                ];
                // removes tags. formatting code is encoded -- add nl2br() when displaying
            'username'                            =>    array('filter' => FILTER_SANITIZE_ENCODED, 'flags' => FILTER_FLAG_STRIP_LOW),    // we are using this in the url
            'mod_title'                            =>    array('filter' => FILTER_SANITIZE_ENCODED, 'flags' => FILTER_FLAG_STRIP_LOW),    // we are using this in the url
        ];

$revised_post_array = filter_var_array($_POST, $postfilter);    // must be referenced via a variable which is now an array that takes the place of $_POST[]
echo (nl2br($revised_post_array['user_tasks']));    //-- use nl2br() upon output like so, for the ['user_tasks'] array value so that the newlines are formatted, since this is our HTML <textarea> field and we want to maintain newlines
    }
    */

