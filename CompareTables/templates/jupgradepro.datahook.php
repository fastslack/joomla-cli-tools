	/**
	 * Custom data migration for {TABLE} table
	 *
	 * @param   object   $rows     The rows objectList object with the data of this table
	 *
	 * @return object
	 *
	 * @since 1.0
	 */
	function dataHook_{TABLE} ($rows) {

		foreach ($rows as &$row)
		{
			$row = (array) $row;
			
{UNSET}
		}

		return $rows;
	}

