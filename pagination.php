<?php
	function pagination($pg,$totalPages,$page_id){
		$next = ($pg+1)<$totalPages?($pg+1):$totalPages;
		$pre = ($pg-1)>0?($pg-1):1;
		
		
		$html = "<a href='home.php?page=$page_id&pg=1' class='btn btn-sm btn-outline-secondary'>First</a>";
		$html .= "<a href='home.php?page=$page_id&pg=$pre' class='btn btn-sm btn-outline-secondary'>Previous</a>";
		for($i= $pg-3; $i<=$pg+3; $i++){
			if($i>0 && $i<=$totalPages){
				$html .= ($i !=$pg)?"<a href='home.php?page=$page_id&pg=$i' class='btn btn-sm btn-outline-secondary'>$i</a>":"$pg";
			}
		}
		$html .= "<a href='home.php?page=$page_id&pg=$next' class='btn btn-sm btn-outline-secondary'>Next</a>";
		$html .= "<a href='home.php?page=$page_id&pg=$totalPages' class='btn btn-sm btn-outline-secondary'>Last</a>";

		$html .= "<form method='get' style='display:inline; margin-left: 10px;'>";
		$html .= "<input type='hidden' name='page' value='$page_id' />";
		$html .= "<input type='text' class='btn btn-sm btn-outline-secondary' style='width: 50px; margin-left: 10px;' name='pg' />";
		$html .= "<input type='submit' class='btn btn-sm btn-outline-secondary' value='Go' />";
		$html .= "</form>";

		return $html;
	}