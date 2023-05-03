<?php
namespace Osfrportal\OrionproLaravel\Http\Controllers\Api;

use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Osfrportal\OrionproLaravel\Data\OrionPersonData;
use Osfrportal\OrionproLaravel\Data\OrionEventTypeData;
use Osfrportal\OrionproLaravel\Data\OrionEventData;
use Osfrportal\OrionproLaravel\Data\OrionKeyData;
use Osfrportal\OrionproLaravel\Http\Resources\OrionDoorsCollection;
class APIOrionproControllerV1
{

    protected $soapWrapper;
    protected $OrionSoapUrl;
    protected $dateformat = DATE_ATOM;
    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
        $this->OrionSoapUrl = config('orionpro.OrionSoapURL');
        $this->soapWrapper->add('IOrionPro', function ($service) {
            $service
              ->wsdl($this->OrionSoapUrl)
              ->trace(false)
              ->cache(WSDL_CACHE_NONE);
        });
    }

    /**
     * Логи проходов за указанное количество часов
     * @param int $hours
     * @return \Illuminate\Support\Collection
     */
    public function OrionDoorsLog(int $hours = 1)
    {
        $beginTime = now()->subHours($hours)->format($this->dateformat);
        $endTime = now()->format($this->dateformat);
        //$response_event_types = $this->soapWrapper->call('IOrionPro.GetEventTypes',[]);
        $eventTypes = array();
        $eventTypes = Arr::prepend($eventTypes, new OrionEventTypeData(28));
        $data = [
            'beginTime' => $beginTime,
            'endTime' => $endTime,
            'eventTypes' => $eventTypes,
            //'offset' => 1000,
            //'count' => 10,
        ];
        set_time_limit(0);
        $response_events = $this->soapWrapper->call('IOrionPro.GetEvents',$data);
        $events_collection = collect();
        foreach ($response_events->OperationResult as $key) {
            $edata = OrionEventData::from($key);
            $events_collection->push($edata);
            //printf("%s: %s %s %s %s (%s) %s %s IsNoRights: %b IsBlocked: %b<br>",$edata->EventDate->format('d-m-Y H:i:s'),$edata->EventTypeId,$edata->LastName,$edata->FirstName,$edata->MiddleName,$edata->TabNum,$edata->CardNo,$edata->AccessPointName, $edata->AccessFlags->IsNoRights, $edata->AccessFlags->IsBlocked);
        }
        return $events_collection;

    }
    public function index()
    {
        return new OrionDoorsCollection($this->OrionDoorsLog(4));
        //return $this->OrionDoorsLog(4);
    }

    public function index1()
    {
        //$entryPoints = $this->soapWrapper->call('IOrionPro.GetEntryPoints',[]);
        try {
            $personsOrion = $this->soapWrapper->call('IOrionPro.GetPersons', [false, '45', '2']);
            //$personsOrion = $this->soapWrapper->call('IOrionPro.GetPersons', []);
            //if ($personsOrion->Success && is_null($personsOrion->ServiceError) && !empty($personsOrion->OperationResult)) {
            if ($personsOrion->Success && is_null($personsOrion->ServiceError)) {
                if (!empty($personsOrion->OperationResult)) {
                    foreach ($personsOrion->OperationResult as $OperationResult) {
                        $personData = OrionPersonData::from($OperationResult);
                        dump($personData);
                        $PersonPassList = $this->soapWrapper->call('IOrionPro.GetPersonPassList', [$personData]);
                        //dump($PersonPassList);
                        foreach ($PersonPassList->OperationResult as $OperationResultPass) {
                            $KeyData = $this->soapWrapper->call('IOrionPro.GetKeyData', [$OperationResultPass]);
                            dump(OrionKeyData::from($KeyData->OperationResult));
                        }
                        //dump($KeyData->OperationResult);
                    }

                    //return response()->json(data: $KeyData, options: JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                } else {
                    return response()->json(data: 'Empty', options:JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                }
            } else {
                return response()->json(data: 'ServiceError', options:JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
        //$ServiceInfo = $this->soapWrapper->call('IOrionPro.GetServiceInfo', []);
        //$EventTypes = $this->soapWrapper->call('IOrionPro.GetEventTypes', []);

        //return response()->json(data: $ServiceInfo, options:JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
