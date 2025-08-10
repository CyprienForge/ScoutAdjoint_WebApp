<?php

namespace Domain\ViewModel\ShowDetailsMatch;

class ContentNoteViewModel
{

    public function __construct(
        public int $minute,
        public string $content
    ){}

}
