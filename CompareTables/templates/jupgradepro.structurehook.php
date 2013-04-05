	/**
	 * Custom structure migration for {TABLE} table
	 *
	 * @return boolean
	 *
	 * @since 1.0
	 */
	function structureHook_{TABLE} () {

		{DISABLE}$query = "ALTER TABLE #__{TABLE}"
{ALTER}
		{DISABLE}$this->_db->setQuery ( $query );
		{DISABLE}$this->_db->query ();

		return true;
	}

