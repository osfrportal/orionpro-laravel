<?php
namespace Osfrportal\OrionproLaravel\Data;

use Spatie\LaravelData\Data;
class OrionEventTypeData extends Data
{
    public function __construct(
        public int $Id = 0,
        public ?string $CharId = null,
        public ?string $Description = null,
        public ?string $Category = null,
        public ?string $HexColor = null,
        public bool $IsAlarm = false,
        public ?string $Comments = null,
    ) {}
}
