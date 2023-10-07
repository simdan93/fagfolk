<?php
function checkInfo($mainservice, $secondaryservice, $postnummer, $tilgjengelig)
{
  Log::info($mainservice);
  Log::info($secondaryservice);
  Log::info($postnummer);
  if($mainservice == 0)
  {
      $sql = 'SELECT *
              FROM company_services cs, company_details cd, company_work_areas cw
              WHERE cd.company_id = cs.company_id
              AND cw.company_id = cs.company_id
              AND postnummer = ?';
      $companies = DB::select($sql, [$postnummer]);
  }
  elseif($mainservice != 0 && $secondaryservice == 0)
  {
      $sql = 'SELECT *
              FROM company_services cs, company_details cd, company_work_areas cw
              WHERE cd.company_id = cs.company_id
              AND cw.company_id = cs.company_id
              AND mainservice_id = ?
              AND postnummer = ?';
      $companies = DB::select($sql, [$mainservice, $postnummer]);
  }
  else
  {
      $sql = 'SELECT *
              FROM company_services cs, company_details cd, company_work_areas cw
              WHERE cd.company_id = cs.company_id
              AND cw.company_id = cs.company_id
              AND mainservice_id = ?
              AND secondaryservice_id = ?
              AND postnummer = ?';
      $companies = DB::select($sql, [$mainservice, $secondaryservice, $postnummer]);
  }
  Log::info($companies);
  return $companies;
}

?>
