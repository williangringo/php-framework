<?php

namespace App\Response;

class JsonResponse extends \Symfony\Component\HttpFoundation\JsonResponse {

    public function setData($data = array()) {
        parent::setData($data);
        // Encode <, >, ', &, and " for RFC4627-compliant JSON, which may also be embedded into HTML.
        $this->data = json_encode($data, JSON_FORCE_OBJECT | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);

        return $this->update();
    }

}
