<?php

namespace Fousky\Component\iDoklad\Util;

use Psr\Http\Message\ResponseInterface;

/**
 * @author Lukáš Brzák <brzak@fousky.cz>
 */
class ResponseUtil
{
    /**
     * @param ResponseInterface $response
     *
     * @throws \RuntimeException
     *
     * @return \stdClass
     */
    public static function handle(ResponseInterface $response): \stdClass
    {
        $content = $response
            ->getBody()
            ->getContents();

        if (empty($content)) {
            return new \stdClass();
        }

        return \GuzzleHttp\json_decode($content);
    }
}
