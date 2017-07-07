<?php

namespace Ragboyjr\PagerDuty;

use ArrayAccess;
use Krak\Arr;
use Psr\Http\Message\ResponseInterface;

class Response implements ArrayAccess
{
    private $parsed_body;
    private $is_parsed;
    private $response;

    public function __construct(ResponseInterface $response) {
        $this->response = $response;
        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
            $this->parsed_body = json_decode((string) $response->getBody(), true);
            $this->is_parsed = true;
        }
    }

    public function getStatus() {
        return $this->response->getStatusCode();
    }

    public function isOk() {
        return $this->getStatus() >= 200 && $this->getStatus() < 300;
    }

    public function isError() {
        return $this->getStatus() >= 400 && $this->getStatus() < 600;
    }

    public function getBody() {
        return $this->is_parsed
            ? $this->parsed_body
            : $this->response->getBody();
    }

    public function getHttpResponse() {
        return $this->response;
    }

    public function offsetGet($offset) {
        return $this->parsed_body[$offset];
    }

    public function offsetExists($offset) {
        return array_key_exists($offset, $this->parsed_body);
    }

    public function offsetSet($offset, $value) {
        throw new \LogicException('Cannot set offset value because response is read only.');
    }

    public function offsetUnset($offset) {
        throw new \LogicException('Cannot unset offset value because response is read only.');
    }
}
