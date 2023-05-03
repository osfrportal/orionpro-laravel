<?php
declare(strict_types=1);
namespace Osfrportal\OrionproLaravel\Data;

use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Osfrportal\OrionproLaravel\Data\OrionAccessFlagsData;
use Carbon\CarbonImmutable;
use Carbon\Carbon;
class OrionEventData extends Data
{
    public function __construct(
        public ?string $EventId = null,
        public ?int $EventTypeId = 0,
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: 'd-m-Y H:i:s', setTimeZone: 'Europe/Moscow')]
        public ?Carbon $EventDate = null,
        public ?string $Description = null,
        public ?int $ComputerId = null,
        public ?int $ComPortNumber = null,
        public ?int $PKUAddress = null,
        public ?int $DevAddress = null,
        public ?int $ZoneAddress = null,
        public ?int $AccessPointId = null,
        public ?string $AccessPointName = null,
        public ?int $AccessZoneId = null,
        public ?int $PassMode = 0,
        public ?string $CardNo = null,
        public ?int $PersonId = null,
        public ?string $LastName = null,
        public ?string $FirstName = null,
        public ?string $MiddleName = null,
        public ?CarbonImmutable $BirthDate = null,
        public ?string $TabNum = null,
        public ?int $ItemId = null,
        public ?string $ItemType = null,
        public ?int $SectionId = null,
        public ?int $ReaderId = null,
        public OrionAccessFlagsData $AccessFlags,
    ) {}
}
