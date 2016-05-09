<?php 

class CtripModel extends Model {

    const TBL_CITY = 'city';

    public function addCity($data)
    {
        $this->_db->where('name', $data['name']);
        if (!$this->_db->getOne(SELF::TBL_CITY)){
            if ( ! $id = $this->_db->insert(self::TBL_CITY, $data) ) {
                 error_log('insert city data error '. $this->_db->getLastError());
                 exit();
            }
        }
        return TRUE;
    }

    public function getCity()
    {
        $data = $this->_db->get(SELF::TBL_CITY, null, ['name', 'code']);
        if(!$data) {
            return FALSE;
        } 
        return $data;

    }


}
