<?php
/**
 * 
 */
class Article
{
	private $_id, $_name, $_desc, $_price, $_img, $_category,$_qte;

	function __construct($name,$desc,$price,$img ="",$cat = null,$qte = 0,$id="")
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

	//Public method
	public function add($bdd){
		$addArticle = $bdd->prepare("INSERT INTO `article` (`article_name`,`article_desc`,`article_price`,`article_img`,`category_id`,`article_qte`) VALUES (:name,:descr,:price,:img,:cat,:qte)");
		$addArticle->bindValue(':name',$this->_name);
		$addArticle->bindValue(':descr',$this->_desc);
		$addArticle->bindValue(':price',$this->_price);
		$addArticle->bindValue(':img',$this->_img);
		$addArticle->bindValue(':cat',$this->_category);
		$addArticle->bindValue(':qte',$this->_qte);
		$exec = $addArticle->execute();
		if (!$exec){
			throw new CustomException('An error occured, please check your query in Article.php -> add()','0x400');
		}
	}

	//Statics functions

	//To display articles on catalog page
	public static function getAllArticles($bdd){
		$getArticle = $bdd->query("SELECT * FROM `article`");
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

	// to make the crud interface
	public static function getArticleList($bdd){

		$getArticle = $bdd->query("SELECT * FROM `article`");
		if ($getArticle->rowCount() > 0){
			$listArticle = $getArticle->fetchAll();
			foreach ($listArticle as $key => $value) {
				$upModal = "";

				$delModal = "";
				
				echo "<tr><td>".$value['article_id']."</td><td>".$value['article_name']."</td><td>".$value['article_desc']."</td><td>".$value['article_price']."</td><td>".$value['category_id']."</td><td>".$value['article_qte']."</td><td><button class='btn btn-warning' data-toggle='modal' data-target='#modalUpdProd".$value['article_id']."'><span class='fas fa-pen'></span></button>&nbsp;".$upModal.$delModal."<button class='btn btn-danger' data-toggle='modal' data-target='#modalDelProd".$value['article_id']."'><span class='fas fa-ban'></span></button></td></tr>";
			}
		}else{
			echo '<tr><td>Aucun article trouvé</td></tr>';
		}
	}
}