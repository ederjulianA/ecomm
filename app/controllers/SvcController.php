<?php
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

//use League\Csv\Reader;

class SvcController extends BaseController {


public function getSvc()
{
	return View::make('store.svc');
}	


	private function _import_csv($path, $filename)
{

$csv = $path . $filename; 


//ofcourse you have to modify that with proper table and field names
$query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE producto2 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' LINES TERMINATED BY '\\n' IGNORE 0 LINES (`id`, `nombre`, `precio`)", addslashes($csv));
$pdo = DB::connection()->getPdo()->exec($query);

return $pdo;

}

	/*public function postUpload ()
	{
	    if (Input::hasFile('file')){

	        $csv = Input::file('file');

			$query = sprintf("LOAD DATA INFILE '%s' INTO TABLE producto2 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' LINES TERMINATED BY '\\n' IGNORE 0 LINES (`id`, `nombre`, `precio`)", addslashes($csv));
			$pdo = DB::connection()->getpdo()->exec($query);
			if($pdo)
			{
				return Redirect::to('/svc');
			}

	     }
	}*/

	/*public function postUpload ()
	{
	    if (Input::hasFile('file')){

	        

			$sth = $dbh->prepare(
						"INSERT INTO producto2 (id, nombre, precio) VALUES (:id, :nombre, :precio)"
					);

					$csv = Input::file('file');
					$csv->setOffset(0); //because we don't want to insert the header
					$nbInsert = $csv->each(function ($row) use (&$sth) {
						//Do not forget to validate your data before inserting it in your database
						$sth->bindValue(':id', $row[0], PDO::PARAM_STR);
						$sth->bindValue(':nombre', $row[1], PDO::PARAM_STR);
						$sth->bindValue(':precio', $row[2], PDO::PARAM_STR);

						return $sth->execute(); //if the function return false then the iteration will stop
					} );

						     }
	}*/

	public function postUpload()
	{
		 if (Input::hasFile('file')){

	        $csv = Input::file('file');


			$pdo = DB::connection()->getPdo();
			$pdo->query('CREATE TABLE IF NOT EXISTS producto2 (id INT, `nombre` VARCHAR(255), precio VARCHAR(255))');

			$config = new LexerConfig();
			$lexer = new Lexer($config);

			$interpreter = new Interpreter();
			$interpreter->unstrict();

			$interpreter->addObserver(function(array $columns) use ($pdo) {
				$stmt = $pdo->prepare('REPLACE INTO producto2 (id, nombre, precio) VALUES (?, ?, ?)');
			    	$stmt->execute($columns);
				/*$select_stmt = $pdo->prepare('SELECT id FROM producto2 WHERE id = ?');
				$select_stmt->execute([ $columns[0] ]);
				
				$id = $select_stmt->fetchColumn();
				if(!$id)
				{
					$stmt = $pdo->prepare('INSERT INTO producto2 (id, nombre, precio) VALUES (?, ?, ?)');
			    	$stmt->execute($columns);
				}else{
					$update_stmt = $pdo->prepare('UPDATE producto2 SET nombre = ?, precio = ? WHERE id = ?');
					$update_stmt->execute($columns);
				}*/
				
				
			    
			});

			$lexer->parse($csv, $interpreter);
			return Redirect::to('/svc');
			}

		
	}
}