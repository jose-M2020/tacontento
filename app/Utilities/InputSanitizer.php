<?php
namespace App\Utilities;

use DOMDocument;
use DOMXPath;

class InputSanitizer
{
    private $allowedTags;
    private $allowedAttributes;
    private $removeTags;
    private $allowAll;

    public function __construct($allowedTags = [], $allowedAttributes = [], $removeTags = [])
    {
        $this->allowedTags = $allowedTags;
        $this->allowedAttributes = $allowedAttributes;
        $this->removeTags = $removeTags;
        $this->allowAll = empty($allowedTags) && empty($allowedAttributes) && empty($removeTags);
    }

    // Sanitize a single input value or an array of input values
    public function sanitize($input)
    {
        if (is_array($input)) {
            return array_map([$this, 'sanitize'], $input);
        } else {
            $sanitized_input = trim($input);
            $sanitized_input = $this->removeBackslashes($sanitized_input);
            $sanitized_input = $this->sanitizeTagsAndAttributes($sanitized_input);
            return $sanitized_input;
        }
    }

    private function removeBackslashes($input)
    {
        return stripslashes($input);
    }

    private function sanitizeTagsAndAttributes($input)
    {
        if ($this->allowAll) {
            // If no specific configurations provided, remove all tags and attributes.
            return strip_tags($input);
        }

        // Load input into DOMDocument to sanitize tags and attributes.
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="UTF-8">' . $input, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Remove unwanted tags and attributes.
        if (!empty($this->allowedTags)) {
            $this->removeUnwantedTags($doc);
        }
        if (!empty($this->allowedAttributes)) {
            $this->removeUnwantedAttributes($doc);
        }
        if (!empty($this->removeTags)) {
            $this->removeSpecificTags($doc);
        }

        // Save the sanitized content and return it.
        $sanitized_input = $doc->saveHTML();
        return $sanitized_input;
    }

    private function removeUnwantedTags($doc)
    {
        $xpath = new DOMXPath($doc);
        $nodes = $xpath->query('//*[not(self::' . implode(' or self::', $this->allowedTags) . ')]');
        foreach ($nodes as $node) {
            $node->parentNode->removeChild($node);
        }
    }

    private function removeUnwantedAttributes($doc)
    {
        $xpath = new DOMXPath($doc);
        $nodes = $xpath->query('//*[@*]');
        foreach ($nodes as $node) {
            $attributes = $node->attributes;
            foreach ($attributes as $attribute) {
                if (!in_array($attribute->nodeName, $this->allowedAttributes)) {
                    $node->removeAttribute($attribute->nodeName);
                }
            }
        }
    }

    private function removeSpecificTags($doc)
    {
        $xpath = new DOMXPath($doc);
        $nodes = $xpath->query('//' . implode('|//', $this->removeTags));
        foreach ($nodes as $node) {
            $node->parentNode->removeChild($node);
        }
    }
}



?>