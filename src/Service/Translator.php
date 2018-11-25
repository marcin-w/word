<?php

namespace App\Service;

class Translator
{
    public function retrieveTranslations($data): array
    {
        $translations = [];

        foreach ($data->results as $result) {
            foreach ($result->lexicalEntries as $lexicalEntries) {
                foreach ($lexicalEntries->entries as $entries) {
                    foreach ($entries->senses as $senses) {
                        if(isset($senses->definitions)) {
                            foreach ($senses->definitions as $definition) {
                                $translations[] = $definition;
                            }
                        }
                        if (isset($senses->crossReferenceMarkers)) {
                            foreach ($senses->crossReferenceMarkers as $definition) {
                                $translations[] = $definition;
                            }
                        }
                    }
                }
            }
        }

        return $translations;
    }
}