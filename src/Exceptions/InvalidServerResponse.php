<?php

namespace Medboubazine\Moogold\Exceptions;

use Psr\Http\Message\ResponseInterface;
use Exception;
use Throwable;

class InvalidServerResponse extends Exception
{
    /**
     * Exception message
     *
     * @return Throwable
     */
    public static function message(ResponseInterface $response): Throwable
    {

        $data = self::parseResponseContentToArray($response);

        if (!empty($data)) {
            $message = "Error code: {$data['err_code']} . Error message: {$data['err_message']}";
        } else {
            $message = "Error when trying to get response from server";
        }

        return throw new self($message);
    }

    /**
     * To Array
     *
     * @param ResponseInterface $response
     * @return array
     */
    public static function parseResponseContentToArray(ResponseInterface $response): array
    {
        $contents = $response->getBody();
        $contents_array = json_decode($contents, true);

        if ($contents_array and is_array($contents_array)) {
            return $contents_array;
        }
        return [];
    }
}
