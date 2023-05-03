<?php
namespace Osfrportal\OrionproLaravel\Data;

use Spatie\LaravelData\Data;
class OrionAccessFlagsData extends Data
{
    public function __construct(
        public ?bool $IsBlocked = false,
        public ?bool $IsNoRights = false,
        public ?bool $IsBrokenAntipassback = false,
        public ?bool $IsBrokenTimeWindow = false,
        public ?bool $IsExpired = false,
        public ?bool $IsAdditionalCodeInputError = false,
        public ?bool $IsDuressCode = false,
        public ?bool $IsConfirmationCodeError = false,
        public ?bool $IsConfirmationWaiting = false,
    ) {}
}
