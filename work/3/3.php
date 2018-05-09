<?php

	class Figure{
		protected $type;
		public function getArea() {}
		public function getType(){
			if ($this->type == '') echo 'тип фигуры не задан';
			else echo $this->type;
		}
	}
	
	class Rectangle extends Figure{
		private $a,$b;
		function __construct($inputObj){
			$this->type=$inputObj->type;
			$this->a=$inputObj->a;
			$this->b=$inputObj->b;
		}
		  public function getArea(){
            return $this->a * $this->b;
        }
		
	}
	
	class Circle extends Figure{
		private $radius;
		function __construct($inputObj){
			$this->type=$inputObj->type;
			$this->radius=$inputObj->radius;
		}
		  public function getArea(){
            return PI() * ($this->radius**2);
        }
		
	}
	
	class Triangle extends Figure{
		private $a,$b,$c;
		function __construct($inputObj){
			$this->type=$inputObj->type;
			$this->a=$inputObj->a;
			$this->b=$inputObj->b;
			$this->c=$inputObj->c;
		}
		  public function getArea(){
            $semPer=($this->a+$this->b+$this->c)/2;
			return sqrt($semPer*($semPer-$this->a)*($semPer-$this->b)*($semPer-$this->c));
        }
		
	}

	class InputData{
		private $f;
		function __construct($puth){
			$file=file_get_contents($puth);
			$this->f=json_decode($file);
		}
		public function getFile(){
			return $this->f;
		}
	}
	
	function cmp($a, $b){
		if ($a->getArea() == $b->getArea()) {
			return 0;
		}
		return ($a->getArea() < $b->getArea()) ? 1 : -1;
	}

	
	//main
	$file=new InputData("figures.json");
	$collection=array();
	
	for ($i=0;$i<count($file->getFile());$i++){
		$currentObj=$file->getFile()[$i];
		switch ($currentObj->type){
			case "circle":
				$collection[]=new Circle($currentObj);
				break;
			case "rectangle": 
				$collection[]=new Rectangle($currentObj);
				break;
			case "triangle": 
				$collection[]=new Triangle($currentObj);
				break;
		}
	}
	
	usort($collection, "cmp");
	foreach ($collection as $key => $value){
		 echo ($collection[$key]->getType().",area=".$collection[$key]->getArea()."<br>");
	}
	
	
?>