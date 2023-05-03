<?php

namespace Osfrportal\OrionproLaravel\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class OrionDoorsResource extends JsonResource
{
    /**
     * Преобразовать ресурс в массив.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this);
        $this->EventDate = $this->EventDate->format('d-m-Y H:i:s');
        return [
            'EventId' => $this->EventId,
            'EventDate' => $this->EventDate,
            'AccessPointId' => $this->AccessPointId,
            'AccessPointName' => $this->AccessPointName,
            'CardNo' => $this->CardNo,
            'PersonId' => $this->PersonId,
            'LastName' => $this->LastName,
            'FirstName' => $this->FirstName,
            'MiddleName' => $this->MiddleName,
            'TabNum' => $this->TabNum,
            'IsBlocked' => $this->AccessFlags->IsBlocked,
            'IsNoRights' => $this->AccessFlags->IsNoRights,
            'IsExpired' => $this->AccessFlags->IsExpired,
        ];

        //return parent::toArray($request);
    }
}
