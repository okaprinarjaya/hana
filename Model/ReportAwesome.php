<?php
App::uses('AppModel', 'Model');

/**
 * ReportAwesome Model
 *
 */
class ReportAwesome extends AppModel
{
	public $useTable = false;

	public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array())
    {
    	$recursive = -1;
    	$query = $conditions['query'];

    	$offset = (($page - 1) * $limit);
    	$sql = $query." LIMIT ".$offset.",".$limit;

    	return $this->query($sql);
    }

    public function paginateCount($conditions = null, $recursive = 0, $extra = array())
    {
    	$query = $conditions['query'];
    	$sql = "SELECT COUNT(*) AS total_data FROM (".$query.") crazy";
    	$row = $this->query($sql);

    	return $row[0][0]['total_data'];
    }
}