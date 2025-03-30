<?php

namespace App\Utils;

class URL
{
    /**
     * Will remove the provided query parameter from the provided URL
     * @param string $url
     * @param string $param
     * @return string
     */
    public static function removeQueryParameter(string $url, string $param): string
    {
        /**
         * If a query parameter doesn't exist, return the url
         */
        if (!str_contains($url, '?')) {
            return $url;
        }

        /**
         * Split the string by the start of the query parameters
         */
        list ($baseUrl, $urlQuery) = explode('?', $url, 2);

        /**
         * Unset the query parameter from the URL
         */
        parse_str($urlQuery, $urlQueryArr);
        unset($urlQueryArr[$param]);

        /**
         * If there are more query parameters, re-append to the URL and return the final URL
         */
        if (count($urlQueryArr)) {
            return $baseUrl.'?'.http_build_query($urlQueryArr);
        }

        return $baseUrl;
    }
}
