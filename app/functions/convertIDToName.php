<?php
function convertIDToName($services)
{
  foreach($services as $service)
  {
    $mainService = DB::select('select * from main_services where id = ?', [$service->mainservice_id]);
    $service->mainservice_id = $mainService[0]->hovedfag;
    if(property_exists($service, 'secondaryservice_id') == true)
    {
      if($service->secondaryservice_id != 0)
      {
        $secService = DB::select('select * from secondary_services where id = ?', [$service->secondaryservice_id]);
        $service->secondaryservice_id = $secService[0]->spesialisering;
      }
      else
        $service->secondaryservice_id = '--';
    }
    else
    {
      if($service->id != 0)
      {
        $secService = DB::select('select * from secondary_services where id = ?', [$service->id]);
        $service->id = $secService[0]->spesialisering;
      }
      else
        $service->secondaryservice_id = '--';
    }
  }
  return $services;
}
