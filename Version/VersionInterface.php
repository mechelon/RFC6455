<?php
namespace Ratchet\WebSocket\Version;
use Guzzle\Http\Message\RequestInterface;

/**
 * A standard interface for interacting with the various version of the WebSocket protocol
 */
interface VersionInterface {
    /**
     * Given an HTTP header, determine if this version should handle the protocol
     * @param Guzzle\Http\Message\RequestInterface
     * @return bool
     * @throws UnderflowException If the protocol thinks the headers are still fragmented
     */
    function isProtocol(RequestInterface $request);

    /**
     * Although the version has a name associated with it the integer returned is the proper identification
     * @return int
     */
    function getVersionNumber();

    /**
     * Perform the handshake and return the response headers
     * @param Guzzle\Http\Message\RequestInterface
     * @return Guzzle\Http\Message\Response
     * @throws InvalidArgumentException If the HTTP handshake is mal-formed
     * @throws UnderflowException If the message hasn't finished buffering (not yet implemented, theoretically will only happen with Hixie version)
     */
    function handshake(RequestInterface $request);

    /**
     * @return MessageInterface
     */
    function newMessage();

    /**
     * @return FrameInterface
     */
    function newFrame();

    /**
     * @param string
     * @param bool
     * @return string
     * @todo Change to use other classes, this will be removed eventually
     */
    function frame($message, $mask = true);
}