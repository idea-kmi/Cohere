<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2012 The Open University UK                                   *
 *                                                                              *
 *  This software is freely distributed in accordance with                      *
 *  the GNU Lesser General Public (LGPL) license, version 3 or later            *
 *  as published by the Free Software Foundation.                               *
 *  For details see LGPL: http://www.fsf.org/licensing/licenses/lgpl.html       *
 *               and GPL: http://www.fsf.org/licensing/licenses/gpl-3.0.html    *
 *                                                                              *
 *  This software is provided by the copyright holders and contributors "as is" *
 *  and any express or implied warranties, including, but not limited to, the   *
 *  implied warranties of merchantability and fitness for a particular purpose  *
 *  are disclaimed. In no event shall the copyright owner or contributors be    *
 *  liable for any direct, indirect, incidental, special, exemplary, or         *
 *  consequential damages (including, but not limited to, procurement of        *
 *  substitute goods or services; loss of use, data, or profits; or business    *
 *  interruption) however caused and on any theory of liability, whether in     *
 *  contract, strict liability, or tort (including negligence or otherwise)     *
 *  arising in any way out of the use of this software, even if advised of the  *
 *  possibility of such damage.                                                 *
 *                                                                              *
 ********************************************************************************/

///////////////////////////////////////
// SearchSet Class
///////////////////////////////////////

class SearchSet {

    public $totalno = 0;
    public $count = 0;
    public $searches;

    /**
     * Constructor
     *
     */
    function SearchSet() {
        $this->searches = array();
    }

    /**
     * add a Search to the set
     *
     * @param Search $search
     */
    function add($search){
        array_push($this->searches,$search);
    }

    /**
     * load in the searches for the given SQL statement
     *
     * @param string $sql
     * @return SearchSet (this)
     */
    function load($sql, $params = array()){
        global $DB;

		$resArray = $DB->select($sql, $params);
		if ($resArray !==false && count($resArray) > 0) {
			$count = 0;
			if (is_countable($resArray)) {
				$count = count($resArray);
			}
        	$this->totalno = $count;
			$this->count = $count;
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
            	$searchobj = new Search($array['SearchID']);
	            $this->add($searchobj->load());
			}
		}

        return $this;
    }
}
?>