<?php

class FzhMembers extends Backend{
	
	public function exportXLS(){
		if($this->Input->get('key') != 'export')
		{
			return '';
		}	
		$this->loadLanguageFile('tl_fzh_members');

		$members = \FzhMembersModel::findBy('memberState',1);
		
		$worksheetname = "Aktive Mitglieder";

		$xls = new \xlsexport();
		$xls->addworksheet($worksheetname);

		$countRows = 0;
		$countCols = 0;
		while($members->next()){
			$header = ($countRows == 0)? true : false; 
			foreach($members->row() as $key => $data){
				switch($key){
					case 'tstamp': 
					case 'memberState':
						continue 2;
					break;

					case 'gender':
						$data = ($data == 'female')? 'Frau': 'Herr';
					break;

					case 'birthday':
					case 'joiningDate':
					case 'exitDate':
						$data = \Date::parse('d.m.Y',$data);
					break;

					case 'newsletter':
					case 'ransomed':
						$data = ($data == 0)? 'Nein':'Ja';
					break;
				}

				$data = ($header)? $GLOBALS['TL_LANG']['tl_fzh_members'][$key][0]:$data;

				//Encoding
				$data = mb_convert_encoding($data, 'CP1252');

				$xls->setcell(array(
				"sheetname"	=>$worksheetname, 
				"row" 		=> $countRows,
				"col" 		=> $countCols,
				"data" 		=> $data,
				));		
				$countCols++;
			}
			$countCols = 0;
			if($header) $members->reset();
			$countRows++;
		}
		$xls->sendfile(\Date::parse('Ymd').'-FZH Mitglieder.xls');
	}

	public function downloadDocument($dca){
		$file = new File($dca->id);
		$file->sendToBrowser();
	}	
}

?>