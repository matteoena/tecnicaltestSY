<?php
	mysqli_report(MYSQLI_REPORT_ERROR / MYSQLI_REPORT_STRICT);

	include_once 'db.php';

	class Movie extends DB {
		function getMovies(){
			$query = $this->connect()->query('SELECT * FROM movie');
			return $query;
		}

		function getMovie($id){
			$query = $this->connect()->prepare('SELECT * FROM movie WHERE id= :id');
			$query->execute(['id' => $id]);
			return $query;
		}

		function newMovie($movie){
			try {
			$query = $this->connect()->prepare('INSERT INTO movie (title, releaseyear) VALUES (:title, :releaseyear)');			
			$query->execute(['title' => $movie['title'], 'releaseyear' => $movie['releaseyear']]);
			return $query;
			} catch (Exception $e) {
			
			if ($e->getCode()=='1062') {
				throw new Exception("Movie already exists");				
			} else {
				throw new Exception("Error during creation: ".$e->getCode().'/'.$e->getFile().'/'.$e->getLine().'/'.$e->getMessage());				
			}
		}
		}

		function deleteMovie($id){
			try {
			$query = $this->connect()->prepare('DELETE FROM movie WHERE id= :id');
			$query->execute(['id' => $id]);
			return $query;
			} catch (Exception $e) {
			
			if ($e->getCode()=='1062') {
				throw new Exception("Movie doesn't exist");				
			} else {
				throw new Exception("Error during removal: ".$e->getCode().'/'.$e->getFile().'/'.$e->getLine().'/'.$e->getMessage());
				
			}
		}
		}
	}
?>