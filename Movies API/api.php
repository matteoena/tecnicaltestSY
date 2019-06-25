<?php
	include_once 'movie.php';

	class Api {

		function getAll(){
			$movie = new Movie;
			$movies = array();
			$movies["items"] = array();

			$res = $movie->getMovies();
			if($res->rowCount()){
				while($row = $res->fetch(PDO::FETCH_ASSOC)){
					$item = array(
						'id' => $row['id'],
						'title' => $row['title'],
						'releaseyear' => $row['releaseyear']
					);
					array_push($movies['items'], $item);
				}

				//echo json_encode($movies);
				$this->printJSON($movies);
			} else{
				//echo json_encode(array('message' => 'No movies found'));
				$this->error('No movies found');
			}
		}

		function getById($id){
			$movie = new Movie;
			$movies = array();
			$movies["items"] = array();

			$res = $movie->getMovie($id);
			if($res->rowCount() == 1){

				$row = $res->fetch();				
				$item = array(
					'id' => $row['id'],
					'title' => $row['title'],
					'releaseyear' => $row['releaseyear']
				);
				array_push($movies['items'], $item);				

				//echo json_encode($movies);
				$this->printJSON($movies);
			} else{
				//echo json_encode(array('message' => 'No movies found'));
				$this->error('No movies found');
			}
		}

		function add($item){
			$movie = new Movie();
			
			$result = $movie->newMovie($item);
			$this->success('New movie created');
		}

		function remove($id){
			$movie = new Movie();

			$result = $movie->deleteMovie($id);
			$this->success('Movie removed correctly');
		}

		function success($message){
			echo json_encode(array('message' => $message));
		}

		function printJSON($array){
			echo '<code>' . json_encode($array) . '</code>';
		}

		function error($message){
			echo json_encode(array('message' => $message));
		}
	}
?>