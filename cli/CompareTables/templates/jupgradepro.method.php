	/**
	 * Custom migrate for {TABLE} table
	 *
	 * @param   object   $rows     The rows objectList object with the data of this table
	 *
	 * @return object
	 *
	 * @since 1.0
	 */
	function dataHook_{TABLE}($rows) {
		{DISABLE}{ALTER}
		{DISABLE}$this->_db->setQuery ( $query );
		{DISABLE}$this->_db->query ();

		foreach ($rows as &$row)
		{
			
{UNSET}
		}

		return $rows;
	}

