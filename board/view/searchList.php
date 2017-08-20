<?php
print '[';
for($i=0; $i<count($this->data); $i++){
	if($i>0){
		print ',';
	}
	print '{"num":'.$this->data[$i]->getNum();
	print ',"writer":"'.$this->data[$i]->getWriter();
	print '","title":"'.$this->data[$i]->getTitle().'"}';
}
print ']';
?>