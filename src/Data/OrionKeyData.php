<?php
namespace Osfrportal\OrionproLaravel\Data;
/**
 * В конфиге data.php установить значение переменной
 * 'date_format' => [DATE_ATOM, 'Y-m-d\TH:i:s.000O'],
 */
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Carbon\Carbon;

class OrionKeyData extends Data
{
    public function __construct(
        public int $Id = 0,
        public ?int $CodeType = 0,
        public ?int $AdditionalCodeType = 0,
        public ?string $Code = null,
        public ?string $AdditionalCode = null,
        public ?int $PersonId = 0,
        public ?int $AccessLevelId = 0,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $StartDate = null,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $EndDate = null,
        public ?bool $IsBlocked = false,
        public ?bool $IsStoreInDevice = true,
        public ?bool $IsStoreInS2000 = false,
        public ?bool $IsInStopList = false,
        public ?string $Comment = null,
        public ?string $Login = null,
    ) {}
}
