<?php

namespace TektonLabs\ReactOnLaravel\Renderer;

use Illuminate\Http\Request;
use Limenius\ReactRenderer\Context\ContextProviderInterface;

class ContextProvider implements ContextProviderInterface
{
    private $request;
    /**
     * __construct
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * getContext
     *
     * @param boolean $serverSide whether is this a server side context
     * @return array the context information
     */
    public function getContext($serverSide)
    {
        $request = $this->request;
        return [
            'serverSide' => $serverSide,
            'href' => $request->getSchemeAndHttpHost().$request->getRequestUri(),
            'location' => $request->getRequestUri(),
            'scheme' => $request->getScheme(),
            'host' => $request->getHost(),
            'port' => $request->getPort(),
            'base' => $request->getBaseUrl(),
            'pathname' => $request->getPathInfo(),
            'search' => $request->getQueryString(),
        ];
    }
}
