<?php
require_once("DB.php");
$db = new DB("localhost", "vuejs-db", "root", "root");

if(isset($_GET['action'])){
	$action = $_GET['action'];
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    //-- FILM TUMU SAYFASI --
    //Film sayfası için belli sayfadaki filmleri dönüyor. Default olarak 1. sayfadan döner.
    if(isset($_GET["getMovies"])) {
      $page = intval(@$_GET['pageNumber']);
      if(!$page) {
          $page =1;
      }
      $howFar = 2;     //her sayfada kaç film olacak
      $total_movies = count($db->query("SELECT * FROM Scenes WHERE scene_type = 'movie' "));
      $total_page = ceil($total_movies / $howFar);
      $where= ($page * $howFar) - $howFar;
      echo json_encode($db->query("SELECT * FROM Scenes WHERE scene_type = 'movie' ORDER BY scene_rating DESC LIMIT $where, $howFar"));
    }

    //Film sayfasındaki alt taraftaki paging özelliği için kaç page olduğu değerini dönüyor
    else if (isset($_GET['getTotalPageNumber'])) {
      $howFar = 2;     //her sayfada kaç film olacak
      $total_movies = count($db->query("SELECT * FROM Scenes WHERE scene_type = 'movie' "));
      $total_page = ceil($total_movies / $howFar);
      echo json_encode($total_page);
    }
    //----

		//-- FILM KATEGORI SAYFASI--

		//Kategorilere göre filmleri çekme sorgusu. 3 tablo JOIN işlemi yapılıyor
		else if (isset($_GET['getMoviesByCategory'])) {
				$category = $_GET['getMoviesByCategory'];
				$page = intval(@$_GET['pageNumber']);
	      if(!$page) {
	          $page =1;
	      }
				$howFar = 2;     //her sayfada kaç film olacak
	      $total_movies = count($db->query("SELECT *
					 												   FROM Scenes S, Has_category H, Categories C
																     WHERE S.scene_id = H.scene_id AND
																		       C.category_id = H.category_id AND
																					 C.category_name = '$category' AND
																					 S.scene_type = 'movie' "));
				$total_page = ceil($total_movies / $howFar);
				$where= ($page * $howFar) - $howFar;
				echo json_encode($db->query("SELECT *
					 												   FROM Scenes S, Has_category H, Categories C
																     WHERE S.scene_id = H.scene_id AND
																		       C.category_id = H.category_id AND
																					 C.category_name = '$category' AND
																					 S.scene_type = 'movie'
																					 ORDER BY S.scene_rating DESC LIMIT $where, $howFar"));
		}
		else if (isset($_GET['getTotalPageNumberByCategory'])) {
			$category = $_GET['getTotalPageNumberByCategory'];
      $howFar = 2;     //her sayfada kaç film olacak
      $total_movies = count($db->query("SELECT *
																	 	  	FROM Scenes S, Has_category H, Categories C
																	 			WHERE S.scene_id = H.scene_id AND
																				 C.category_id = H.category_id AND
																				 C.category_name = '$category' AND
																				 S.scene_type = 'movie'  "));
      $total_page = ceil($total_movies / $howFar);
      echo json_encode($total_page);
    }

		//----

    //--ANA SAYFA--
    //Ana sayfadaki son 5 haber gösterimi için SQL sorgusu
    else if (isset($_GET['getLast5News'])) {
        echo json_encode($db->query("SELECT N.news_title, N.news_photo, N.news_date FROM News N ORDER BY N.news_date DESC LIMIT 5"));
    }

    //--HABERLER SAYFASI--
    else if (isset($_GET['getTotalPageNumberNews'])) {
      $howFar = 5;     //her sayfada kaç film olacak
      $total_news = count($db->query("SELECT * FROM News ORDER BY news_date DESC"));
      $total_news_page = ceil($total_news / $howFar);
      echo json_encode($total_news_page);
    }
    else if(isset($_GET["getNews"])) {
      $page = intval(@$_GET['pageNumber']);
      if(!$page) {
          $page =1;
      }
      $howFar = 5;     //her sayfada kaç film olacak
      $where= ($page * $howFar) - $howFar;
      echo json_encode($db->query("SELECT * FROM News ORDER BY news_date DESC LIMIT $where, $howFar"));
    }
    else if(isset($_GET["getMostViewed5NewsForMoviePage"])) {
      echo json_encode($db->query("SELECT N.news_title, N.news_photo, N.news_date FROM News N ORDER BY N.news_views DESC LIMIT 5"));

    }
    //----

		//-FILM DETAY SAYFASI---
		else if(isset($_GET['getMovieDetailPage'])) {
				$movie_id = $_GET['getMovieDetailPage'];

				echo json_encode($db->query("SELECT S.scene_name, S.scene_photo, S.scene_rating, S.scene_trailer, S.scene_country, S.scene_description FROM Scenes S WHERE S.scene_id = '$movie_id' "));
		}

		else if(isset($_GET['getMovieDetailPageCategories'])) {
				$movie_id = $_GET['getMovieDetailPageCategories'];

				echo json_encode($db->query("SELECT C.category_name
																		 	  	FROM Scenes S, Has_category H, Categories C
																		 			WHERE S.scene_id = H.scene_id AND
																					 C.category_id = H.category_id AND
																					 S.scene_id = '$movie_id'"));
		}
		else if(isset($_GET['getMovieDetailPageStars'])) {
				$movie_id = $_GET['getMovieDetailPageStars'];
				echo json_encode($db->query("SELECT S.star_name, S.star_surname
																		 	  	FROM Scenes Sc, Is_rolling I, Stars S
																		 			WHERE Sc.scene_id = I.scene_id AND
																					 I.star_id = S.star_id AND
																					 Sc.scene_id = '$movie_id'"));
		}
		else if(isset($_GET['getMovieDetailPageCompanies'])) {
				$movie_id = $_GET['getMovieDetailPageCompanies'];
				echo json_encode($db->query("SELECT C.company_name
																					FROM Scenes Sc, Supports S, Companies C
																					WHERE Sc.scene_id = S.scene_id AND
																					 S.company_id = C.company_id AND
																					 Sc.scene_id = '$movie_id'"));
		}
		else if(isset($_GET['getMovieDetailPageDirectors'])) {
				$movie_id = $_GET['getMovieDetailPageDirectors'];
				echo json_encode($db->query("SELECT Do.director_name, Do.director_surname
																					FROM Scenes Sc, Directors Do, Directs D
																					WHERE Sc.scene_id = D.scene_id AND
																					 D.director_id = Do.director_id AND
																					 Sc.scene_id = '$movie_id'"));
		}
		//-----




} else if ($_SERVER['REQUEST_METHOD'] == "POST") {

      if($action == 'addNews'){
        $news_title = $_POST['news_title'];
        $news_description = $_POST['news_description'];
        $news_photo = $_POST['news_photo'];
        $result = $db->query("INSERT INTO `News` (`news_title`, `news_description`, `news_photo`) VALUES ('$news_title', '$news_description', '$news_photo') ");

          	if($result){
          	   echo json_encode("News added successfully");
          	} else{
          		 echo json_encode("Couldn't insert news");
          	}

          }

} else {
        http_response_code(405);
}
?>
