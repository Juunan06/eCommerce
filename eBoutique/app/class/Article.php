<?php
/**
 * 
 */
class Article
{
	private $_id, $_name, $_desc, $_price, $_img, $_category,$_qte;

	function __construct($name,$desc,$price,$qte,$id = null,$img ="",$cat = null)
	{
		$this->_id = $id;
		$this->_name = $name;
		$this->_desc = $desc;
		$this->_price = $price;
		$this->_img = $img;
		$this->_category = $cat;
		$this->_qte = $qte;
	}

	public function __get($var){
		return $this->$var;
	}

	public function __set($var,$attr){
		$this->$attr = $var;
	}

	public static function getAllArticles($bdd){
		$getArticle = $bdd->query("SELECT * FROM `article`");
		$return = "";
		if ($getArticle->rowCount() > 0){
			$listArticle = $getArticle->fetchAll();
			foreach ($listArticle as $key => $value) {
				echo "<div class='col-xl-3 card'>
  <img class='card-img-top' src='".$value['article_img']."' alt='Card image cap'>
  <div class='card-body'>
    <h5 class='card-title'>".$value['article_name']."</h5>
    <div class='row'>
    	<div class='col-xl-8'>
    		".$value['article_desc']."
    	</div>
    	<div class='col-xl-4'>
    		Prix TTC : <br />
    		".$value['article_price']." €
    		<br />
    		Quantité : ".$value['article_qte']."
    	</div>
    </div>
  </div>
  <div class='card-footer'>
  	<button class='btn btn-success form-control'>Ajouter au Panier</button>
  </div>
</div>";

			}
		}else{
			return 'Aucun article trouvé';
		}
	}
}