<?php
/**
 * @package
 * @subpackage
 * @author      Chance Garcia <chance@garcia.codes>
 * @copyright   (C)Copyright 2013-2019 Chance Garcia, chancegarcia.com
 *
 *    The MIT License (MIT)
 *
 * Copyright (c) 2013-2019 Chance Garcia
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

namespace Chance\CitrixRightSignature;

// https://api.rightsignature.com/documentation/resources/v1/sending_requests/uploaded.en.html

use BlueBurro\DocumentAssembly\CoreBundle\Model\Entity\FieldInterface;
use Chance\CitrixRightSignature\SendingRequest\DocumentInterface;

class OneOffDocumentRequest implements OneOffDocumentRequestInterface
{
    /**
     * @var FieldInterface
     */
    private $file;

    /**
     * @var DocumentInterface
     */
    private $document;

    /**
     * @var SendingRequestInterface
     */
    private $sendingRequest;

    /*
     * {
  "file": {
    "name": "my_upload.pdf",
    "source": "upload"
  },
  "document": {
    "signer_sequencing": false,
    "expires_in": 12,
    "name": "Sign me",
    "roles": [
      {
        "name": "a",
        "signer_name": "Geoff E",
        "signer_email": "geoff@example.com"
      }
    ]
  },
  "sending_request": {}
}
     */
    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        // maybe get fancy in the future and use inflector (https://github.com/doctrine/inflector) with reflection to create the array.

        $encodedSendingRequest = ($this->sendingRequest instanceof SendingRequestInterface) ? json_encode($this->sendingRequest) : '{}';

        return [
            'file' => json_encode($this->file),
            'document'  => json_encode($this->document),
            'sendingRequest' => $encodedSendingRequest,
        ];
    }
}